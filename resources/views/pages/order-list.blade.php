<table class="table table-striped table-hover">
    <thead class="thead-blue" style="background-color: #3c8dbc; color:#fff;">
        <tr>
            <th></th>
            <th>ID</th>
            <th>Parent ID</th>
            <th>Account</th>
            <th>Name</th>
            <th>Service</th>
            <th>Status</th>
            <th>Process type</th>
            <th>Placed by</th>
            <th>Preferred date</th>
        </tr>
    </thead>
    <tbody>
        @if($orderDetails)
            @foreach ($orderDetails as $orderDetail)
                <tr id="{{ $orderDetail->id }}" class="order-row">
                    <td></td>
                    <td>{{ $orderDetail->id }}</td>
                    <td>-</td>
                    <td>
                        <a href="/crm/account/21005025">{{ $orderDetail->account_id }}</a>
                    </td>
                    <td>{{ $orderDetail->process->name }}</td>
                    <td><a href="/crm/account/21005025/service/169545">{{ $orderDetail->account_id }}</a></td>
                    <td>{{ $orderDetail->orderStatus->name }}</td>
                    <td>{{ $orderDetail->process_type }}</td>
                    <td>{{ $orderDetail->placed_by }}</td>
                    <td>{{ date("d.m.Y", strtotime($orderDetail->created)) }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<div class="col-xs-12 col-md-12" style="margin-top:20px;">
    <div id="order-flow"></div>
</div>
<style>
 tr {cursor:pointer;}
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $(".order-row").click(function(){
            axios.post('order/flow',{ orderId: this.id}).then(response => {
                console.log( response.data);
                $("#order-flow").html(response.data);
            }).catch(function (error) {
                console.log(error);
            });
        });
    });
</script>
