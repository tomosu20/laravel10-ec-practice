<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    links: Array,
    query: {
        type: URLSearchParams,
        default: new URLSearchParams(window.location.search),
    },
});

const queryPath = (page) => {
    props.query.delete('page')
    const location = window.location
    const basePath = location.origin + location.pathname
    const queryPath = props.query.toString()
    if (queryPath === '') {
        return basePath + '?page=' + page
    }
    return basePath + '?' + queryPath + '&page=' + page
}

</script>

<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, index) in links" :key="index">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label" />
                <Link v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-gray-300 focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-blue-700 text-white': link.active }" :href="queryPath(link.label)"
                    v-html="link.label" />
            </template>
        </div>
    </div>
</template>
