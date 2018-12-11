<h3>Order Flow for {{ $offerDetails[0]->id }}</h3>
<div class="col-md-4" style="padding-left:0px;">
    @if($offerDetails)
        <table class="table table-striped table-hover">
            <thead class="thead-blue">
                <tr>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ date("d.m.y h:i:s", strtotime($offerDetails[0]->created)) }}</td>
                    <td>{{ date("d.m.y h:i:s", strtotime($offerDetails[0]->updated)) }}</td>
                    <td><button type="button" class="skip-order-step-btn small-button" data-toggle="modal" data-target="#showXml" style="cursor:pointer;">Show XML</button></td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="showXml" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Order XML</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea style="width:100%;height:400px;"><?php print $xml; ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($offerDetails && isset($offerDetails[0]->offer))
        <table class="table table-striped table-hover">
            <thead class="thead-blue">
                <tr>
                    <th>ID</th>
                    <th>Primary offer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offerDetails as $offerDetail)
                    <tr>
                        <td>{{ $offerDetail->offer->id }}</td>
                        <td>{{ $offerDetail->offer->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($addons && isset($addons[0]->id))
        <table class="table table-striped table-hover" style="background:#fff;">
            <thead class="thead-blue" style="background-color: #3c8dbc; color:#fff;">
                <tr>
                    <th>ID</th>
                    <th>Addons</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($addons as $addon)
                    <tr>
                        <td>{{ $addon->id }}</td>
                        <td>{{ $addon->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
<div class="col-md-8" style="padding-right:0px;">
    <table class="table table-striped table-hover">
        <thead class="thead-blue">
            <tr>
                <th>Sequence</th>
                <th>Action</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php $orderStatus = ''; $i=1; $box_color ='yellow'; $text_color='#000'; ?>
            @if($orderActionDetails)
            <?php $orderStatus .= '<div id="circle"></div>'; ?>
                @foreach ($orderActionDetails as $orderActionDetail)
                    <tr>
                        <td>{{ $orderActionDetail->step }}</td>
                        <td>{{ $orderActionDetail->action->name }}</td>
                        <td class="status-completed step-status-cell" data-step-message="Callback received">{{ $orderActionDetail->actionStatus->name }}</td>
                        <td>
                            @if( $orderActionDetail->actionStatus->name != 'completed')
                                <button type="button" class="skip-order-step-btn small-button">Skip</button>
                            @endif
                        </td>
                    </tr>
                    <?php
                    if ($orderActionDetail->actionStatus->name == 'completed') {
                        $box_color = 'green';
                        $text_color='#fff';
                    }
                    if ($orderActionDetail->actionStatus->name == 'pending') {
                        $box_color = 'red';
                        $text_color='#fff';
                    }
                    $orderStatus .='<hr id="circle-line"></hr>
                    <div id="action-step" style="background:'.$box_color.'; color:'.$text_color.';"><span style="padding:5px 10px; margin:5px 0px; font-weight:bold;">STEP '.$i. '</span><br> '. $orderActionDetail->action->name.'</div>';
                    $i++; ?>
                @endforeach
                <?php $orderStatus .='<hr id="circle-line"></hr>
                <div id="circle"></div>
                <div style="clear:both;"></div>';
                ?>
            @endif
        </tbody>
    </table>
</div>
<div style="clear:both;"></div>
<div id="show-flow">
    <?= $orderStatus ?>
</div>
<style>
    #circle {
        width: 50px;
        height: 50px;
        -webkit-border-radius: 25px;
        -moz-border-radius: 25px;
        border-radius: 25px;
        border: 2px solid #000;
        float:left;
        position: relative;
        top:35px;
    }
    #circle-line {
        border: 1px solid#000;
        float:left;
        width:20px;
        position: relative;
        top:40px;
    }
    #action-step {
        border: 1px solid#000;
        float:left;
        /* display:inline-block; */
        padding: 30px;
        text-align: center;
        width:auto;
        margin: 10px 0;
    }
    #show-flow {
        margin: 0 auto;
        display:table;
    }
</style>
