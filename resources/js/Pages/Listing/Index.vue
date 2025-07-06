<template>
    <Filters />
    <div class="grid grid-cols-4 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Listing
            v-for="listing in listings.data"
            :key="listing.id"
            :listing="listing"
        />
    </div>

    <div
        v-if="listings.data.length"
        class="flex justify-center w-full mb-8 mt-8"
    >
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>
import Listing from "@/Pages/Listing/Index/components/Listing.vue";
defineProps({
    listings: Object,
});
</script>

<script>
import MainLayout from "../Layouts/MainLayout.vue";
import Pagination from "../../components/UI/Pagination.vue";
import Filters from "./Index/Components/Filters.vue";

export default {
    layout: MainLayout,
};
</script>
