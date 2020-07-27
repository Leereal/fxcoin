<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Currencies</h1>
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
                    <h3 class="card-title">Currencies</h3>

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
                                <th scope="col">Name</th>
                                <th scope="col">Symbol</th>                               
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="currency in currencies" v-bind:key="currency.id">
                                <th scope="row">{{ currency.id }}</th>
                                <td>{{ currency.name }}</td>
                                <td>{{ currency.symbol }}</td>                               
                                <td>
                                    <span
                                        data-toggle="modal"
                                        data-target="#addModal"
                                    >
                                        <button
                                            @click="editValue(currency)"
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
                                        @click="deleteValue(currency.id)"
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
                            Add Currency
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
                    <form @submit.prevent="addValue">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    placeholder="Name"
                                    v-model="form.name"
                                />
                            </div>
                            <div class="form-group">
                                <label for="symbol">Symbol</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="symbol"
                                    name="symbol"
                                    placeholder="Symbol"
                                    v-model="form.symbol"
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
                name: "",
                symbol: "",                
            }),
            currencies: [],
            pagination: {},
            edit: false
        };
    },
    created() {
        this.fetchValues(); //Calling function/method to output data after component created
    },
    methods: {
        //---FetchValues Function--//
        fetchValues(page_url) {
            let vm = this;
            page_url = page_url || "api/currency";
            fetch(page_url) //calling the api url for packages data
                .then(res => res.json())
                .then(res => {
                    this.currencies = res.data; //sending data to plans array
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
                    fetch("api/currency/" + id, {
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
                    .post("/api/currency")
                    .then(data => {
                        this.form.name = "";
                        this.form.symbol = ""; 
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
                
                    .put("/api/currency/" + this.form.id)                    
                    .then(data => {
                        this.form.id = "";
                        this.form.name = "";
                        this.form.symbol = "";                        
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
            this.form.name = form.name;
            this.form.symbol = form.symbol;            
        }
        //---End EditValue Function--//
    }
};
</script>
