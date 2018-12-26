<template>
     <div class="content-wrapper" style="margin-top:20px;">
         <a id="goBack" style="float:right; cursor:pointer; margin:10px;font-size:14px;color:#98BCDE;" @click="$router.go(-1)"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return to list</a>
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="toshowalert" v-if="seen" style="color:#fff;padding:5px; font-weight:bold; text-align:center; background:green;"></div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" v-model="item.name">
                        <input type="hidden" class="form-control" id="id" name="id" v-model="item.id">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" v-model="item.description">
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority:</label>
                        <select class="form-control" v-model="item.priority" id="priority" name="priority">
                            <option value="0">0</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="xsd">XSD File Name:</label>
                        <input type="text" class="form-control" id="xsd" v-model="item.xsd_filename" >
                    </div>
                    <div class="form-group">
                        <label for="callback">Callback Required:</label>
                    <select class="form-control" v-model="item.callback_num_required" id="callback">
                            <option value="0">0</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default" v-on:click="seen = !seen" @click="toUpdateProcess">Update</button>
                </div>
            </div>
        </section>
    </div>
</template>
<script src="/assets/lib/bootbox/bootbox.min.js" type="text/javascript"></script>
<script>
    export default {
       data () {
    return {
        seen:false,
        item:[{
            id:'',
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
            axios.post('/process/edit', { processName: name }).then(response => {
               this.item = response.data[0];
               console.log(this.items);
            }).catch(function(error) {
                console.log(error);
            });
        },
        toUpdateProcess: function ()
        {
            axios.post('/process/update', { processId: $("#id").val(), processName: $("#name").val(), processDescription:$("#description").val(), processPriority:$("#priority").val(), processXsd:$("#xsd").val(), processCallback:$("#callback").val() }).then(response => {
                console.log(response.data);
                $(".toshowalert").text('Updated Successfully');
                this.seen=true;
            }).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>

