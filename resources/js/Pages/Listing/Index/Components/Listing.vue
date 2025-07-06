<template>
    <Box>

        <Link :href="`/listing/${listing.id}`">
            <div class="flex items-center gap-1 mt-2">
                <Price :price="listing.price" class="text-2xl font-bold" />
                <div class="text-xs text-gray-500">
                    <Price :price="monthlyPayment" /> pm
                </div>
            </div>
            <ListingSpace :listing="listing" class="text-lg" />
            <ListingAddress :listing="listing" class="text-g" />
        </Link>
    </Box>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/components/ListingAddress.vue";
import Box from "@/components/UI/Box.vue";
import ListingSpace from "@/components/ListingSpace.vue";
import Price from "@/components/Price.vue";
import { useMonthlyPayments } from "../../../../Composable/useMonthlyPayment";

const props = defineProps({
    listing: Object,
});

const { monthlyPayment } = useMonthlyPayments(props.listing.price, 2.5, 25);
</script>
