<template>
    <div class="card shadow mt-5">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Brands <b-button v-b-modal.addBrandModal class="btn btn-sm float-right" variant="primary">Add
                    Brand</b-button></h6>
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
                            <th>Brand</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="brand in brands" :key="brand.id">
                            <td>{{ brand.id }}</td>
                            <td>{{ brand.brand_name }}</td>
                            <td>
                                <b-button class="btn btn-info" @click="editBrand(brand.id, brand.brand_name)">Edit</b-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add Brand Modal -->
            <b-modal id="addBrandModal" ref="modal" title="Add Category" @show="resetModal" @hidden="resetModal" @ok="handleOk">
                <form ref="form" @submit.stop.prevent="addBrand">
                    <div class="form-group">
                        <label for="brand_name">Brand</label>
                        <input type="text" name="brand_name" id="brand_name" v-model="brand.brand_name" :class="['form-control', allerrors.brand_name ? 'is-invalid' : '']">
                        <span v-if="allerrors.brand_name" :class="['invalid-feedback']">{{ allerrors.brand_name[0] }}</span>
                    </div>
                </form>
            </b-modal>
            <!-- / Add Brand Modal -->

            <!-- Edit Brand Modal -->
            <b-modal id="editBrandModal" ref="edit-modal" title="Edit Brand" @show="resetModal" @hidden="resetModal" @ok="updateBrand">
                <form ref="form" @submit.stop.prevent="updateBrand">
                    <div class="form-group">
                        <label for="brand_name">Brand</label>
                        <input type="text" name="brand_name" id="brand_name" value="" :class="['form-control', allerrors.brand_name ? 'is-invalid' : '']"  v-model="brand_name">
                        <span v-if="allerrors.brand_name" :class="['invalid-feedback']">{{ allerrors.brand_name[0] }}</span>
                    </div>
                </form>
            </b-modal>
            <!-- / Edit Brand Modal -->
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                brands: [],
                brand: {},
                loading: false,
                content: true,
                allerrors: [],
                success: false,
                brand_name: '',
                id: '',
            }
        },
        created() {
            this.loading = true;
            this.content = false;
            let uri = "http://kredoims.test/api/brands";
            this.axios.get(uri).then(response => {
                this.content = true;
                this.loading = false;
                this.brands = response.data.data;
            });
        },
        methods: {
            resetModal() {
                //
            },
            handleOk(e) {
                e.preventDefault();
                this.addBrand();
            },
            //addBrand
            addBrand() {
                let uri = "http://kredoims.test/api/brands/add";
                this.axios.post(uri, this.brand)
                    .then(response => {
                        this.allerrors = [];
                        this.brand.brand_name = '';
                        this.success = true;
                        this.$toast.success({
                            title: 'Success',
                            message: 'Brand added successfully'
                        });
                        this.$refs.modal.hide();
                        this.reload();
                    })
                    .catch((error) => {
                        console.log(error.response.data.errors);
                        this.allerrors = error.response.data.errors;
                        this.success = false;
                    });
            },
            //Display the brand to be updated
            editBrand(id, brand) {
                this.id = id;
                this.brand_name = brand;
                this.$refs['edit-modal'].show();
            },
            //Update brand
            updateBrand(e) {
                e.preventDefault();
                let data = {brand_name: this.brand_name};
                this.axios.put(`http://kredoims.test/api/brands/update/${this.id}`, data)
                    .then(response => {
                        this.allerrors = [];
                        this.category_name = '';
                        this.id = '';
                        this.success = true;
                        this.$toast.success({
                            title: 'Success',
                            message: 'Brand updated successfully'
                        });
                        this.$refs['edit-modal'].hide();
                        this.reload();
                    })
                    .catch((error) => {
                        this.allerrors = error.response.data.errors;
                        this.success = false;
                    })
            },
            reload() {
                this.loading = true;
                this.content = false;
                let uri = "http://kredoims.test/api/brands";
                this.axios.get(uri).then(response => {
                    this.content = true;
                    this.loading = false;
                    this.brands = response.data.data;
                })
            }
        }
    }

</script>
