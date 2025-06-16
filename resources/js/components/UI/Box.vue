<template>

    <div class="border border-gray-200 rounded-md shadow-sm p-4 dark:border-gray-800 dark:text-gray-200 ">
        <div class="text-gray-500 font-medium">
            <slot name="header" />
        </div>
        <slot />
    </div>
</template>