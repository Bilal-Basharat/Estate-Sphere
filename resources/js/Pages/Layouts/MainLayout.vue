<template>
    <header
        class="border-b border-gray-900 dark:border-gray-700 bg-white dark:bg-gray-800 w-full text-black"
    >
        <div class="container mx-auto">
            <nav class="flex items-center justify-between p-4">
                <div class="text-lg font-medium">
                    <Link href="/listing"> Listings </Link>
                </div>
                <div class="text-xl font-bold text-center text-indigo-600">
                    <Link href="/hello"> Estate Sphere </Link>
                </div>
                <div v-if="loggedUser" class="flex items-center gap-2">

                    <div class="text-md text-gray-500"> {{ loggedUser.name }} </div>
                    <div
                    class="btn-secondary"
                    >
                    <Link href="/listing/create"> New Listing </Link>
                </div>
                <div
                    class="btn-secondary"
                    >
                    <button  @click="logout"> Logout </button>
                </div>
            </div>
                <div v-else>
                    <Link href="/login" class="btn-secondary mr-2"> Login </Link>
                    <Link href="/user-account/create" class="btn-secondary" > Register </Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container p-4 mx-auto w-full">
        <div
            v-if="flashMessage"
            class="mb-4 border rounded-md border-green-200 bg-green-100 p-4 shadow-lg dark:bg-green-900 dark:border-green-800"
        >
            {{ flashMessage }}
        </div>

        <slot> default </slot>
    </main>
</template>

<script setup>
import { Link, usePage, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();

const form = useForm();

const logout = () => {
    form.delete("logout");
}

const flashMessage = computed(() => page.props.flash.message);

const loggedUser = computed(() => page.props.user);

</script>
