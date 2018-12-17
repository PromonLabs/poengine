<table class="table table-striped table-hover">
    <thead class="thead-blue">
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
                <tr id="{{ $orderDetail->id }}" class="orderrow">
                    <td></td>
                    <td>{{ $orderDetail->id }}</td>
                    <td>-</td>
                    <td>{{ $orderDetail->account_id }}</td>
                    <td>{{ $orderDetail->process->name }}</td>
                    <td>{{ $orderDetail->service_id }}</td>
                    <td>{{ $orderDetail->processStatus->name }}</td>
                    <td>{{ $orderDetail->process_type }}</td>
                    <td>{{ $orderDetail->placed_by }}</td>
                    <td>{{ date("d.m.Y", strtotime($orderDetail->created)) }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<div style="margin-top:20px;">
    <div id="order-flow"></div>
</div>
<style>
 tr {cursor:pointer;}
</style>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".orderrow").click(function(){
            $(".loader").css("display", "block");
            axios.post('/order/flow',{ orderId: this.id}).then(response => {
                console.log( response.data);
                $("#order-flow").html(response.data);
                $(".loader").css("display", "none");
            }).catch(function (error) {
                $(".loader").css("display", "none");
                $("#order-flow").html('No records to show');
                console.log(error);
            });
        });
    });
</script>
