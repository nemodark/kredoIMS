<template>
    <div class="card shadow mt-5">
        <div v-show="loading" class="text-center text-primary">
            <i class="fas fa-circle-notch fa-spin fa-2x"></i>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add User<router-link to="/admin/users"
                    class="btn btn-danger btn-sm float-right">Go Back</router-link></h6>
        </div>
        <div class="card-body">
                <form @submit.prevent="addUser">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" name="email" value=""  autofocus="autofocus" :class="['form-control', allerrors.email ? 'is-invalid' : '']" type="email" v-model="user.email">
                        <span v-if="allerrors.email" :class="['invalid-feedback']">{{ allerrors.email[0] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" value=""  autofocus="autofocus" :class="['form-control', allerrors.password ? 'is-invalid' : '']" type="password" v-model="user.password">
                        <span v-if="allerrors.password" :class="['invalid-feedback']">{{ allerrors.password[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" value=""  autofocus="autofocus" :class="['form-control', allerrors.password_confirmation ? 'is-invalid' : '']" type="password" v-model="user.password_confirmation">
                        <span v-if="allerrors.password_confirmation" :class="['invalid-feedback']">{{ allerrors.password_confirmation[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input id="firstname" name="firstname" value=""  autofocus="autofocus" :class="['form-control', allerrors.firstname ? 'is-invalid' : '']" type="text" v-model="user.firstname">
                        <span v-if="allerrors.firstname" :class="['invalid-feedback']">{{ allerrors.firstname[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input id="lastname" name="lastname" value=""  autofocus="autofocus" :class="['form-control', allerrors.lastname ? 'is-invalid' : '']" type="text" v-model="user.lastname">
                        <span v-if="allerrors.lastname" :class="['invalid-feedback']">{{ allerrors.lastname[0] }}</span>
                    </div>

                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input id="contact" name="contact" value=""  autofocus="autofocus" :class="['form-control', allerrors.contact ? 'is-invalid' : '']" type="text" v-model="user.contact">
                        <span v-if="allerrors.contact" :class="['invalid-feedback']">{{ allerrors.contact[0] }}</span>
                    </div>
                    <div class="formm-group">
                        <label for="user_role">Role/Permission</label>
                        <select class="form-control" id="user_role" name="user_role" value=""  autofocus="autofocus" :class="['form-control', allerrors.user_role ? 'is-invalid' : '']" v-model="user.user_role">
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
                user:{},
                loading: false,
                has_error: false,
                error: '',
                allerrors: {},
                success: false,
            }
        },
        methods:{
            addUser(){
                console.log(this.user)
                this.axios.post('http://kredoims.test/api/users/add', this.user)
                    .then(response => {
                        this.allerrors = [];
                        this.user.email = '';
                        this.user.password = '';
                        this.user.password_confirmation = '';
                        this.user.firstname = '';
                        this.user.lastname = '';
                        this.user.contact = '';
                        this.user.user_role = '';
                        this.success = true;
                        this.$toast.success({
                            message:'User added successfully'
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