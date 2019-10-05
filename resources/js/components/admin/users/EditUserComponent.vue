<template>
    <div class="card shadow mt-5">
        <div v-show="loading" class="text-center text-primary">
            <i class="fas fa-circle-notch fa-spin fa-2x"></i>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User<router-link to="/admin/users"
                    class="btn btn-danger btn-sm float-right">Go Back</router-link></h6>
        </div>
        <div class="card-body">
                <form @submit.prevent="updateUser">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" value=""  autofocus="autofocus" :class="['form-control', allerrors.email ? 'is-invalid' : '']" type="email" v-model="user.email">
                        <span v-if="allerrors.email" :class="['invalid-feedback']">{{ allerrors.email[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input id="firstname" name="firstname" value=""  autofocus="autofocus" :class="['form-control', allerrors.firstname ? 'is-invalid' : '']" type="text" v-model="user.profile.firstname">
                        <span v-if="allerrors.firstname" :class="['invalid-feedback']">{{ allerrors.firstname[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input id="lastname" name="lastname" value=""  autofocus="autofocus" :class="['form-control', allerrors.lastname ? 'is-invalid' : '']" type="text" v-model="user.profile.lastname">
                        <span v-if="allerrors.lastname" :class="['invalid-feedback']">{{ allerrors.lastname[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input id="contact" name="contact" value=""  autofocus="autofocus" :class="['form-control', allerrors.contact ? 'is-invalid' : '']" type="text" v-model="user.profile.contact">
                        <span v-if="allerrors.contact" :class="['invalid-feedback']">{{ allerrors.contact[0] }}</span>
                    </div>
                    <div class="formm-group">
                        <label for="user_role">Role/Permission</label>
                        <select class="form-control" id="role" name="role" value="" autofocus="autofocus" :class="['form-control', allerrors.user_role ? 'is-invalid' : '']" v-model="user.role">
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="employee">Employee</option>
                        </select>
                        <span v-if="allerrors.user_role" :class="['invalid-feedback']">{{ allerrors.user_role[0] }}</span>
                    </div>
                    <div class="my-3">
                        <button type="submit" class="btn btn-primary float-right">Save changes</button>
                    </div>
                </form>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                user:[],
                role: '',
                loading: false,
                has_error: false,
                error: '',
                allerrors: {},
                success: false,
            }
        },
        created() {
            let uri = `http://kredoims.test/api/users/edit/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                this.user = response.data;
                this.user.role = response.data.role;
                // console.log(this.user);
            })
        },
        methods:{
            updateUser(){
                this.axios.put(`http://kredoims.test/api/users/update/${this.$route.params.id}`, this.user)
                    .then(response => {
                        this.allerrors = [];
                        this.success = true;
                        this.$toast.success({
                            title:`${this.user.email} updated successfully`
                        })
                        this.$router.push({name: 'adminUsers'})
                        // window.location.href = "users";
                    })
                    .catch((error) => {
                        console.log(error.response.data.errors);
                        this.has_error = true;
                        this.error = error.response.data.error
                        this.allerrors = error.response.data.errors;
                        this.success = false;
                    });
            }
        }
    }
</script>