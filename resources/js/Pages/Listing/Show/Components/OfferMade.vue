<template>
    <Box>
        <template #header> Offer Made </template>

        <Price :price="offerMade.amount" class="font-bold text-3xl" />

        <section>
            <div
                class="flex flex-col md:flex-row justify-between mt-2 text-gray-500"
            >
                <div>Made on</div>
                <div class="font-medium">{{ offerMadeOn }}</div>
            </div>
        </section>

    </Box>
</template>

<script setup>
import { computed } from "vue";
import Price from "../../../../components/Price.vue";
import Box from "../../../../components/UI/Box.vue";

const props = defineProps({
    offerMade: Object,
});

const offerMadeOn = computed(() =>
    new Date(props.offerMade.created_at).toDateString()
);
</script>
