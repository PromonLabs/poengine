<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <div class="input-group col-md-3">
          <input type="search" v-model="filter" v-on:keyup="searchProcess" placeholder="Search for process" value="" autocomplete="off" autofocus="autofocus" spellcheck="false" tabindex="0" height="auto" class="form-control" style="height: 40px; border-radius:5px;">
      </div>
    </b-row>
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
    <template slot="actions" slot-scope="row" >
        <b-link :to="{ path: 'process/edit/'+ row.item.name }"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></b-link>
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
        { key: 'priority', label: 'Priority', sortable: true },
        { key: 'xsd_filename', label: 'XSD Filename', sortable: true },
        { key: 'callback_num_required', label: 'Callback Required', sortable: true },
        { key: 'actions', label: 'Actions' }
       ],
      currentPage: 1,
      perPage: 15,
      totalRows: items.length,
      filter: null,
      props:'',
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
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },
    resetModal () {
      this.modalInfo.title = ''
      this.modalInfo.content = ''
    },
    expandAdditionalInfo (row)
    {
        //this.$router.push('/api/process/details/'+row.name);
       $(".loader").css("display", "block");
       $("#process-header").css("display", "none");
        $("#process-default").css("display", "none");
        axios.post('/process/list', { processName: row.name }).then(response => {
            console.log(response.data);
            $("#process-details").html(response.data);
            $("#process-details").css("display", "block");
            $(".loader").css("display", "none");
        }).catch(function(error) {
            $(".loader").css("display", "none");
            console.log(error);
        });
    },
    searchProcess: function()
    {
        if (this.filter != '') {
                axios.post('/process/search/list', { processFilter: this.filter }).then(response => {
                    console.log(response.data);
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
<style>
.table tr {
    cursor: pointer;
}
.pagination {
    display:flex !important;
    padding-bottom:40px;
}
.fa-pencil-square-o {
    font-size:18px !important;
}
</style>
