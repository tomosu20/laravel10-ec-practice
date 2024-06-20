<script setup>
import Pagination from '@/Components/Pagination.vue';
import Thumbnail from '@/Components/Thumbnail.vue';
import AuthenticatedLayout from '@/Layouts/UserAuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    products: Object
});

</script>

<template>

    <Head title="商品一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-wrap">
                            <div v-for="product in products.data" class="w-1/4 p-2 md:p-4">
                                <Link :href="route('user.items.show', { 'item': product.id })">
                                <div class="border rounded-md p-2 md:p-4">
                                    <Thumbnail :filename="product.filename ?? ''" type="products" />
                                    <div class="mt-4">
                                        <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">
                                            {{ product.category }}
                                        </h3>
                                        <h2 class="text-gray-900 title-font text-lg font-medium">
                                            {{ product.name }}</h2>
                                        <p class="mt-1">{{ product.price.toLocaleString() }}
                                            <span class="text-sm text-gray-700">円(税込)</span>
                                        </p>
                                    </div>
                                </div>
                                </Link>
                            </div>
                        </div>
                        <Pagination class="mt-6" :links="products.links" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
