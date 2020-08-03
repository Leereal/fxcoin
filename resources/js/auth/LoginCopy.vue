<template>
    <!-- Content Wrapper. Contains page content -->
    <div>
        <!-- Main content -->
        <section
            class="content d-flex justify-content-center align-items-center"
        >
            <div class="login-box">
                <div class="login-logo">
                    <a href="../../index2.html">FXCoin</a>
                </div>
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">
                            {{welcome}}
                        </p>

                        <form @submit.prevent="addValue">
                            <div class="input-group mb-3">
                                <input
                                    type="email"
                                    class="form-control"
                                    placeholder="Email"
                                    v-model="form.email"
                                    :class="{
                                        'is-invalid': form.errors.has('email')
                                    }"
                                />
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <has-error
                                    :form="form"
                                    field="email"
                                ></has-error>
                            </div>
                            <div class="input-group mb-3">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Password"
                                    v-model="form.password"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'password'
                                        )
                                    }"
                                />
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                <has-error
                                    :form="form"
                                    field="password"
                                ></has-error>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember" />
                                        <label for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-block"
                                    >
                                        Sign In
                                    </button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <div class="social-auth-links text-center mb-3">
                            <p>- OR -</p>
                            <p>- COMING SOON -</p>
                            <a class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> Sign in
                                using Facebook
                            </a>
                            <a class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> Sign in
                                using Google+
                            </a>
                        </div>
                        <!-- /.social-auth-links -->

                        <p class="mb-1">
                            <a href="forgot-password.html"
                                >I forgot my password</a
                            >
                        </p>

                        <router-link to="/register">
                            <p>
                                Register a new membership
                            </p>
                        </router-link>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</template>

<script>
//import {login} from '../../helpers/auth';
export default {
    name: "login",
    data() {
        return {
            form: new Form({
                email: "",
                password: ""
            }),
        };
    },
    methods: {
        //---AddValue Function--//
        addValue() {
            this.form
                .post("/api/login")
                .then(data => {
                    Swal.fire("Logged Successful", "Done", "success");
                    //this.$router.push({name: 'login'});
                    console.log(data);
                })
                .catch(
                    Swal.fire({
                        icon: "error",
                        title: "Failed!",
                        text: "Please try again or refresh page",
                        footer: "Contact Support if you need help"
                    }),
                    err => console.log(err)
                );
        }
    },
    computed:{
        welcome(){
            return this.$store.getters.welcome
        }
    }
};
</script>
