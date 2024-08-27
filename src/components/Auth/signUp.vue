<template>
    <div class="bg-white w-1/2 p-8 mx-auto rounded-md">
        <h2 class="text-2xl font-semibold mb-4">Register</h2>
        <form @submit.prevent="register">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                <input v-model="username" type="text" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input v-model="email" type="text" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input v-model="password" type="password" class="mt-1 p-2 w-full border rounded-md">
            </div>
            <button type="submit" v-on:click="signUp"
                class="bg-green-500 text-white p-2 rounded-md w-full">Register</button>
        </form>
        <div class="mt-4 text-right">
            <router-link to="/" class="text-blue-500">Already have an account? Login here</router-link>
        </div>
    </div>
</template>

<script>
import axios from '@/axios-config'
import { commonFunc } from '@/service/commonFunc';

export default {
    name: 'signUp',
    data() {
        return {
            username: '',
            email: '',
            password: ''
        }
    },
    methods: {
        signUp() {
            if (this.username.length < 3 && this.username.length > 15) {
                commonFunc.showAlert('Error', 'User name must be between 3-15 characters');
                return;
            }
            else if (!commonFunc.isValidEmail(this.email)) {
                commonFunc.showAlert('Error', 'Invalid Email');
                return;
            }
            else if (this.password.length < 4) {
                commonFunc.showAlert('Error', 'Password must be longer than 4 characters');
                return;
            }

            commonFunc.showProgressBar();
            axios.post('/register', {
                email: this.email,
                username: this.username,
                password: this.password
            })
                .then(response => {
                    commonFunc.hideProgressBar();
                    if (response.data.error !== undefined)
                        commonFunc.showAlert('Error', response.data);
                    else
                        this.$router.push('/');
                });
        }
    }
}
</script>