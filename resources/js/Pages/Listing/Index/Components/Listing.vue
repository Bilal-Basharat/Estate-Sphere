<template>
            <Box>
            <Link :href="`/listing/${listing.id}`">

                <div class="flex items-center gap-1">

                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500"> 
                        <Price :price="monthlyPayment"/> pm
                    </div>
                </div>
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-g" />
            </Link>
            <Link
                :href="`/listing/${listing.id}/edit`"
                class="text-indigo-600 hover:text-indigo-800"
            >
                Edit
            </Link>
            <span> | </span>
            <Link
                :href="`/listing/${listing.id}`"
                method="DELETE"
                class="text-indigo-600 hover:text-indigo-800"
            >
                Delete
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

const {monthlyPayment} = useMonthlyPayments(props.listing.price, 2.5, 25);
</script>