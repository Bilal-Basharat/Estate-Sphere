<template>
    <div class="mb-4">
        <Link :href="`/realtor/listing`"> ← Go Back to Listings </Link>
    </div>

    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        
        <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No Offers
            </div>
        </Box>

        <div v-else class="md:col-span-7 items-center">

            <Offer 
            v-for="offer in listing.offers" 
            :key="offer.id" 
            :offer="offer"
            :listing-price="listing.price"
            :is-sold="listing.sold_at !== null"
            class="mb-2" />

        </div>
        
        <div class="md:col-span-5">

            <Box>
                
                <template #header> Basic Info. </template>
                
                <Price :price="listing.price" class="text-2xl font-bold" />
                
                <ListingAddress :listing="listing" class="text-gray-500" />
                <ListingSpace :listing="listing" class="text-gray-500" />
                
            </Box>
        </div>
    </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    listing: Object,
});

const hasOffers = computed(() => props.listing.offers.length > 0);
</script>

<script>
import MainLayout from "../../Pages/Layouts/MainLayout.vue";
import Box from "../../components/UI/Box.vue";
import Price from "../../components/Price.vue";
import ListingAddress from "../../components/ListingAddress.vue";
import ListingSpace from "../../components/ListingSpace.vue";
import { computed } from "vue";
import Offer from "./Show/Components/Offer.vue";

export default {
    layout: MainLayout,
};
</script>
