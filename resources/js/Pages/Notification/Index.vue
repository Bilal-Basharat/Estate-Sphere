<template>
    <h1 class="text-2xl mb-4 font-bold">Your Notifications</h1>

    <section
        v-if="notifications.data.length"
        class="text-gray-700 dark:text-gray-400"
    >
        <div
            v-for="notification in notifications.data"
            :key="notification.id"
            class="border-b border-gray-200 dark:border-gray-700 py-4 flex justify-between items-center"
        >
            <div>
                <span
                    v-if="notification.type === 'App\\Notifications\\OfferMade' && !notification.read_at"
                >
                    Offer of ${{ notification.data.amount }} for
                    <Link
                        :href="`/realtor/listing/${notification.data.listing_id}`"
                        class="text-blue-600 dark:text-blue-400 font-bold"
                    >
                        listing
                    </Link>
                    was made
                </span>
            </div>
            <div>
                <Link
                    :href="`/notification/${notification.id}/mark`"
                    method="PUT"
                    as="button"
                    v-if="!notification.read_at"
                    class="btn-outline text-sm font-medium"
                >
                    Mark as read
                </Link>
            </div>
        </div>
    </section>

    <EmptyState v-else> No Notifications yet!</EmptyState>

    <section
        v-if="notifications.data.length"
        class="flex w-full justify-center items-center my-8"
    >
        <Pagination :links="notifications.links" />
    </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import MainLayout from "../Layouts/MainLayout.vue";
import EmptyState from "../../components/UI/EmptyState.vue";
import Pagination from "../../components/UI/Pagination.vue";

defineProps({
    notifications: Object,
});
</script>

<script>
export default {
    layout: MainLayout,
};
</script>
