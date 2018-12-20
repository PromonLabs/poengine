<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <div class="input-group col-md-3">
          <input type="search" v-model="filter" placeholder="Search for order" value="" autocomplete="off" autofocus="autofocus" spellcheck="false" tabindex="0" height="auto" class="form-control" style="height: 40px;">
           <span class="input-group-btn">
               <button class="btn btn-info btn-lg" :disabled="!filter">
                   <i class="glyphicon glyphicon-search"></i>
                </button>
            </span>
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
             :filter="filter"
             @filtered="onFiltered"
             @row-clicked="expandAdditionalInfo"
             class="table table-striped"
    >
    <template slot="actions" slot-scope="row">
      <input type="hidden" v-model="_showDetails">
      <b-button size="sm" @click.stop="row.toggleDetails" v-model="row.detailsShowing">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>
    </template>
    <template slot="row-details" slot-scope="row">
        <b-card>
             <div id="order-flow"></div>
        </b-card>
      </template>
       <template slot="external_id" slot-scope="row">{{row.value?'-':'-'}}</template>
       <template slot="created" slot-scope="row">{{ row.value | moment("DD.MM.YYYY") }}</template>
    </b-table>

    <b-row>
      <b-col md="6" class="my-1">
        <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
const items = [];
export default {
  data () {
    return {
      items: items,
      _showDetails:false,
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
        { key: 'actions', label: 'Actions' }
      ],
      currentPage: 1,
      perPage: 10,
      totalRows: items.length,
      filter: null,
    }
  },
  mounted() {
        this.toShowOrderList();
    },
  methods: {
    toShowOrderList: function ()
    {
        axios.get('/order/orderlist').then(response => {
                this.items = response.data;
                $(".loader").css("display", "none");
            }).catch(function(error) {
                $(".loader").css("display", "none");
                console.log(error);
            });
      /* return this.items = [
   { id: 2, parentId: 40, account: 123123, name: 'orderSwap', service: 54546, status: 'complete', processType: 'Broadband', placeBy: 'ex_venchin', preferredDate: '05.12.2018'}
]; */
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
      $("#order-flow").html('');
    },
    expandAdditionalInfo (row)
    {
        this._showDetails = true;
        $(".loader").css("display", "block");
            axios.post('/order/flow',{ orderId: row.id}).then(response => {
                $("#order-flow").html(response.data);
                $(".loader").css("display", "none");
                items._showDetails = !items._showDetails;
            }).catch(function (error) {
                $(".loader").css("display", "none");
                $("#order-flow").html('No records to show');
                console.log(error);
            });
    },
    toggleDetails:function ()
    {
        alert('test');
    }

  }
}
</script>

<!-- table-complete-1.vue -->

