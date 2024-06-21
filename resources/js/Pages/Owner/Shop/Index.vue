<script setup>
import FlashMessage from '@/Components/FlashMessage.vue';
import Thumbnail from '@/Components/Thumbnail.vue';
import AuthenticatedLayout from '@/Layouts/OwnerAuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ shops: Object });

</script>


<template>

    <Head title="Owner" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">店舗情報</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="md:p-6 bg-white border-b border-gray-200">
                        <FlashMessage />
                        <div v-for="shop in shops" class="w-1/2 p-4">
                            <Link :href="route('owner.shops.edit', { shop: shop.id })">
                            <div class="border rounded-md p-4">
                                <div class="mb-4">
                                    <span v-if="shop.is_selling === 1"
                                        class="border p-2 rounded-md bg-blue-400 text-white">販売中</span>
                                    <span v-if="shop.is_selling === 0"
                                        class="border p-2 rounded-md bg-red-400 text-white">停止中</span>
                                </div>
                                <div class="text-xl">{{ shop.name }}</div>
                                <Thumbnail type="shops" :filename="shop.filename" />
                            </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
