<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/OwnerAuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({ shop: Object });

const form = useForm({
    id: props.shop.id,
    name: props.shop.name,
    information: props.shop.information,
    image: props.image,
    is_selling: props.shop.is_selling,
})

const updateShop = id => {
    form.post(route('owner.shops.update', { shop: id }));
}

</script>

<template>

    <Head title="Owner Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">店舗情報編集</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font relative">
                            <div class="container px-5 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <form @submit.prevent="updateShop(form.id)">
                                        <div class=" -m-2">
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="Name" />
                                                    <TextInput id="name" type="text" class="mt-1 block w-full"
                                                        v-model="form.name" required autofocus autocomplete="name" />
                                                    <InputError class="mt-2" :message="form.errors.name" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="Information" />
                                                    <textarea v-model="form.information" name="information"
                                                        id="information"
                                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm h-40"></textarea>
                                                    <InputError class="mt-2" :message="form.errors.information" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="Image" />
                                                    <input id="image" type="file"
                                                        @input="form.image = $event.target.files[0]"
                                                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                                                        accept="image/png,image/jpeg,image/jpg" />
                                                    <InputError class="mt-2" :message="form.errors.image" />
                                                </div>
                                            </div>
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
                                                <Link :href="route('owner.shops.index')">
                                                <SecondaryButton>
                                                    戻る
                                                </SecondaryButton>
                                                </Link>
                                                <PrimaryButton type="submit">
                                                    更新する
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
