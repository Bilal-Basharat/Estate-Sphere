<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class=" md:col-span-7 w-full flex items-center">
            <div class="text-center w-full font-medium text-gray-500"> No Images </div>
        </Box>

        <div class=" md:col-span-5">
            <Box>
                <template #header>
                    Basic Info.
                </template>

                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-g" />
            </Box>
            <Box>
                <template #header>
                    Offer
                </template>
                Make an offer
            </Box>
            </div>
        </div>
</template>

<script setup>
import ListingAddress from "../../components/ListingAddress.vue";
import ListingSpace from "../../components/ListingSpace.vue";
import Price from "../../components/Price.vue";
import Box from "../../components/UI/Box.vue";

defineProps({
    listing: Object,
});
</script>
