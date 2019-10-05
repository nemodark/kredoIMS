<template>
<div class="myLogin bg-gradient-primary">
    <div class="container center-login">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="POST" @submit.prevent="login">
                    
                    <div class="form-group">
                        <input type="email" id="email" :class="['form-control form-control-user', has_error ? 'is-invalid' : '']" placeholder="Email Address" v-model="email">
                    </div>
                    <div class="form-group">
                        <input type="password" id="passsword" :class="['form-control form-control-user', has_error ? 'is-invalid' : '']" v-model="password" placeholder="Password">
                    </div>
                    <div class="text-center form-group" v-if="has_error">
                        <span class="text-danger">{{ error_message }}</span>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-user btn-block" :disabled="logging_in"><i class="fas fa-circle-notch fa-spin" v-if="logging_in"></i> Login
                    </button>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                email: null,
                password: null, 
                has_error: false,
                error_message: null,
                logging_in: false,
            }
        },

        mounted() {
            console.log("hello world")
        },

        methods: {
            login() {
                this.logging_in = true;
                var redirect = this.$auth.redirect();
                var app = this;
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password,
                    },
                    success: function() {
                        this.logging_in = false;
                        //redirect
                        const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 'admin' ? 'admin' : 'manager';

                        this.$router.push({name: redirectTo});
                    },
                    error: function() {
                        this.logging_in = false;
                        // console.log(res);
                        this.has_error = true;
                        this.error_message = "Username or Password is invalid.";
                        this.password = '';
                    }
                });
            }
        }
    }
</script>