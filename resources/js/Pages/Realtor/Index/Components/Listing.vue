<template>
    <Box>
        <span
            v-if="listing.sold_at"
            class="dark:text-green-200 border border-green-200 b border-dashed rounded-md text-sm px-2 py-1"
        >
            Sold
        </span>
        <div
            class="flex flex-col md:flex-row md:items-center justify-between gap-2"
        >
            <div :class="{ 'opacity-50': listing.deleted_at }">
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
                <div class="mt-2">
                    <Link
                        :href="`/realtor/listing/${listing.id}/image/create`"
                        class="btn-outline w-full block"
                    >
                        Images ({{ listing.images_count }})
                    </Link>
                </div>
                <!-- button for displaying offers -->
                <div class="mt-2">
                    <Link
                        :href="`listing/${listing.id}`"
                        class="btn-outline w-full block"
                    >
                        Offers ({{ listing.offers_count }})
                    </Link>
                </div>
            </section>
        </div>
    </Box>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/components/ListingAddress.vue";
import Box from "@/components/UI/Box.vue";
import ListingSpace from "@/components/ListingSpace.vue";
import Price from "@/components/Price.vue";

const props = defineProps({
    listing: Object,
});
</script>
