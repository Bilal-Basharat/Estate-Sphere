<template>
    <form @submit.prevent="resetPassword">
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
                <label for="password_confirmation" class="label"> Confirm Password </label>
                <input type="password" class="input" id="password_confirmation" v-model="form.password_confirmation" />
                <div class="input-error"> {{form.errors.password_confirmation}} </div>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full" type="submit"> Reset Password </button>
            </div>
        </div>
    </form>

</template>

<script>

import { useForm, Link } from '@inertiajs/vue3';
import MainLayout from '../Layouts/MainLayout.vue';

export default {
    layout: MainLayout
};
</script>

<script setup>

const props = defineProps({
    token: String
})

const form = useForm({
    token: props.token,
    email: null,
    password: null,
    password_confirmation: null
})
const resetPassword = () => form.post('/reset-password');
</script>