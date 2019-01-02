<template>
<div class="col-xs-12 col-md-12" id="order-default">
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
       <div class="input-group col-md-3">
          <select class="form-control" style="height: 40px; border-radius:5px;" v-model="orderFilterOption" v-on:change="orderFieldSelection">
              <option v-for="orderFilter in orderFilters" :value="orderFilter.value" :key="orderFilter.value">{{ orderFilter.text }}</option>
          </select>
       </div>
      <div class="input-group col-md-3" v-if="isStatus">
          <select class="form-control" style="height: 40px; border-radius:5px;margin-left:10px" v-model="filter" v-on:change="orderStatusSelection">
              <option v-for="statusId in statusIds" :value="statusId.value" :key="statusId.value">{{ statusId.text }}</option>
          </select>
       </div>
      <div class="input-group col-md-3" v-else>
          <input type="search" v-model="filter" placeholder="Search for order" v-on:keyup="searchOrder" value="" autocomplete="off" autofocus="autofocus" spellcheck="false" tabindex="0" height="auto" class="form-control" style="height: 40px; border-radius:5px;margin-left:10px">
       </div>
    </b-row>
<br>
    <!-- Main table element -->
    <b-table show-empty
             stacked="md"
             :items="items"
             :fields="fields"
             :current-page="currentPage"
             :per-page="perPage"
             @filtered="onFiltered"
             @row-clicked="expandAdditionalInfo"
             class="table table-striped table-hover"
    >
    <template slot="external_id" slot-scope="row">{{row.value?'-':'-'}}</template>
    <template slot="created" slot-scope="row">{{ row.value | moment("DD.MM.YYYY") }}</template>
    </b-table>

    <b-row>
      <b-col md="6" class="my-1">
        <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
      </b-col>
    </b-row>

    <!-- Info modal -->
    <b-modal id="modalInfo" @hide="resetModal" :title="modalInfo.title" ok-only>
      <pre>{{ modalInfo.content }}</pre>
    </b-modal>

  </b-container>
  </div>
</template>
<style>
.pagination {
  display:flex !important;
  padding-bottom:40px;
}
</style>
<script>
const items = [];
//const eventOrderFlow = new Vue() // Single event hub
export default {
  data () {
    return {
      items: items,
      tableIsReady: true,
      fields: [
        { key: 'id', label: 'ID', sortable: true},
        { key: 'external_id', label: 'Parent ID', sortable: true, 'class': 'text-center' },
        { key: 'account_id', label: 'Account' },
        { key: 'process.name', label: 'Name' },
        { key: 'service_id', label: 'Service' },
        { key: 'process_status.name', label: 'Status' },
        { key: 'process_type', label: 'Process type' },
        { key: 'placed_by', label: 'Place by' },
        { key: 'created', label: 'Preferred date' },
        { key: 'show_details', label: '' },
      ],
      currentPage: 1,
      perPage: 20,
      totalRows: items.length,
      filter: null,
      orderFilterOption:'id',
      modalInfo: { title: '', content: '' },
      isStatus:false,
      orderFilters: [
            {value: 'id', text: 'ID'},
            {value: 'account_id', text: 'Account'},
            {value: 'process_instance_status_id', text: 'Status'},
            ],

      statusIds: [
            {value: '', text: 'Select Status'},
            {value: '0', text: 'New'},
            {value: '1', text: 'Pending'},
            {value: '2', text: 'Waiting'},
            {value: '3', text: 'Processing'},
            {value: '4', text: 'Failed'},
            {value: '5', text: 'Complete'},
            {value: '6', text: 'Complete with Failures'},
            {value: '7', text: 'Canceled'},
            {value: '8', text: 'Waiting suborder'},
                ],
    }
  },
  mounted() {
        this.toShowOrderList();
    },
  methods: {
    toShowOrderList: function ()
    {
        $("#order-flow").css("display", "none");
        axios.get('/order/list').then(response => {
            this.items = response.data;
            $(".loader").css("display", "none");
        }).catch(function(error) {
            $(".loader").css("display", "none");
            console.log(error);
        });
    },
    info (item, index, button) {
      this.modalInfo.title = `Row index: ${index}`
      this.modalInfo.content = JSON.stringify(item, null, 2)
      this.$root.$emit('bv::show::modal', 'modalInfo', button)
    },
    resetModal () {
      this.modalInfo.title = ''
      this.modalInfo.content = ''
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
      $("#order-flow").html('');
    },
    expandAdditionalInfo (row)
    {
        //row._showDetails = !row._showDetails;
        $("#order-header").css("display", "none");
        $("#order-default").css("display", "none");
        $(".loader").css("display", "block");
          axios.post('/order/flow',{ orderId: row.id}).then(response => {
              this.$root.$emit('viewOrderFlowData', response.data);

           //   $("#order-flow").css("display", "block");
              $(".loader").css("display", "none");
          }).catch(function (error) {
              $(".loader").css("display", "none");
              $("#order-flow").html('No records to show');
              console.log(error);
          });
    },
    searchOrder: function()
    {
        if (this.filter != '') {
                axios.post('/order/search/list', { orderField: this.filter, orderFilterOption: this.orderFilterOption }).then(response => {
                    this.items = response.data;
                }).catch(function(error) {
                    console.log(error);
                });
        } else {
            this.toShowOrderList();
        }
    },
    orderFieldSelection: function()
    {
        if(this.orderFilterOption == 'process_instance_status_id'){
            this.isStatus = true;
            this.filter = '';
            this.toShowOrderList();
        } else {
            this.isStatus = false;
            this.filter = null;
            this.toShowOrderList();
        }
    },
    orderStatusSelection: function()
    {
       this.searchOrder();
    }
  }
}
</script>
