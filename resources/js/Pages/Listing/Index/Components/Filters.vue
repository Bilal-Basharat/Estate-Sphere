<template>
<div> 
    <form @submit.prevent="filter">

        <div class="mb-8 mt-4 flex flex-wrap gap-2">

            <div class="flex flex-nowrap items-center">
                <input type="text" placeholder="Price From" v-model.number="filterForm.priceFrom"
                class="input-left">
                <input type="text" class="input-right" placeholder="Price To" v-model.number="filterForm.priceTo">
            </div>

            <div class="flex flex-nowrap items-center">
                <select class="input-left" v-model="filterForm.beds">
                    <option :value="null"> Beds </option>
                    <option v-for="n in 5" :key="n" :value="n"> {{ n }}</option>
                    <option> 6+ </option>
                </select>
                <select name=""  id="" class="input-right" v-model="filterForm.baths">
                    <option :value="null"> Baths </option>
                    <option v-for="n in 5" :key="n" :value="n"> {{ n }}</option>
                    <option> 6+ </option>
                </select>
            </div>

            <div class="flex flex-nowrap items-center">
                <input type="text" placeholder="Area From"
                class="input-left" v-model.number="filterForm.areaFrom">
                <input type="text" class="input-right" v-model.number="filterForm.areaTo" placeholder="Area To">
            </div>

            <button type="submit" class="btn-filter"> Filter </button>
            <button type="reset" @click="clear"> Reset </button>
        </div>
    </form>
    </div>
</template>

<script setup>

import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    filters: Object,
});

const filterForm = useForm({
    priceFrom: null,
    priceTo: null,
    beds: null,
    baths: null,
    areaFrom: null,
    areaTo: null,
})

const filter = () => {
    filterForm.get('/listing', {
        preserveState: true,
        preserveScroll: true,
    });
}

const clear = () => {
    useForm({
        priceFrom: null,
        priceTo: null,
        beds: null,
        baths: null,
        areaFrom: null,
        areaTo: null,
    }).get('/listing', {
        preserveScroll: true,
    });
};

</script>