<template>
<div class="col-xs-12 col-md-12" style="margin-top:20px;">
    sajin
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
      search: '',
      OfferDetailId : null,

    }
  },
    mounted() {
        this.$root.$on('viewOrderFlowData', orderFlowData => {
          console.log(orderFlowData);
        })
    },
    methods: {

    }
}
</script>
