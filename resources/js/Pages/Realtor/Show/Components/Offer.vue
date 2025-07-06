<template>
    <Box>
        <template #header> Offer #{{ offer.id }} <span class="rounded-md ml-2 py-1 px-2 dark:text-green-200 dark:bg-green-800 text-green-800 bg-green-200" v-if="offer.accepted_at"> Accepted </span> </template>

        <section class="flex justify-between items-center mt-2">
            <div>
                <Price :price="offer.amount" class="text-xl font-bold" />
                <div class="text-gray-500">
                    Difference
                    <Price :price="difference" />
                </div>
                <div class="text-gray-500 text-sm">
                    Made by: {{ offer.bidder.name }}
                </div>
                <div class="text-gray-500 text-sm">Made on: {{ madeOn }}</div>
            </div>

            <div>
                <Link
                    :href="`/realtor/offer/${offer.id}/accept`"
                    class="btn-outline text-xs font-medium"
                    as="button"
                    method="PUT"
                    v-if="!isSold"
                >
                    Accept
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import { computed } from "vue";
import Box from "../../../../components/UI/Box.vue";
import { Link } from "@inertiajs/vue3";
import Price from "../../../../components/Price.vue";

const props = defineProps({
    offer: Object,
    listingPrice: Number,
    isSold: Boolean
});

const difference = computed(() => props.offer.amount - props.listingPrice);
const madeOn = computed(() => new Date(props.offer.created_at).toDateString());
</script>
