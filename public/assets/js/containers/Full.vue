<template>
  <div class="app">
    <AppHeader/>
    <div class="app-body">
      <Sidebar/>
        <main style="background:#fff;" class="main">
        <breadcrumb :list="list" v-show="!printPreview"/>
        <div class="container-fluid">
          <router-view></router-view>
        </div>
      </main>
      <AppAside/>
    </div>
    <AppFooter v-show="!printPreview"/>
  </div>
</template>

<script>
import AppHeader from '../components/Header'
import Sidebar from '../components/Sidebar'
import AppAside from '../components/Aside'
import AppFooter from '../components/Footer'
import Breadcrumb from '../components/Breadcrumb'

export default {
  name: 'full',
  components: {
    AppHeader,
    Sidebar,
    AppAside,
    AppFooter,
    Breadcrumb
  },
  data () {
    return {
      printPreview: false
    }
  },
  computed: {
    name () {
      return this.$route.name
    },
    list () {
      return this.$route.matched
    }
  },
  created() {
    let self = this;
    EventBus.$on('printPreview', function(data) {
      self.printPreview = data.printPreview;
    });
  }
}
</script>
