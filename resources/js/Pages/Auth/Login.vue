<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">Email</label>
                <input type="email" class="input" id="email" v-model="form.email" />
                <div class="input-error">  {{ form.errors.email }} </div>
            </div>
            <div class="mt-4">
                <label for="password" class="label"> Password </label>
                <input type="password" class="input" id="password" v-model="form.password" />
                <div class="input-error"> {{form.errors.password}} </div>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full" type="submit"> Login </button>
            </div>
        </div>
    </form>

     <div class="mt-4 text-center">
        Don't have an account? 
        <Link href="/user-account/create" class="text-blue-500"> Click Here </Link>
    </div>
</template>

<script>

import { useForm, Link } from '@inertiajs/vue3';
import MainLayout from '../Layouts/MainLayout.vue';

export default {
    layout: MainLayout
};
</script>

<script setup>
const form = useForm({
    email: null,
    password: null
})
const login = () => form.post('/login');
</script>