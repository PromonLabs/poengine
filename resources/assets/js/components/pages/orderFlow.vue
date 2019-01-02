<template>
<div class="col-xs-12 col-md-12" style="margin-top:20px;">
    <h3>Order Flow for {{ this.OfferDetailsId }}<a id="goBack" style="float:right; cursor:pointer; font-size:14px;color:#98BCDE;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return to list</a></h3>
    <table class="table table-striped table-hover">
        <thead class="thead-blue">
            <tr>
                <th>Sequence</th>
                <th>Action</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody v-for="orderFlow in orderFlowDataList" :key='orderFlow.step'>
            <div id="circle"></div>
            <tr>
                <td>{{ orderFlow.step }}</td>
                <td>{{ orderFlow.action.name }}</td>
                <td>{{ orderFlow.action_status.name }}</td>
                <td>
                    <div v-if="orderFlow.action_status.name != 'completed' && orderFlow.action_status.name != 'skipped'">
                         <button type="button" class="skip-order-step-btn small-button">Skip</button>
                    </div>
                </td>
            </tr>
            <hr id="circle-line"></hr>
                    <div id="action-step" style="border:3px;" data-toggle="tooltip">
                        <div style=" color:#fff; padding:5px 0;">{{orderFlow.action_status.name}}</div>
                        <div id="action-step-div">
                            <span style="padding:5px 10px; margin:5px 0px; font-weight:bold;">
                                STEP </span><br>{{orderFlow.action.name}}
                        </div>
                    </div>
        </tbody>
    </table>
</div>
</template>
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
<script>
    export default {
       data () {
    return {
      search: '',
      OfferDetailsId : null,
      orderFlowDataList : null,

    }
  },
    mounted() {
        this.$root.$on('viewOrderFlowData', orderFlowData => {
          console.log(orderFlowData);
          this.OfferDetailsId = orderFlowData.offerDetails.id;
          this.orderFlowDataList = orderFlowData.orderActionDetails;
        })
    },
    methods: {

    }
}
</script>
