<template>
    <h1 class="text-3xl mb-4 font-bold">Your Listings</h1>

    <section class="flex mb-8">
        <RealtorFilter />
    </section>

    <section v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <Listing
            v-for="listing in listings.data"
            :key="listing.id"
            :listing="listing"
        />
    </section>

    <EmptyState v-else> No Listings </EmptyState>

    <div v-if="listings.data.length" class="flex items-center mb-8 mt-8">
        <Pagination :links="listings.links" />
    </div>
</template>

<script>
import MainLayout from "../Layouts/MainLayout.vue";
import Pagination from "../../components/UI/Pagination.vue";
import RealtorFilter from "./Index/Components/RealtorFilter.vue";
import EmptyState from "../../components/UI/EmptyState.vue";

export default {
    layout: MainLayout,
};
</script>

<script setup>
import Listing from "./Index/Components/Listing.vue";

defineProps({
    listings: Object,
});
</script>
