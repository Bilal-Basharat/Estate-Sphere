<template>
    <h1 class="text-3xl mb-4 font-bold">Your Listings</h1>

    <section class="flex mb-8">
        <RealtorFilter />
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <Box v-for="listing in listings.data" :key="listing.id" >
            <div
                class="flex flex-col md:flex-row md:items-center justify-between gap-2"
            >
                <div :class="{'opacity-50': listing.deleted_at}">
                    <div class="xl:flex items-center gap-2">
                        <Price
                            :price="listing.price"
                            class="text-2xl font-medium"
                        />
                        <ListingSpace :listing="listing" />
                    </div>
                    <ListingAddress :listing="listing" class="text-gray-500" />
                </div>
                <section>

                    <div
                    class="flex gap-1 items-center text-gray-600 dark:text-gray-300"
                    >
                    <Link class="btn-outline" :href="`listing/${listing.id}`">
                        Preview
                    </Link>
                    <Link
                        class="btn-outline hover:cursor-pointer"
                        :href="`listing/${listing.id}/edit`"
                    >
                        Edit
                    </Link>

                    <Link
                        v-if="listing.deleted_at"
                        class="btn-outline hover:cursor-pointer"
                        :href="`listing/${listing.id}/restore`"
                        method="PUT"
                        >
                        Restore
                    </Link>
                    <Link
                    v-else="listing.deleted_at"
                    class="btn-outline hover:cursor-pointer"
                    :href="`listing/${listing.id}`"
                    method="DELETE"
                    >
                    Delete
                </Link>
            </div>

            <!-- button for going to images upload page -->
            <div class=" mt-2">
                <Link :href="`/realtor/listing/${listing.id}/image/create`" class="btn-outline w-full block"> Images </Link>
            </div>
        </section>
            </div>
        </Box>
    </section>

    <div v-if="listings.data.length" class="flex items-center mb-8 mt-8">
        <Pagination :links="listings.links" />
    </div>
</template>

<script>
import MainLayout from "../Layouts/MainLayout.vue";
import Pagination from "../../components/UI/Pagination.vue";
import RealtorFilter from "./Index/Components/RealtorFilter.vue";
export default {
    layout: MainLayout,
};
</script>

<script setup>
import Price from "../../components/Price.vue";
import ListingSpace from "@/components/ListingSpace.vue";
import Box from "@/components/UI/Box.vue";
import ListingAddress from "@/components/ListingAddress.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    listings: Object,
});
</script>
