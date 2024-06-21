<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/UserAuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    products: Object,
    totalPrice: Number
});

const deleteItem = id => {
    router.post(route('user.cart.delete', { item: id }))
}
</script>

<template>

    <Head title="カート" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">カート</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="products.length > 0" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-for="product in products" class="md:flex md:items-center mb-2">
                            <div class="md:w-3/12">
                                <img v-if="product.image_first.filename !== null"
                                    :src="'/storage/products/' + product.image_first.filename">
                                <img v-else src="">
                            </div>
                            <div class="w-4/12 md:ml-2">{{ product.name }}</div>
                            <div class="md:w-3/12 flex justify-around">
                                <div>{{ product.pivot.quantity }}個</div>
                                <div>{{ (product.pivot.quantity * product.price).toLocaleString() }}<span
                                        class="text-sm text-gray-700">円(税込)</span></div>
                            </div>
                            <div class="md:w-2/12">
                                <DangerButton @click="deleteItem(product.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </DangerButton>
                            </div>
                        </div>

                        <div class="mt-4 text-right">
                            <div class="my-2">
                                小計：{{ totalPrice.toLocaleString() }}<span class="text-sm text-gray-700">円(税込)</span>
                            </div>
                            <Link :href="route('user.cart.checkout')">
                            <PrimaryButton>購入する</PrimaryButton>
                            </Link>
                        </div>
                    </div>
                </div>
                <div v-else>
                    カートに商品が入っていません
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
