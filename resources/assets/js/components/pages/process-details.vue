<template>
     <div class="content-wrapper" style="margin-top:20px;">
         <a id="goBack" style="float:right; cursor:pointer; margin:10px;font-size:14px;color:#98BCDE;" @click="$router.go(-1)"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return to list</a>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <form action="/api/process">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" v-model="item.name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" id="description" v-model="item.description">
                        </div>
                        <div class="form-group">
                            <label for="priority">Priority:</label>
                            <select class="form-control" v-model="item.priority">
                                <option value="0">0</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="xsd">XSD File Name:</label>
                            <input type="text" class="form-control" id="xsd" v-model="item.xsd_filename">
                        </div>
                        <div class="form-group">
                            <label for="callback">Callback Required:</label>
                        <select class="form-control" v-model="item.callback_num_required">
                                <option value="0">0</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Update</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
       data () {
    return {
        item:[{
            name:'',
            description:'',
            priority:'',
            xsd:'',
            callback:''
        }]
    }
  },
    mounted() {
        this.toShowProcessDetails(this.$route.params.name);
    },
    methods: {
        toShowProcessDetails(name)
        {
            axios.post('/process/list', { processName: name }).then(response => {
               this.item = response.data[0];
               }).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>

