<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
      <div class="input-group col-md-3">
          <input type="search" v-model="filter" placeholder="Search for process" value="" autocomplete="off" autofocus="autofocus" spellcheck="false" tabindex="0" height="auto" class="form-control" style="height: 40px;">
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
              class="table table-striped table-hover"
    >
    <template slot="actions" slot-scope="row">
      <b-button size="sm" @click.stop="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>
    </template>
    <template slot="row-details" slot-scope="row">
        <b-card>
            <div align='center'>
                <div id="pcircle"></div>
                <div v-for="(value, key) in row.item.get_actions" :key="key">
                    <hr id="pcircle-line"></hr>
                    <div id="paction-step"><span style="padding:5px 10px; margin:5px 0px; font-weight:bold;">STEP {{key+1}}</span><br> {{ value.name }}</div>
                </div>
                <hr id="pcircle-line"></hr>
                <div id="pcircle"></div>
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
      perPage: 15,
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
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },
    resetModal () {
      this.modalInfo.title = ''
      this.modalInfo.content = ''
    }
  }
}
</script>
<style>
    #pcircle {
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
    #pcircle-line {
        border: 1px solid#000;
        float:left;
        width:20px;
        position: relative;
        top:40px;
    }
    #paction-step {
        border: 1px solid#000;
        float:left;
        /* display:inline-block; */
        padding: 30px 5px;
        text-align: center;
        width:auto;
        margin: 10px 0;
    }
    #show-flow {
        margin: 0 auto;
        display:table;
    }
    .pagination {
    display:flex !important;
    padding-bottom:40px;
  }
</style>