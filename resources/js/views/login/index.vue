<template>
  <div>
    <Nav />
    <div class="container">
      <!---- Navbar -->
      
      <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row justify-content-center">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    </div>
                    <form class="user" @submit.prevent="login">
                      <div class="form-group">
                        <input
                          type="email"
                          class="form-control form-control-user"
                          id="exampleInputEmail"
                          aria-describedby="emailHelp"
                          placeholder="Enter Email Address..."
                          v-model="email"
                        />
                      </div>
                      <div class="form-group">
                        <input
                          type="password"
                          class="form-control form-control-user"
                          id="exampleInputPassword"
                          placeholder="Password"
                          v-model="password"
                        />
                      </div>
                      <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                          <input
                            type="checkbox"
                            class="custom-control-input"
                            id="customCheck"
                          />
                          <label class="custom-control-label" for="customCheck"
                            >Remember Me</label
                          >
                        </div>
                      </div>
                      <button
                        type="submit"
                        class="btn btn-primary btn-user btn-block"
                      >
                        Login
                      </button>
                    </form>
                    <hr />
                    <div class="text-center">
                      <router-link class="small" to="/register"
                        >Create an Account!</router-link
                      >
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
import axios from "axios";
import Nav from "../../components/Nav";
import * as notify from "../../utils/notify.js";
import Vue from 'vue';

export default {
  name: "Login",
  components: {
    Nav,
  },
  data() {
    return {
      email: "",
      password: "",
      
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post("login", {
          email: this.email,
          password: this.password,
        });

        localStorage.setItem("token", response.data.token);
        this.$store.dispatch("user", response.data.user);
        this.$router.push("/admin");
      } catch (error) {
        console.log("error")
        notify.authError(error);
      }
    },
  },
};
</script>

<style>
</style>