<template>
    <header
        class="border-b border-gray-900 dark:border-gray-700 bg-white w-full text-black"
    >
        <div class="container mx-auto">
            <nav class="flex items-center justify-between p-4">
                <div class="text-lg font-medium">
                    <Link href="/listing"> Listings </Link>
                </div>
                <div class="text-xl font-bold text-center text-indigo-600">
                    <Link href="/hello"> Estate Sphere </Link>
                </div>
                <div class="bg-[#054fbe] text-white rounded-md px-4 py-2 hover:bg-[#055ebe] font-medium">
                    <Link href="/listing/create"> New Listing </Link>
                </div>
            </nav>
        </div>
    </header>

<main class="container p-4 mx-auto">
        <div v-if="flashSuccess" class="mb-4 border rounded-md border-green-200 bg-green-100 p-4 shadow-lg dark:bg-green-900 dark:border-green-800">
        {{flashSuccess}} 
    </div>

    <slot> default </slot>

</main></template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
</script>
