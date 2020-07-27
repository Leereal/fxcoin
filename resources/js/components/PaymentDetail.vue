<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Payment Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link to="/dashboard" class="nav-link"
                                    >Home</router-link
                                >
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payment Detail</h3>

                    <div class="card-tools">
                        <button
                            class="btn btn-primary btn-sm"
                            data-toggle="modal"
                            data-target="#addModal"
                            type="button"
                        >
                            <i class="fa fa-plus"></i> Create
                        </button>
                        <button
                            type="button"
                            class="btn btn-tool"
                            data-card-widget="collapse"
                            title="Collapse"
                        >
                            <i class="fas fa-minus"></i>
                        </button>
                        <button
                            type="button"
                            class="btn btn-tool"
                            data-card-widget="remove"
                            title="Remove"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">IP Address</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Account Number</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="payment_detail in payment_details"
                                v-bind:key="payment_detail.id"
                            >
                                <th scope="row">{{ payment_detail.id }}</th>
                                <td>{{ payment_detail.first_name }}</td>
                                <td>{{ payment_detail.surname }}</td>
                                <td>{{ payment_detail.ipAddress }}</td>
                                <td>{{ payment_detail.payment_method }}</td>
                                <td>{{ payment_detail.account_number }}</td>
                                <td>
                                    <span
                                        data-toggle="modal"
                                        data-target="#addModal"
                                    >
                                        <button
                                            @click="editValue(payment_detail)"
                                            class="btn btn-success btn-sm rounded-0"
                                            type="button"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Edit"
                                            data-original-title="Edit"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </span>
                                    <button
                                        @click="deleteValue(payment_detail.id)"
                                        class="btn btn-danger btn-sm rounded-0"
                                        type="button"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Delete"
                                        data-original-title="Delete"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li
                                v-bind:class="[
                                    { disabled: !pagination.prev_page_url }
                                ]"
                                class="page-item"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click="
                                        fetchValues(pagination.prev_page_url)
                                    "
                                    >Previous</a
                                >
                            </li>
                            <li class="page-item disabled">
                                <a class="page-link text-dark" href="#"
                                    >Page {{ pagination.current_page }} of
                                    {{ pagination.last_page }}</a
                                >
                            </li>
                            <li
                                v-bind:class="[
                                    { disabled: !pagination.next_page_url }
                                ]"
                                class="page-item"
                            >
                                <a
                                    class="page-link"
                                    href="#"
                                    @click="
                                        fetchValues(pagination.next_page_url)
                                    "
                                    >Next</a
                                >
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
        <!-- Add Modal -->
        <div
            class="modal fade"
            id="addModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addModalTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-primary">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalTitle">
                            Add Payment Details
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="addValue" id="addValue">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="payment_method"
                                    >Payment Method</label
                                >
                                <select
                                    class="form-control"
                                    id="payment_method"
                                    v-model="form.payment_method"
                                    name="payment_method"
                                    :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                                >
                                    <option value=""
                                        >Select Payment Method</option
                                    >
                                    <option
                                        v-for="payment_method in payment_methods"
                                        v-bind:key="payment_method.id"
                                        value="payment_method.name"
                                        >{{ payment_method.name }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="payment_method"
                                ></has-error>
                            </div>
                            <div class="form-group">
                                <label for="account_number"
                                    >Account Number</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="account_number"
                                    name="account_number"
                                    v-model="form.account_number"
                                />
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-outline-light"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <button type="submit" class="btn btn-outline-light">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                id: "",
                payment_method: "",
                account_number: ""
            }),
            payment_details: [],
            payment_methods: [],

            pm_id: "",
            pagination: {},
            edit: false
        };
    },
    created() {
        this.fetchValues(); //Calling function/method to output data after component created
        this.fetchPM();
    },
    methods: {
        //---FetchValues Function--//
        fetchValues(page_url) {
            let vm = this;
            page_url = page_url || "api/payment-detail";
            fetch(page_url) //calling the api url for packages data
                .then(res => res.json())
                .then(res => {
                    this.payment_details = res.data; //sending data to plans array
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
        },
        //---End FetchValues Function--//
        //---Pagination Function--//
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };
            this.pagination = pagination;
        },
        //---End Pagination Function--//
        //---Delete Function--//
        deleteValue(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.value) {
                    fetch("api/payment-detail/" + id, {
                        method: "delete"
                    })
                        .then(res => res.json())
                        .then(data => {
                            Swal.fire(
                                "Deleted!",
                                "Your file has been deleted.",
                                "success"
                            );
                            this.fetchValues();
                        })
                        .catch(
                            Swal.fire({
                                icon: "error",
                                title: "Failed!",
                                text: "Please try again or refresh page",
                                footer: "Contact Support if you need help"
                            }).then(this.fetchValues())
                        );
                }
            });
        },
        //---End Delete Function--//
        //---AddValue Function--//
        addValue() {
            if (this.edit === false) {
                //Add Values
                this.form
                    .post("/api/payment-detail")
                    .then(data => {
                        this.form.payment_method = "";
                        this.form.account_number = "";
                        Swal.fire(
                            "Good job!",
                            "You clicked the button!",
                            "success"
                        );
                        this.fetchValues();
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
                //End Add Values
            } else {
                //Update Values
                this.form

                    .put("/api/payment-detail/" + this.form.id)
                    .then(data => {
                        this.form.payment_method = "";
                        this.form.account_number = "";
                        Swal.fire("Good job!", "Saved Successfully", "success");
                        this.fetchValues();
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
            //End Update Values
        },
        //---End AddValue Function--//
        //---End EditValue Function--//
        editValue(form) {
            this.edit = true;
            this.form.id = form.id;
            this.form.payment_method = form.payment_method;
            this.form.account_number = form.account_number;
        },
        //---End EditValue Function--//
        //---FetchValues Function--//
        fetchPM(page_url) {
            page_url = page_url || "api/payment-method";
            fetch(page_url) //calling the api url for packages data
                .then(res => res.json())
                .then(res => {
                    this.payment_methods = res.data; //sending data to plans array
                })
                .catch(err => console.log(err));
        }
        
    }
};
</script>
