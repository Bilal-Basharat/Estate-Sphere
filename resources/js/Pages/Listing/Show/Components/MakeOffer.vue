<template>
    <Box>
        <template #header> Make an Offer </template>

        <div>
            <form @submit.prevent="makeOffer">
                <input
                    type="number"
                    class="input bg-white text-gray-800"
                    v-model.number="form.amount"
                />

                <input
                    v-model="form.amount"
                    type="range"
                    :min="min"
                    :max="max"
                    step="10000"
                    class="w-full bg-gray-200 h-2 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                />

                <button type="submit" class="btn-outline w-full text-sm mt-2">
                    Make Offer
                </button>
                {{ form.errors.amount }}
            </form>
        </div>

        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div class="text-white">
                <Price :price="difference" class="font-medium" />
            </div>
        </div>
    </Box>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { computed, watch } from "vue";
import Price from "../../../../components/Price.vue";
import Box from '../../../../components/UI/Box.vue';
import {debounce} from "lodash-es";

const props = defineProps({
    listingId: Number,
    price: Number,
});

const form = useForm({
    amount: props.price,
});

//emitting the events
const emit = defineEmits(['offerUpdated']);
watch(() => form.amount, debounce((value) => emit('offerUpdated', value)),200);


const makeOffer = () => {
    form.post(`/listing/${props.listingId}/offer`, {
        preserveScroll: true,
        preserveState: true,
    });
};

const difference = computed(() => form.amount - props.price);

const min = computed(() => Math.round(props.price / 2));
const max = computed(() => props.price * 2);
</script>
