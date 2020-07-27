<template>

<!-- Site wrapper -->

    <div class="wrapper">
        <Header/>
        <Sidebar/>    
        <router-view></router-view>
        <Footer/>
    </div>

</template>

<script>
    import Header from './inc/Header.vue';
    import Sidebar from './inc/Sidebar.vue';
    import Footer from './inc/Footer.vue';
    export default {
      components:{
          Header,
          Sidebar,
          Footer,
      }
    }
</script>
