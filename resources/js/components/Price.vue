<template>
    <span>
{{ formattedPrice }}
    </span>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    price: [String, Number]
})

const formattedPrice = computed(() => Number(props.price).toLocaleString('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 2 }))



</script>