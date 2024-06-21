<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    type: String,
    filename: String,
})

const path = ref('');

if (props.type === 'shops') {
    path.value = '/storage/shops/';
} else if (props.type === 'products') {
    path.value = '/storage/products/';
}

const imageSource = computed(() => {
    if (!props.filename) {
        return '/images/no_image.jpg';
    }
    return path.value + props.filename;
})
</script>

<template>
    <img :src="imageSource">
</template>