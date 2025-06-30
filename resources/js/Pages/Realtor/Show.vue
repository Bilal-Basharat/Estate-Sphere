<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 w-full flex items-center">
            <div
                v-if="listing.images.length"
                class="grid grid-cols-2 gap-1 w-full as"
            >
                <div
                    class="relative aspect-square overflow-hidden group"
                    v-for="image in listing.images"
                    :key="image.id"
                >
                    <img
                        :src="image.src"
                        class="w-full h-full object-cover"
                        alt="Listing Image"
                    />

                    <!-- Transparent trash icon (only shows on hover) -->
                    <button
                        @click.stop="deleteImage(image.id)"
                        class="absolute top-2 left-2 p-1.5 bg-black/30 backdrop-blur-sm text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-black/40"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                            />
                        </svg>
                    </button>
                </div>
            </div>
            <div v-else class="text-center w-full font-medium text-gray-500">
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
                                <Price
                                    :price="listing.price"
                                    class="font-medium"
                                />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>Profit Paid</div>
                            <div>
                                <Price
                                    :price="totalProfit"
                                    class="font-medium"
                                />
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
import { useMonthlyPayments } from "@/Composable/useMonthlyPayment";

const profitRate = ref(2.5);
const duration = ref(25);

const props = defineProps({
    listing: Object,
});

const { monthlyPayment, totalPaid, totalProfit } = useMonthlyPayments(
    props.listing.price,
    profitRate,
    duration
);

const form = useForm({
    images: [],
});

const deleteImage = (imageId) => {
    form.delete(`/realtor/listing/${props.listing.id}/image/${imageId}`);
};
</script>

<script>
import MainLayout from "../Layouts/MainLayout.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    layout: MainLayout,
};
</script>
