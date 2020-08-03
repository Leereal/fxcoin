<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <img
                src=""
                alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3"
                style="opacity: .8"
            />
            <span class="brand-text font-weight-light">FxCoin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img
                        src=""
                        class="img-circle elevation-2"
                        alt="User Image"
                    />
                </div>
                <div class="info">
                    <a href="#" class="d-block">Liberty</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul
                    class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item has-treeview">
                        <router-link to="/dashboard" class="nav-link">
                            <i
                                class="nav-icon fas fa-tachometer-alt text-blue"
                            ></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </router-link>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v1</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <router-link to="/profile" class="nav-link">
                            <i class="nav-icon fas fa-th text-pink"></i>
                            <p>
                                Profile
                                <span class="right badge badge-danger"
                                    >New</span
                                >
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/packages" class="nav-link">
                            <i class="nav-icon fas fa-th text-pink"></i>
                            <p>
                                Packages                               
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/payment-methods" class="nav-link">
                            <i
                                class="nav-icon fas fa-credit-card text-green"
                            ></i>
                            <p>
                                Payment Methods
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/currencies" class="nav-link">
                            <i
                                class="nav-icon fas fa-money-bill-wave-alt text-blue"
                            ></i>
                            <p>
                                Currencies
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/payment-details" class="nav-link">
                            <i
                                class="nav-icon fas fa-info-circle text-blue"
                            ></i>
                            <p>
                                Payment Details
                            </p>
                        </router-link>
                    </li>                  
                    <li class="nav-item">
                        <a
                            href=""
                            class="nav-link"
                            @click.prevent="logout"                            
                        >
                            <i class="nav-icon fas fa-power-off text-red"></i>
                            <p>
                                Logout
                            </p>
                        </a>                        
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>
<script>
    export default {
        name: 'sidebar',
        methods: {
            logout() {
                this.$store.commit('logout');
                this.$router.push('/login');
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser
            }
        }
    }
</script>
