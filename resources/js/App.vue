<template>
    <!-- Site wrapper -->

    <div class="wrapper" id="wrap">
        <template v-if="!currentUser">
            <div id="nav">
                <router-link to="/">Home</router-link> |
                <router-link to="/about">About</router-link> |
                <router-link to="/login">Login</router-link> |
                <router-link to="/register">Register</router-link>
            </div>
            <router-view />
        </template>
        <template v-else>
            <Header />
            <Sidebar />
            <router-view></router-view>
            <Footer />
        </template>
    </div>
</template>

<script>
import Header from "./inc/Header.vue";
import Sidebar from "./inc/Sidebar.vue";
import Footer from "./inc/Footer.vue";

export default {
    components: {
        Header,
        Sidebar,
        Footer
    },
    computed: {
        currentUser() {
            return this.$store.getters.currentUser;
        }
    }
};
</script>

<style>
#wrap {
  font-family: "Nunito", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;  
  color: #2c3e50;
  font-size: 0.8rem;
  line-height: 1.6;
}

#nav {
  padding: 30px;
  text-align: center;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
