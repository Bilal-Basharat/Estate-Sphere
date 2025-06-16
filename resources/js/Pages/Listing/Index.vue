<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

        <Box v-for="listing in listings" :key="listing.id"> 
            <Link :href="`/listing/${listing.id}`">
                <Price :price="listing.price" class="text-2xl font-bold"/>
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-g" />
            </Link>
        </Box>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import ListingAddress from '../../components/ListingAddress.vue';
defineProps({
    listings: Array,
})
</script>

<script>
import MainLayout from '../Layouts/MainLayout.vue';
import Box from '@/components/UI/Box.vue';
import ListingSpace from '../../components/ListingSpace.vue';
import Price from '../../components/Price.vue';

export default {
    layout: MainLayout
}
</script>