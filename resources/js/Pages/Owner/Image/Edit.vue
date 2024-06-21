<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Thumbnail from '@/Components/Thumbnail.vue';
import AuthenticatedLayout from '@/Layouts/OwnerAuthenticatedLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';

const props = defineProps({ image: Object });

const form = useForm({
    id: props.image.id,
    title: props.image.title,
})

const updateImage = id => {
    form.put(route('owner.images.update', { image: id }));
}

const deleteImage = id => {
    router.delete(route('owner.images.destroy', { image: id }), {
        onBefore: () => confirm('Is Really, delete image?')
    })
}

</script>

<template>

    <Head title="Owner Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">画像情報編集</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font relative">
                            <div class="container px-5 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <form @submit.prevent="updateImage(form.id)">
                                        <div class=" -m-2">
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="Imageのタイトル" />
                                                    <TextInput id="title" type="text" class="mt-1 block w-full"
                                                        v-model="form.title" autofocus />
                                                    <InputError class="mt-2" :message="form.errors.title" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-2/3 mx-auto">
                                                <div class="relative">
                                                    <Thumbnail type="products" :filename="image.filename" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-full flex justify-around mt-4">
                                                <Link :href="route('owner.images.index')">
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

                                    <div class="w-full flex justify-around mt-16">
                                        <DangerButton type="button" @click="deleteImage(image.id)">
                                            削除
                                        </DangerButton>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
