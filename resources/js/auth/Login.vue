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
                            Sign in to start your session
                        </p>

                        <form @submit.prevent="authenticate">
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
                            <div class="form-group mb-3" v-if="authError">
                                <p class="error">
                                    {{ authError }}
                                </p>
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
                                        <input
                                            type="checkbox"
                                            id="remember_me"
                                            v-model="form.remember_me"
                                        />
                                        <label for="remember_me">
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
import { login } from "../helpers/auth";
export default {
    name: "login",
    data() {
        return {
            form: new Form({
                email: "",
                password: "",
                remember_me: ""
            }),
            error: null
        };
    },
    methods: {
        //---AddValue Function--//
        authenticate() {
            this.form
                .post("/api/validated")
                .then(data => {
                    this.$store.dispatch("login");
                    login(this.$data.form)
                        .then(res => {
                            this.$store.commit("loginSuccess", res);
                            this.$router.push({ path: "/dashboard" });
                        })
                        .catch(error => {
                            this.$store.commit("loginFailed", { error });
                        });
                })
                .catch(err => console.log(err));
        }
    },
    computed: {
        authError() {
            return this.$store.getters.authError;
        }
    }
};
</script>
<style scoped>
.error {
    text-align: center;
    color: red;
}
</style>
