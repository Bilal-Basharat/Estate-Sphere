<template>
    <header
        class="border-b border-gray-900 dark:border-gray-700 bg-white dark:bg-gray-800 w-full text-black"
    >
        <div class="container mx-auto">
            <nav class="flex items-center justify-between p-4">
                <div class="text-lg font-medium text-[#054fbe]">
                    <Link href="/listing"> Listings </Link>
                </div>
                <div class="text-xl font-bold text-center text-[#054fbe]">
                    <Link href="/hello"> Estate Sphere </Link>
                </div>
                <div v-if="loggedUser" class="flex items-center gap-4">
                    
                    <Link 
                    :href="`/notification`"
                    class="text-gray-500 text-lg relative pr-1 py-1"> 

                        🔔
                        <div v-if="notificationCount" class="absolute text-xs text-center top-0 right-0 w-5 h-5 bg-red-700 dark:bg-red-400 border border-white dark:border-gray-800 text-white font-medium rounded-full">
                            {{ notificationCount }}
                        </div>

                    </Link>

                    <Link
                        class="text-md text-gray-500"
                        :href="`/realtor/listing`"
                    >
                        {{ loggedUser.name }}
                    </Link>
                    
                    <div class="btn-secondary">
                        <Link href="/realtor/listing/create">
                            + New Listing
                        </Link>
                    </div>
                    <div class="btn-secondary">
                        <button @click="logout">Logout</button>
                    </div>
                </div>
                <div v-else>
                    <Link href="/login" class="btn-secondary mr-2">
                        Login
                    </Link>
                    <Link href="/user-account/create" class="btn-secondary">
                        Register
                    </Link>
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

        <div
            v-if="flashError"
            class="mb-4 border rounded-md text-white border-red-600 bg-red-400 p-4 shadow-lg dark:bg-red-700 dark:border-red-900"
        >
            {{ flashError }}
        </div>

        <slot> default </slot>
    </main>
</template>

<script setup>
import { Link, usePage, useForm, router } from "@inertiajs/vue3";
import { computed, ref, watch } from "vue";

const page = usePage();
const form = useForm();

const logout = () => {
    form.post("/logout");
};

const flashMessage = ref(page.props.flash.message);
const flashError = ref(page.props.flash.error);

//autohide message after 2 seconds
watch(() => page.props.flash, (newFlash) => {
  flashMessage.value = newFlash.message;
  flashError.value = newFlash.error;
  
  if (newFlash.message || newFlash.error) {
    setTimeout(() => {
      flashMessage.value = null;
      flashError.value = null;
      // Optional: Clear server-side flash too
      router.reload({ only: ['flash'] });
    }, 2000);
  }
}, { immediate: true });

const loggedUser = computed(() => page.props.user);

const notificationCount = computed(() => Math.min(page.props.user.notificationCount, 9),);
</script>
