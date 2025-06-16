<template>
    <div> 
                {{listing.city}} | {{ listing.state }} |
        {{listing.street}} | 

        </div>
</template>

<script setup>

defineProps({
    listing: Object
})
</script>