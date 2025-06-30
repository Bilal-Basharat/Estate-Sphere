<template>
    <Box class="mb-2">
        <template #header> Upload New Images </template>
        <form @submit.prevent="upload" enctype="multipart/form-data">
            <section class="flex items-center gap-2 my-4">
                <input
                    class="image-input"
                    type="file"
                    multiple
                    @change="addFiles"
                />

                <button
                    :disabled="!canUpload"
                    type="submit"
                    class="image-upload disabled:opacity-25 disabled:cursor-not-allowed"
                >
                <span v-if="isUploading">Uploading...</span>
    <span v-else>Upload</span>
                    <!-- Upload -->
                </button>

                <button type="reset" class="image-upload" @click="reset">
                    Reset
                </button>
            </section>
        </form>
    </Box>

    <Box v-if="listing.images.length">
        <template #header> Current Listing Images </template>
        <section class="mt-4 grid grid-cols-3 gap-4">
            <div
                v-for="image in listing.images"
                :key="image.id"
                class="relative group"
            >
                <img :src="image.src" class="rounded-md w-full h-auto" />

                <!-- Transparent trash icon (only shows on hover) -->
                <button
                    @click.stop="deleteImage(image.id)"
                    class="absolute top-2 left-2 p-1.5 bg-black/30 backdrop-blur-sm text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-black/40"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                        />
                    </svg>
                </button>
            </div>
        </section>
    </Box>
</template>

<script setup>
import { computed, ref } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import Box from "../../../components/UI/Box.vue";
import NProgress from "nprogress";

const isUploading = ref(false);

const props = defineProps({
    listing: Object,
});

router.on("progress", (event) => {
    if (event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9);
    }
});

const form = useForm({
    images: [],
});

const upload = () => {
    if (isUploading.value) return;

    isUploading.value = true;

    const formData = new FormData();
    form.images.forEach((image, index) => {
        formData.append(`images[${index}]`, image);
    });

    form.post(`/realtor/listing/${props.listing.id}/image`, formData, {
        onSuccess: () => {
            form.reset();
            isUploading.value = false;
        },
        onError: () => {
            isUploading.value = false; // Reset flag on error too
        },
        onFinish: () => {
            isUploading.value = false; // Ensure flag is reset
        },
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });
};

const addFiles = (event) => {
    for (const image of event.target.files) {
        form.images.push(image);
    }
};

const canUpload = computed(() => form.images.length);

const reset = () => {
    form.reset("images");
};

const deleteImage = (imageId) => {
    form.delete(`/realtor/listing/${props.listing.id}/image/${imageId}`);
};
</script>

<script>
import MainLayout from "../../Layouts/MainLayout.vue";
export default {
    layout: MainLayout,
};
</script>
