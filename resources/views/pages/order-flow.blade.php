<h3>Order Flow</h3>
<div class="col-md-4" style="padding-left:0px;">
    @if($offerDetails)
        <table class="table table-striped table-hover" style="background:#fff;">
            <thead class="thead-blue" style="background-color: #3c8dbc; color:#fff;">
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
                    <div class="modal-header" style="background-color: #3c8dbc; color:#fff;">
                        <h3 class="modal-title" id="exampleModalLabel">Order XML</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea style="width:100%;height:100%;"><?php print $xml; ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($offerDetails && $offerDetails[0]->offer)
        <table class="table table-striped table-hover" style="background:#fff;">
            <thead class="thead-blue" style="background-color: #3c8dbc; color:#fff;">
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

    @if($addons)
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
    <table class="table table-striped table-hover" style="background:#fff;">
        <thead class="thead-blue" style="background-color: #3c8dbc; color:#fff;">
            <tr>
                <th>Sequence</th>
                <th>Action</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @if($orderActionDetails)
                @foreach ($orderActionDetails as $orderActionDetail)
                    <tr>
                        <td>{{ $orderActionDetail->step }}</td>
                        <td>{{ $orderActionDetail->action->name }}</td>
                        <td class="status-completed step-status-cell" data-step-message="Callback received">{{ $orderActionDetail->actionStatus->name }}</td>
                        <td>
                            <button type="button" class="skip-order-step-btn small-button" disabled>Skip</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
