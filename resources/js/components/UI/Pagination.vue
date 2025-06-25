<template>
    <div class="flex gap-1">
        <component
        :is="link.url ? Link : 'span'"
        v-for="(link, index) in links"
        :key="index"
        :href="link.url"
        class="px-4 py-2 rounded-md"
        :class="{ 'bg-blue-600 dark:bg-blue-800 text-white': link.active }"
        v-html="link.label"
        />
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    links: Array,
});
</script>
