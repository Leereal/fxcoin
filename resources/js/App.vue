<template>

<!-- Site wrapper -->
<div class="wrapper">
    <Header/>
    <Sidebar/>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">    
        <router-view></router-view> 
    </div>
    <!-- /.content-wrapper -->

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
