<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectImage from '@/Components/SelectImage.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/OwnerAuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    shops: Object,
    images: Object,
    categories: Object,
});

const form = useForm({
    name: '',
    information: '',
    price: null,
    sort_order: null,
    quantity: 0,
    shop_id: null,
    category: null,
    image1: null,
    image2: null,
    image3: null,
    image4: null,
    is_selling: 1,
})

const storeProduct = () => {
    form.post(route('owner.products.store'));
}

</script>

<template>

    <Head title="Owner Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品登録</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font relative">
                            <div class="container px-5 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <form @submit.prevent="storeProduct()">
                                        <div class=" -m-2">
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="商品名" />
                                                    <TextInput id="name" type="text" class="mt-1 block w-full"
                                                        v-model="form.name" required autofocus autocomplete="name" />
                                                    <InputError class="mt-2" :message="form.errors.name" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="商品情報" />
                                                    <textarea v-model="form.information" name="information"
                                                        id="information"
                                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-40"></textarea>
                                                    <InputError class="mt-2" :message="form.errors.information" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="価格" />
                                                    <TextInput id="price" type="number" class="mt-1 block w-full"
                                                        v-model="form.price" required />
                                                    <InputError class="mt-2" :message="form.errors.price" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="表示順" />
                                                    <TextInput id="sort_order" type="number" class="mt-1 block w-full"
                                                        v-model="form.sort_order" />
                                                    <InputError class="mt-2" :message="form.errors.sort_order" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="初期在庫" />
                                                    <TextInput id="quantity" type="number" class="mt-1 block w-full"
                                                        v-model="form.quantity" required />
                                                    <span class="text-sm">0~99の範囲で入力してください</span>
                                                </div>
                                            </div>
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="販売する店舗" />
                                                    <select name="shop_id" id="shop_id" v-model="form.shop_id"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        <option v-for="shop in shops" :value="shop.id">
                                                            {{ shop.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="カテゴリー" />
                                                    <select name="category" id="category" v-model="form.category"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                        <optgroup v-for="category in categories" :label="category.name">
                                                            <option v-for="secondary in category.secondary"
                                                                :value="secondary.id">
                                                                {{ secondary.name }}
                                                            </option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>

                                            <SelectImage :images="images" v-model="form.image1" />
                                            <SelectImage :images="images" v-model="form.image2" />
                                            <SelectImage :images="images" v-model="form.image3" />
                                            <SelectImage :images="images" v-model="form.image4" />

                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="Status" />
                                                    <input type="radio" name="is_selling" value="1" class="mr-2"
                                                        v-model="form.is_selling">販売中
                                                    <input type="radio" name="is_selling" value="0" class="mr-2"
                                                        v-model="form.is_selling">停止中
                                                    <InputError class="mt-2" :message="form.errors.is_selling" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-full flex justify-around mt-4">
                                                <Link :href="route('owner.products.index')">
                                                <SecondaryButton>
                                                    戻る
                                                </SecondaryButton>
                                                </Link>
                                                <PrimaryButton type="submit">
                                                    登録する
                                                </PrimaryButton>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
