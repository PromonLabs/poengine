<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>

      <b-col md="5" class="my-1">
        <b-form-group horizontal  class="mb-0" >
          <b-input-group>
            <b-form-input v-model="filter" placeholder="Type to Search" />
            <b-input-group-append>
              <b-btn :disabled="!filter" @click="filter = ''" class="glyphicon glyphicon-search"></b-btn>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
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
       <template slot="external_id" slot-scope="row">{{row.value?'-':'-'}}</template>
    </b-table>

   <!--  <b-row>
      <b-col md="6" class="my-1">
        <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
      </b-col>
    </b-row> -->

    <!-- Info modal -->
    <b-modal id="modalInfo" @hide="resetModal" :title="modalInfo.title" ok-only>
      <pre>{{ modalInfo.content }}</pre>
    </b-modal>

  </b-container>
</template>

<script>
const items = [];
export default {
  data () {
    return {
      items: items,
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
      ],
      currentPage: 1,
      perPage: 10,
      totalRows: items.length,
      filter: null,
      modalInfo: { title: '', content: '' }
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
        $(".loader").css("display", "block");
            axios.post('/order/flow',{ orderId: row.id}).then(response => {
                console.log( response.data);
                $("#order-flow").html(response.data);
                $(".loader").css("display", "none");
            }).catch(function (error) {
                $(".loader").css("display", "none");
                $("#order-flow").html('No records to show');
                console.log(error);
            });
    }
  }
}
</script>

<!-- table-complete-1.vue -->

