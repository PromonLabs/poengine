<h3>Details for {{ $processDetails[0]->name }}<a id="goBack" style="float:right; cursor:pointer; font-size:14px;color:#98BCDE;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return to list</a></h3>
@if ($processDetails)
    <?php $process = '<table class="table table-striped table-hover">
        <thead class="thead-blue">
            <tr>
                <th>Process Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>';
    $actionDetails = '<table class="table table-striped table-hover">
        <thead class="thead-blue">
            <tr>
                <th>#</th>
                <th>Action Name</th>
                <th>Call Back Required</th>
                <th>Saave Payload</th>
                <th>Stop on Fail</th>
                <th>Max Retries</th>
                <th>XSLT File name</th>
            </tr>
        </thead>
        <tbody>'; ?>
    @foreach ($processDetails as $processDetail)
        <?php $i=1; ?>
        <? $process .= '<tr><td>'.$processDetail->name.'</td><td>'.$processDetail->description.'</td></tr>'; ?>
        <div id="circle"></div>
        @foreach ($processDetail->getActions as $action)
            <hr id="circle-line"></hr>
            <div id="action-step"><span style="padding:5px 10px; margin:5px 0px; font-weight:bold;">STEP {{ $i }}</span><br> {{ $action->name }}</div>
            <? $actionDetails .= '<tr><td>'.$i.'</td><td>'.$action->name.'</td><td>'.($action->callback_required? "yes":"no").'</td><td>'.($action->save_payload? "true":"false").'</td><td>'.($action->stop_on_fail? "true":"false").'</td><td>'.$action->max_retries.'</td><td>'.$action->xslt_filename.'</td></tr>';
         $i++; ?>
        @endforeach
        <hr id="circle-line"></hr>
        <div id="circle"></div>
        <div style="clear:both;"></div>
    @endforeach
    <? $process .= '</tbody></table>'; ?>
    <? $actionDetails .= '</tbody></table>'; ?>
@endif
<div id="show-details">
    <?= $process; ?>
    <?= $actionDetails; ?>
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
        padding: 30px 5px;
        text-align: center;
        width:auto;
        margin: 10px 0;
    }
    #show-flow {
        margin: 0 auto;
        display:table;
    }
  }
</style>
<script>
    $('#goBack').click(function(){
        $("#process-details").css("display", "none");
        $("#process-header").css("display", "block");
        $("#process-default").css("display", "block");
    });
    </script>
