<script setup>
</script>

<template>
    <div v-if="$page.props.flash.status === 'info'" class="bg-blue-300 text-white p-4">
        {{ $page.props.flash.message }}
    </div>
    <div v-if="$page.props.flash.status === 'alert'" class="bg-red-300 p-4">
        {{ $page.props.flash.message }}
    </div>
</template>