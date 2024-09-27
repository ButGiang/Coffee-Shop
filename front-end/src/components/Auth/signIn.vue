<template>
    <!-- login component -->
    <div class="bg-white w-1/2 p-8 mx-auto rounded-md">
        <h2 class="text-2xl font-semibold mb-4">Login</h2>
        <form @submit.prevent="login">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                <input v-model="username" type="text" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input v-model="password" type="password" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <button v-on:click="signIn" class="bg-blue-500 text-white p-2 rounded-md w-full">Login</button>
        </form>
        <div class="mt-4 text-right">
            <router-link to="/Register" class="text-blue-500">Register here</router-link>
        </div>
    </div>
</template>

<script>
import axios from '@/axios-config'
import { commonFunc } from '@/service/commonFunc'

export default {
    name: 'signIn',
    data() {
        return {
            username: '',
            password: ''
        }
    },
    methods: {
        // login function
        signIn() {
            if (this.username.length == 0 || this.password.length == 0) {
                commonFunc.showAlert('Error', 'Please check your Username or Password again');
                return;
            }

            commonFunc.showProgressBar();
            axios.post('/login', {
                username: this.username,
                password: this.password
            })
                .then(response => {
                    commonFunc.hideProgressBar();
                    if (response.data.error !== undefined)
                        commonFunc.showAlert('Error', response.data);
                    else {
                        const token = response.data.access_token;
                        localStorage.setItem('authToken', token);
                        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                        this.$router.push('/Home');
                    }
                })
                .catch(error => {
                    commonFunc.hideProgressBar();
                    commonFunc.showAlert('Error', error.response.data.error || 'Login failed');
                });
        }
    }
}
</script>