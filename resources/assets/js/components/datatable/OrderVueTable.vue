<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <div class="input-group col-md-3">
          <select class="form-control" style="height: 40px; border-radius:5px; marin-right:10px" v-model="orderFilterOption">
              <option value="id">ID</option>
              <option value="name">Name</option>
              <option value="status">Status</option>
              </select>
       </div>
      <div class="input-group col-md-3">
          <input type="search" v-model="filter" placeholder="Search for order" v-on:keyup="searchOrder" value="" autocomplete="off" autofocus="autofocus" spellcheck="false" tabindex="0" height="auto" class="form-control" style="height: 40px; border-radius:5px;">
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
</template>
<style>
.pagination {
  display:flex !important;
  padding-bottom:40px;
}
</style>
<script>
const items = [];
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
      modalInfo: { title: '', content: '' }
    }
  },
  mounted() {
        this.toShowOrderList();
    },
  methods: {
    toShowOrderList: function ()
    {
        $("#order-flow").css("display", "none");
        axios.get('/order/order/list').then(response => {
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
              $("#order-flow").html(response.data);
              $("#order-flow").css("display", "block");
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
                axios.post('/order/search/list', { orderField: this.filter }).then(response => {
                    this.items = response.data;
                }).catch(function(error) {
                    console.log(error);
                });
            } else {
                this.toShowProcessList();
            }
    }
  }
}
</script>
