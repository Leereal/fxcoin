<template>
    <!-- Content Wrapper. Contains page content -->
    <div>   
        <!-- Main content -->
        <section
            class="content d-flex justify-content-center align-items-center"
        >
            <div class="register-box">
                <div class="register-logo">
                    <a href="../../index2.html">FXCoin</a>
                </div>

                <div class="card">
                    <div class="card-body register-card-body">
                        <p class="login-box-msg">Register a new membership</p>

                        <form @submit.prevent="addValue">
                            <div class="input-group mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="First Name"
                                    v-model="form.name"
                                    :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                                />                                
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                <has-error
                                    :form="form"
                                    field="name"
                                ></has-error>
                            </div>
                            <div class="input-group mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Last Name"
                                    v-model="form.surname"
                                    :class="{
                                        'is-invalid': form.errors.has('surname')
                                    }"
                                />                                
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                <has-error
                                    :form="form"
                                    field="surname"
                                ></has-error>
                            </div>
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
                                    type="text"
                                    class="form-control"
                                    placeholder="Username"
                                    name="username"
                                    v-model="form.username"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'username'
                                        )
                                    }"
                                />                                
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                <has-error
                                    :form="form"
                                    field="username"
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
                            <div class="input-group mb-3">
                                <input
                                    type="password"
                                    class="form-control"
                                    placeholder="Retype password"
                                    v-model="form.confirm_password"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'confirm_password'
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
                                    field="confirm_password"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <select
                                    class="form-control"
                                    id="country"
                                    v-model="form.country"
                                    placeholder="Select Country"
                                    :class="{
                                        'is-invalid': form.errors.has('country')
                                    }"
                                >
                                    <option value="">Select Country</option>
                                    <option
                                        v-for="country in countries"
                                        v-bind:key="country.id"
                                        value="country.name"
                                        >{{ country.name }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="country"
                                ></has-error>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input
                                            type="checkbox"
                                            id="agreeTerms"
                                            name="terms"
                                            value="agree"
                                            v-model="form.terms"
                                            :class="{
                                                'is-invalid': form.errors.has(
                                                    'terms'
                                                )
                                            }"
                                        />

                                        <label for="agreeTerms">
                                            I agree to the <a>terms</a>
                                        </label>
                                        <has-error
                                            :form="form"
                                            field="terms"
                                        ></has-error>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-block"
                                    >
                                        Register
                                    </button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <div class="social-auth-links text-center">
                            <p>- OR -</p>
                            <p>- COMING SOON-</p>
                            <a class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i>
                                Sign up using Facebook
                            </a>
                            <a class="btn btn-block btn-success">
                                <i class="fab fa-twitter mr-2"></i>
                                Sign up using Twitter
                            </a>
                        </div>
                        <router-link to="/login">
                            <p>
                                I already have a membership
                            </p>
                        </router-link>
                    </div>
                    <!-- /.form-box -->
                </div>
                <!-- /.card -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                name: "",
                surname: "",
                username: "",
                password: "",
                email: "",
                cellphone: "",
                country_id: "",
                terms: ""
            }),
            countries: []
        };
    },
    created() {
        this.fetchCountries();
    },
    methods: {
        //---AddValue Function--//
        addValue() {
            this.form
                .post("/api/register")
                .then(data => {
                    Swal.fire(
                        "Registration Successful",
                        "You can login now",
                        "success"
                    ); 
                    this.$router.push({name: 'login'});                   
                })
                .catch(
                    Swal.fire({
                        icon: "error",
                        title: "Failed!",
                        text: "Please try again or refresh page",
                        footer: "Contact Support if you need help"
                    }),
                    err => console.log(err),
                    
                );                
        },
        //---FetchValues Function--//
        fetchCountries(page_url) {
            page_url = page_url || "api/country";
            fetch(page_url) //calling the api url for packages data
                .then(res => res.json())
                .then(res => {
                    this.countries = res.data; //sending data to plans array
                })
                .catch(err => console.log(err));
        }
    }
};
</script>
