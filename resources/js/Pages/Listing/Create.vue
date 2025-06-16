<template>
<form action="" @submit.prevent="create">

    <div>
        <div>
            <label> Beds </label>
            <input type="text" v-model.number="form.beds" />
        </div>
        <div>
            <label> Baths </label>
            <input type="text" v-model.number="form.baths" />
        </div>
        <div>
            <label> Area </label>
            <input type="text" v-model.number="form.area"/>
        </div>
        
        <div>
            <label> City </label>
            <input type="text" v-model="form.beds" />
        </div>
        <div>
            <label> Post Code </label>
            <input type="text" v-model.number="form.beds" />
        </div>
        <div>
            <label> Street </label>
            <input type="text" v-model="form.street" />
        </div>
        <div>
            <label> Street Number </label>
            <input type="text" v-model.number="form.street_nr" />
        </div>
        <div>
            <label> Price </label>
            <input type="text" v-model.number="form.price" />
        </div>
        
        <div>
            <button type="submit"> Create </button>
        </div>
    </div>
</form>
</template>

<script setup>

import { useForm } from '@inertiajs/vue3';

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: null,
    post_code: 0,
    street: null,
    street_nr: null,
    price: 0,
});

const create = () => {
    form.post('/listing');
}

</script>

<style scoped>

label {
    margin-right: 2em;
}

div {
    padding: 2px;
}

</style>