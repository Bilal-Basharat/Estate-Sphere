<template>
    <form @submit.prevent="sendPasswordLink">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">Email</label>
                <input type="email" class="input" id="email" v-model="form.email" />
                <div class="input-error">  {{ form.errors.email }} </div>
            </div>

            <div class="mt-4">
                <button class="btn-primary w-full" type="submit"> Send </button>
            </div>
        </div>
    </form>

</template>

<script>

import { useForm } from '@inertiajs/vue3';
import MainLayout from '../Layouts/MainLayout.vue';

export default {
    layout: MainLayout
};
</script>

<script setup>
const form = useForm({
    email: null,
})

const sendPasswordLink = () => form.post('/forgot-password');
</script>