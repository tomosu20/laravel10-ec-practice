<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/OwnerAuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    files: null,
    titles: [],
})

const storeImage = () => {
    form.post(route('owner.images.store'));
}

const previewImages = ref([]);

const onFileChange = (e) => {
    const files = e.target.files
    form.files = files

    previewImages.value = []
    Array.from(files).map(file => {
        form.titles.push(file.name.replace(/^(.+)\..+$/, '$1'))
        previewImages.value.push(URL.createObjectURL(file))
    });
}

</script>

<template>

    <Head title="Owner Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">画像追加</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font relative">
                            <div class="container px-5 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <form @submit.prevent="storeImage">
                                        <div class=" -m-2">
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="Image" />
                                                    <input id="image" type="file" class="mt-1 block w-full" multiple
                                                        accept="image/png,image/jpeg,image/jpg"
                                                        @change="onFileChange" />
                                                    <InputError class="mt-2" :message="form.errors.file" />
                                                </div>
                                            </div>
                                            <div class="flex flex-wrap">
                                                <div v-for="(prevImage, index) in previewImages"
                                                    class="w-full p-2 md:p-4">
                                                    <div class="border rounded-md p-4">
                                                        <img :src="prevImage">
                                                        <TextInput class="mt-4" v-model="form.titles[index]" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-2 w-full flex justify-around mt-4">
                                                <Link :href="route('owner.images.index')">
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
