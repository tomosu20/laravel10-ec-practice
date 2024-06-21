<script setup>
import Pagination from '@/Components/Pagination.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Thumbnail from '@/Components/Thumbnail.vue';
import AuthenticatedLayout from '@/Layouts/UserAuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    products: Object,
    categories: Object
});

const params = new URLSearchParams(window.location.search);

const form = useForm({
    category: params.get('category') ?? 0,
    keyword: params.get('keyword'),
    sort: params.get('sort') ?? 0,
    pagination: params.get('pagination') ?? 20,
})

const getProductList = () => {
    form.get(route('user.items.index'));
}

</script>

<template>

    <Head title="商品一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-4">
                    <form @submit.prevent="getProductList">
                        <div class="lg:flex lg:justify-between">
                            <div class="lg:flex items-center">
                                <select class="mb-2 lg:mb-0 lg:mr-2" v-model="form.category">
                                    <option value="0">全て</option>
                                    <template v-for="category in categories">
                                        <optgroup :label="category.name">
                                            <option v-for="secondary in category.secondary" :value="secondary.id">
                                                {{ secondary.name }}
                                            </option>
                                        </optgroup>
                                    </template>
                                </select>
                                <div class="flex space-x-2 items-center mb-2 lg:mb-0 lg:mr-2">
                                    <div>
                                        <input type="text" v-model="form.keyword" placeholder="キーワードを入力">
                                    </div>
                                    <div>
                                        <PrimaryButton type="submit">検索する</PrimaryButton>
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <div>
                                    <span class="text-sm mr-2">表示順</span>
                                    <select id="sort" v-model="form.sort" class="mr-4" @change="getProductList">
                                        <option value="0">おすすめ順</option>
                                        <option value="1">料金の高い順</option>
                                        <option value="2">料金の安い順</option>
                                        <option value="3">新しい順</option>
                                        <option value="4">古い順</option>
                                    </select>
                                </div>
                                <div>
                                    <span class="text-sm mr-2">表示件数</span>
                                    <select id="pagination" v-model="form.pagination" @change="getProductList">
                                        <option value="20">20件</option>
                                        <option value="50">50件</option>
                                        <option value="100">100件</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

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
                        <Pagination class="mt-6" :links="products.links" :query="params" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
