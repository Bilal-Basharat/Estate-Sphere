<template>
    <div> The message is: {{ message }}</div>
</template>

<script setup>
defineProps({
    message: String,
});
</script>