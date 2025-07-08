<template>

<EmptyState> You need to be Verified to view this page </EmptyState>

<div class="text-center"> 
    <Link 
    as="button"
    class="btn-primary"
    :href="`/email/verification-notification`" method="post"> Resend Email Verification </Link>
</div>

</template>

<script setup>

import { Link } from "@inertiajs/vue3";
import EmptyState from "../../components/UI/EmptyState.vue";

</script>

<script>

import MainLayout from "../../Pages/Layouts/MainLayout.vue";

export default {
    layout: MainLayout,
};

</script>