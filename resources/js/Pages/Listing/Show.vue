<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 w-full flex items-center">
            <div class="text-center w-full font-medium text-gray-500">
                No Images
            </div>
        </Box>

        <div class="md:col-span-5">
            <Box>
                <template #header> Basic Info. </template>

                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-g" />
            </Box>
            <Box>
                <template #header> Monthly Payment </template>
                <div>
                    <label class="label">
                        Profit Rate ({{ profitRate }} %)
                    </label>
                    <input
                        v-model="profitRate"
                        type="range"
                        min="0.1"
                        max="100"
                        step="0.1"
                        class="w-full bg-gray-200 h-2 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />
                    <label class="label">
                        Durantion ({{ duration }} Years)
                    </label>
                    <input
                        v-model="duration"
                        type="range"
                        min="3"
                        max="35"
                        step="1"
                        class="w-full bg-gray-200 h-2 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />

                    <div class="text-gray-600 mt-2 dark:text-gray-300">
                        <div class="text-gray-400">Your Monthly Payment</div>
                        <Price :price="monthlyPayment" class="text-3xl" />
                    </div>

                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Total Paid</div>
                            <div>
                                <Price :price="totalPaid" class="font-medium" />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>Pricipal Paid</div>
                            <div>
                                <Price :price="listing.price" class="font-medium" />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div> Profit Paid </div>
                            <div>
                                <Price :price="totalProfit" class="font-medium" />
                            </div>
                        </div>
                    </div>
                </div>
            </Box>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from "vue";
import ListingAddress from "../../components/ListingAddress.vue";
import ListingSpace from "../../components/ListingSpace.vue";
import Price from "../../components/Price.vue";
import Box from "@/components/UI/Box.vue";

const profitRate = ref(2.5);
const duration = ref(25);

import { useMonthlyPayments } from "@/Composable/useMonthlyPayment";

const props = defineProps({
    listing: Object,
});

const { monthlyPayment, totalPaid, totalProfit } = useMonthlyPayments(
    props.listing.price,
    profitRate,
    duration
);
</script>
