<template>
<div>
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

        </tbody>
    </table>
</div>
 <div class="col-xs-12 col-md-12" style="margin-top:20px;">
    <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <th>Created</th><td>{{ this.offerDetails.created }}</td>
                    </tr>
                    <tr>
                        <th>Updated</th><td>{{ this.offerDetails.updated }}</td>
                    </tr>
                    <tr>
                        <th>Options</th><td><button type="button" class="skip-order-step-btn small-button" data-toggle="modal" data-target="#showXml" style="cursor:pointer;">Show XML</button>
                            <button type="button" class="skip-order-step-btn small-button" style="cursor:pointer;" id="note_bt">Edit Note</button>

                                <button type="button" class="skip-order-step-btn small-button" style="cursor:pointer;">Abort</button>
                                <button type="button" class="skip-order-step-btn small-button"  style="cursor:pointer;">Reset</button>
                                <button type="button" class="skip-order-step-btn small-button"  style="cursor:pointer;">Terminate</button>

                        </td>
                    </tr>
                    <tr>
                        <th>Note</th><td><textarea id="txt_note" :class="this.offerDetails.id" rows="3" cols="40" disabled="disabled" v-model="this.offerDetails.note"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
</div>
       <div  v-if="this.offerDetails.offer!=null">
            <table class="table table-striped table-hover">
                <thead class="thead-blue">
                    <tr>
                        <th>ID</th>
                        <th>Primary offer</th>
                    </tr>
                </thead>
                    <tbody v-for="offerDetail in this.offerDetails" :key="offerDetail.id">
                        <tr>
                            <td>{{ offerDetail.offer.id }}</td>
                            <td>{{ offerDetail.offer.name }}</td>
                        </tr>
                </tbody>
            </table>
        </div>

     <div  v-if="this.addons.length>0">
            <table class="table table-striped table-hover">
                <thead class="thead-blue">
                    <tr>
                        <th>ID</th>
                        <th>Addons</th>
                    </tr>
                </thead>
                <tbody v-for="addon in this.addons" :key="addon.id">
                        <tr>
                            <td>{{ addon.id }}</td>
                            <td>{{ addon.name }}</td>
                        </tr>
                </tbody>
            </table>
     </div>

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
      offerDetails:{created:null,
      updated:null,
      id:null,
      note:null,
      offer:null,
      },
      addons:[]

    }
  },
    mounted() {
          this.$root.$on('viewOrderFlowData', orderFlowData => {
          this.OfferDetailsId = orderFlowData.offerDetails.id;
          this.orderFlowDataList = orderFlowData.orderActionDetails;
          this.offerDetails = orderFlowData.offerDetails;
          this.addons = orderFlowData.addons;
          console.log(orderFlowData.addons);
         })
    },
    methods: {

    }
}
</script>
