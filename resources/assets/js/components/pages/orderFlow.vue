<template>
<div v-if="this.OfferDetailsId!=null">
 <div v-if="showModal">
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Order XML</h4>
                <button type="button" class="close" @click="showModal=false">
                  <span aria-hidden="true">&times;</span>
                </button>

              </div>
              <div class="modal-body">
                <textarea style="width:100%;height:400px;" v-model="this.xml"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
<div class="col-xs-12 col-md-12">
     <h4>Order Flow for {{ this.OfferDetailsId }}
    <a style="float:right; cursor:pointer; font-size:14px;color:#98BCDE;" v-on:click="returnToList()">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> Return to list</a>
    </h4>
    <div class="col-xs-6 col-md-6" >
        <table class="table table-striped table-hover">
            <thead class="thead-blue">
                <tr>
                    <th>Sequence</th>
                    <th>Action</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody v-for="orderActionData in orderActionDataList" :key='orderActionData.step'>

                <tr>
                    <td>{{ orderActionData.step }}</td>
                    <td>{{ orderActionData.action.name }}</td>
                    <td>{{ orderActionData.action_status.name }}</td>
                    <td>
                        <div v-if="orderActionData.action_status.name != 'completed' && orderActionData.action_status.name != 'skipped'">
                            <button type="button" class="skip-order-step-btn small-button">Skip</button>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="col-xs-6 col-md-6" >
        <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th>Created</th><td>{{ this.offerDetails.created | moment("DD.MM.YYYY") }}</td>
                        </tr>
                        <tr>
                            <th>Updated</th><td>{{ this.offerDetails.updated | moment("DD.MM.YYYY") }}</td>
                        </tr>
                        <tr>
                            <th>Options</th><td><button id="show-modal" @click="showModal = true">Show XML</button>
                                    <button id="hide-seen" class="skip-order-step-btn small-button" v-on:click="toggleEditNoteSave" >{{ EditNoteSaveButton.text }}</button>

                                    <!-- <button type="button" class="skip-order-step-btn small-button" style="cursor:pointer;">Abort</button>
                                    <button type="button" class="skip-order-step-btn small-button"  style="cursor:pointer;">Reset</button>
                                    <button type="button" class="skip-order-step-btn small-button"  style="cursor:pointer;">Terminate</button> -->

                            </td>
                        </tr>
                        <tr>
                            <th>Note</th><td><textarea rows="3" cols="40" :disabled="this.validated" v-model="updateOfferDetailsNote"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
    </div>
</div>
<div class="col-xs-12 col-md-12">
    <div  v-if="this.offerDetails.offer!=null">
        <div class="col-xs-6 col-md-6">
            <table class="table table-striped table-hover">
                <thead class="thead-blue">
                    <tr>
                        <th>ID</th>
                        <th>Primary offer</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td>{{ this.offerDetails.offer.id }}</td>
                            <td>{{ this.offerDetails.offer.name }}</td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div  v-if="this.addons.length>0">
        <div class="col-xs-6 col-md-6">
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
 </div>
<div class="col-xs-12 col-md-12" style="margin-top:20px;margin-bottom:50px;" id="show-flow">
    <div v-html="OrderStatusId" v-show="playerCreated"></div>
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
        showModal: false,
      search: '',
      OfferDetailsId : null,
      orderActionDataList : [],
      offerDetails:{created:null,
      updated:null,
      id:null,
      note:null,
      offer:null,
      },
      updateOfferDetailsNote:'',
      addons:[],
      orderStatus:"",
      i:1,
      j:1,
      box_color :'orange',
      text_color:'#000',
      disableButton:1,
      OrderStatusId:"",
      playerCreated:false,
      EditNoteSaveButton: {
      text: 'Edit Note'
    },
      editNote: true,
      validated:true,
      xml:null,
    }
  },
    mounted() {
          this.$root.$on('viewOrderFlowData', orderFlowData => {
          this.OfferDetailsId = orderFlowData.offerDetails.id;
          console.log(orderFlowData.orderActionDetails);
          this.orderActionDataList = orderFlowData.orderActionDetails;
          this.offerDetails = orderFlowData.offerDetails;
          this.addons = orderFlowData.addons;
          this.xml = orderFlowData.xml;
           this.orderStatus = this.orderStatus+'<div id="circle"></div>';
            for (var i=0;i<this.orderActionDataList.length;i++)
            {
                console.log(this.orderActionDataList[i].action_status.name);
                if (this.orderActionDataList[i].action_status.name == 'skipped') {
                        this.box_color = 'orange';
                    } else if (this.orderActionDataList[i].action_status.name == 'completed') {
                        this.box_color = 'green';
                    } else {
                        if (this.i == 1) {
                            this.box_color = 'steelblue';
                        } else {
                            this.box_color = 'red';
                        }
                        this.disableButton = 1;
                        this.i++;
                    }
                    this.orderStatus =this.orderStatus+'<hr id="circle-line"></hr><div id="action-step" style="border:3px solid '+this.box_color+'; color:'+this.box_color+';" data-toggle="tooltip" title="'+this.orderActionDataList[i].action_status.description+'"> <div style="background:'+this.box_color+'; color:#fff; padding:5px 0;">'+this.orderActionDataList[i].action_status.name+'</div> <div id="action-step-div"><span style="padding:5px 10px; margin:5px 0px; font-weight:bold;"> STEP '+this.j+'</span><br> '+this.orderActionDataList[i].action.name+'</div> </div>';
                    this.j++;
            }
         this.playerCreated = true;
         this.orderStatus =this.orderStatus+'<hr id="circle-line"></hr><div id="circle"></div><div style="clear:both;"></div>';
         this.OrderStatusId = this.orderStatus;
         })
    },
    methods: {
    toggleEditNoteSave: function() {
      this.editNote = !this.editNote;
      this.EditNoteSaveButton.text = this.editNote ? 'Edit Note' : 'Save Note';
      if (this.EditNoteSaveButton.text == 'Save Note') {
        this.validated = false;
      } else {
        this.validated = true;
    }
    if (this.validated==true) {

        axios.post('/order/update', { orderId: this.offerDetails.id, orderNote:this.updateOfferDetailsNote }).then(response => {
            console.log(response.data);
        }).catch(function(error) {
            console.log(error);
        });
    }

    },
    returnToList: function ()
    {
        this.$root.$emit('oderListSeen', true);
    }
    }

}
</script>
<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
</style>

