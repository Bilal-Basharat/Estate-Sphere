<template>
    <form action="" @submit.prevent="create">
        <div class="mx-4 grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label"> Beds </label>
                <input class="input" type="text" v-model.number="form.beds" />
                <div v-if="form.errors.beds" class="input-error">
                    {{ form.errors.beds }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label"> Baths </label>
                <input
                    class="input"
                    type="text"
                    input
                    v-model.number="form.baths"
                />
                <div v-if="form.errors.baths" class="input-error">
                    {{ form.errors.baths }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label"> Area </label>
                <input class="input" type="text" v-model.number="form.area" />
                <div v-if="form.errors.area" class="input-error">
                    {{ form.errors.area }}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label"> City </label>
                <input class="input" type="text" v-model="form.city" />
                <div v-if="form.errors.city" class="input-error">
                    {{ form.errors.city }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label"> Post Code </label>
                <input class="input" type="text" v-model.number="form.code" />
                <div v-if="form.errors.code" class="input-error">
                    {{ form.errors.code }}
                </div>
            </div>
            <div class="col-span-4">
                <label class="label"> Street </label>
                <input class="input" type="text" v-model="form.street" />
                <div v-if="form.errors.street" class="input-error">
                    {{ form.errors.street }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label"> Street No. </label>
                <input
                    class="input"
                    type="text"
                    v-model.number="form.street_nr"
                />
                <div v-if="form.errors.street_nr" class="input-error">
                    {{ form.errors.street_nr }}
                </div>
            </div>
            <div class="col-span-6">
                <label class="label"> Price </label>
                <input class="input" type="text" v-model.number="form.price" />
                <div v-if="form.errors.price" class="input-error">
                    {{ form.errors.price }}
                </div>
            </div>

            <div class="col-span-6">
                <button class="btn-primary" type="submit">Create</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: null,
    code: 0,
    street: null,
    street_nr: null,
    price: 0,
});

const create = () => {
    form.post("/realtor/listing");
};
</script>

<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px;
}
</style>
