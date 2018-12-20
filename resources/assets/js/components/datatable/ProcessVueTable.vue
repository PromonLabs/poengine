<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <div class="input-group col-md-3">
          <input type="search" v-model="filter" placeholder="Search for process" value="" autocomplete="off" autofocus="autofocus" spellcheck="false" tabindex="0" height="auto" class="form-control" style="height: 46px;">
           <span class="input-group-btn">
               <button class="btn btn-info btn-lg" :disabled="!filter">
                   <i class="glyphicon glyphicon-search"></i>
                </button>
            </span>
       </div>
    </b-row>
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
      <b-button size="sm" @click.stop="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>
    </template>
    <template slot="row-details" slot-scope="row">
        <b-card>
            <div align='center'>
                <div id="circle"></div>
                <div v-for="(value, key) in row.item.get_actions" :key="key">
                    <hr id="circle-line"></hr>
                    <div id="action-step"><span style="padding:5px 10px; margin:5px 0px; font-weight:bold;">STEP {{key+1}}</span><br> {{ value.name }}</div>
                </div>
                <hr id="circle-line"></hr>
                <div id="circle"></div>
                <div style="clear:both;"></div>
            </div>
        </b-card>
      </template>
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

<script>
const items = [];
export default {
  data () {
    return {
      items: items,
      fields: [
        { key: 'name', label: 'Process', sortable: true},
        { key: 'description', label: 'Description', sortable: true },
        { key: 'actions', label: 'Actions' }
       ],
      currentPage: 1,
      perPage: 10,
      totalRows: items.length,
      filter: null,
      modalInfo: { title: '', content: '' }
    }
  },
  mounted() {
        this.toShowProcessList();
    },
  methods: {
    toShowProcessList: function ()
    {
        axios.get('/process').then(response => {
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
      this.modalInfo.title = 'Test'
      this.modalInfo.content = 'Test Two'
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

<style>
.modal.show { display:block; }
</style>