<template>
    <div class="card shadow mt-5">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Categories <b-button v-b-modal.addCategoryModal class="btn btn-sm float-right" variant="primary">Add
                    Category</b-button></h6>
        </div>
        <div class="card-body">
            <div v-show="loading" class="text-center text-primary">
                <i class="fas fa-circle-notch fa-spin fa-2x"></i>
            </div>
            <div class="table-responsive" v-show="content">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="category in categories" :key="category.id">
                            <td>{{ category.id }}</td>
                            <td>{{ category.category_name }}</td>
                            <td>
                                <b-button class="btn btn-info" @click="editCategory(category.id, category.category_name)">Edit</b-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add Category Modal -->
            <b-modal id="addCategoryModal" ref="modal" title="Add Category" @show="resetModal" @hidden="resetModal" @ok="handleOk">
                <form ref="form" @submit.stop.prevent="handleSubmit">
                    <div class="form-group">
                        <label for="category_name">Category</label>
                        <input type="text" name="category_name" id="category_name" v-model="category.category_name" :class="['form-control', allerrors.category_name ? 'is-invalid' : '']">
                        <span v-if="allerrors.category_name" :class="['invalid-feedback']">{{ allerrors.category_name[0] }}</span>
                    </div>
                </form>
            </b-modal>
            <!-- / Add Category Modal -->

            <!-- Edit Category Modal -->
            <b-modal id="editCategoryModal" ref="edit-modal" title="Edit Category" @show="resetModal" @hidden="resetModal" @ok="updateCategory">
                <form ref="form" @submit.stop.prevent="updateCategory">
                    <div class="form-group">
                        <label for="category_name">Category</label>
                        <input type="text" name="category_name" id="category_name" value="" :class="['form-control', allerrors.category_name ? 'is-invalid' : '']"  v-model="category_name">
                        <span v-if="allerrors.category_name" :class="['invalid-feedback']">{{ allerrors.category_name[0] }}</span>
                    </div>
                </form>
            </b-modal>
            <!-- / Edit Category Modal -->
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [],
                category: {},
                loading: false,
                content: true,
                test: 0,
                allerrors: {},
                success: false,
                has_error: false,
                error: '',
                category_name: '',
                id: ''
            }
        },
        created() {
            this.loading = true;
            this.content = false;
            let uri = "http://kredoims.test/api/categories";
            this.axios.get(uri).then(response => {
                this.content = true;
                this.loading = false;
                this.categories = response.data;
            })
        },
        methods: {
            resetModal() {
                this.category_name = '';
                // this.category.category_id = '';
                console.log(this.category);
            },
            handleOk(e) {
                e.preventDefault();
                this.handleSubmit()
            },
            //add Category
            handleSubmit() {
                let uri = "http://kredoims.test/api/categories/add";
                this.axios.post(uri, this.category)
                    .then(response => {
                        this.allerrors = [];
                        this.category.category_name = '';
                        this.success = true;
                        this.$toast.success({
                            title: 'Success',
                            message:'Category added successfully'
                        });
                        this.$refs.modal.hide();
                        this.reload();
                    })
                    .catch((error) => {
                        console.log(error.response.data.errors);
                        this.has_error = true;
                        this.error = error.response.data.error
                        this.allerrors = error.response.data.errors;
                        this.success = false;
                    });
            },
            //Display the category to update
            editCategory(id, name) {
                this.id = id;
                this.$refs['edit-modal'].show();
                this.category_name = name;
                console.log(this.category.category_name);
            },
            //Update category
            updateCategory(e) {
                e.preventDefault();
                let data = {category_name: this.category_name};
                this.axios.put(`http://kredoims.test/api/categories/update/${this.id}`, data)
                    .then(response => {
                        this.allerrors = [];
                        this.category.category_name = '';
                        this.category.category_id = '';
                        this.success = true;
                        this.$toast.success({
                            title: 'Success',
                            message: 'Category updated successfully'
                        });
                        this.$refs['edit-modal'].hide();
                        this.reload();
                    })
                    .catch((error) => {
                        console.log(error.response.data.errors);
                        this.has_error = true;
                        this.error = error.response.data.error;
                        this.allerrors = error.response.data.errors;
                        this.success = false;
                    })
            },
            //reload the page after updating
            reload() {
                this.loading = true;
                this.content = false;
                let uri = "http://kredoims.test/api/categories";
                this.axios.get(uri).then(response => {
                    this.content = true;
                    this.loading = false;
                    this.categories = response.data;
                })
            }
        }
    }

</script>
