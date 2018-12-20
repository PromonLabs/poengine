<h3>Order Flow for {{ $offerDetails[0]->id }}<a id="goBack" style="float:right; cursor:pointer; font-size:16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></h3>
<div class="col-md-7" style="padding-left:0px;">
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
            <?php $orderStatus = ''; $i=1; $j=1; $box_color ='orange'; $text_color='#000'; ?>
            @if($orderActionDetails)
            <?php $orderStatus .= '<div id="circle"></div>';
                $disableButton = ''; ?>
                @foreach ($orderActionDetails as $orderActionDetail)
                    <tr>
                        <td>{{ $orderActionDetail->step }}</td>
                        <td>{{ $orderActionDetail->action->name }}</td>
                        <td class="status-completed step-status-cell" data-step-message="Callback received" data-toggle="tooltip" title="{{ $orderActionDetail->actionStatus->description }}">
                           {{ $orderActionDetail->actionStatus->name }}</td>
                        <td>
                            @if( $orderActionDetail->actionStatus->name != 'completed' && $orderActionDetail->actionStatus->name != 'skipped')
                                <button type="button" class="skip-order-step-btn small-button">Skip</button>
                            @endif
                        </td>
                    </tr>
                    <?php
                    if ($orderActionDetail->actionStatus->name == 'skipped') {
                        $box_color = 'orange';
                    } else if ($orderActionDetail->actionStatus->name == 'completed') {
                        $box_color = 'green';
                    } else {
                        if ($i == 1) {
                            $box_color = 'steelblue'; 
                        } else {
                            $box_color = 'red';
                        }
                        $disableButton = 1;
                        $i++; 
                    }
                    $orderStatus .='<hr id="circle-line"></hr>
                    <div id="action-step" style="border:3px solid '.$box_color.'; color:'.$text_color.';" data-toggle="tooltip" title="'. $orderActionDetail->actionStatus->description.'">
                        <div style="background:'.$box_color.'; color:#fff; padding:5px 0;">'.$orderActionDetail->actionStatus->name.'</div>
                        <div id="action-step-div">
                            <span style="padding:5px 10px; margin:5px 0px; font-weight:bold;">
                                STEP '.$j. 
                            '</span><br> '. $orderActionDetail->action->name.'
                        </div>
                    </div>';
                    $j++;
                    ?>
                @endforeach
                <?php $orderStatus .='<hr id="circle-line"></hr>
                <div id="circle"></div>
                <div style="clear:both;"></div>';
                ?>
            @endif
        </tbody>
    </table>
</div>
<div class="col-md-5" style="padding-right:0px;">
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
                        <td><button type="button" class="skip-order-step-btn small-button" data-toggle="modal" data-target="#showXml" style="cursor:pointer;">Show XML</button>
                            @if($disableButton == '1')
                                <button type="button" class="skip-order-step-btn small-button" style="cursor:pointer;">Abort</button>
                                <button type="button" class="skip-order-step-btn small-button"  style="cursor:pointer;">Reset</button>
                                <button type="button" class="skip-order-step-btn small-button"  style="cursor:pointer;">Terminate</button>
                            @endif
                        </td>
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
            <table class="table table-striped table-hover">
                <thead class="thead-blue">
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
        /* display:inline-block; 
        padding: 5px 0;*/
        text-align: center;
        width:auto;
        margin-bottom:5px;
    }
    #action-step-div {
        padding: 20px 5px;
    }
    #show-flow {
        margin: 0 auto;
        display:table;
    }
</style>
<!-- jQuery 3 -->
<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
$('#goBack').click(function(){
    $("#order-flow").css("display", "none");
    $("#order-header").css("display", "block");
    $("#order-default").css("display", "block");
});
</script>
