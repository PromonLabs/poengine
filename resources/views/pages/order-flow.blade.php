<h3>Order Flow</h3>
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
