<h3>Order Flow</h3>
<div class="col-md-4" style="padding-left:0px;">
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


    @if($offerDetails && $offerDetails[0]->addOns)
        <table class="table table-striped table-hover" style="background:#fff;">
            <thead class="thead-blue" style="background-color: #3c8dbc; color:#fff;">
                <tr>
                    <th>ID</th>
                    <th>Addons</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offerDetails as $offerDetail)
                    <tr>
                        <td>{{ $offerDetail->addOns->id }}</td>
                        <td>{{ $offerDetail->addOns->name }}</td>
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
