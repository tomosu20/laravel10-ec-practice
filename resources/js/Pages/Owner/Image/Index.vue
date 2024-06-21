<script setup>
import FlashMessage from '@/Components/FlashMessage.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Thumbnail from '@/Components/Thumbnail.vue';
import AuthenticatedLayout from '@/Layouts/OwnerAuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({ images: Object });

</script>


<template>

    <Head title="Owner" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">画像情報</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="md:p-6 bg-white border-b border-gray-200">
                        <FlashMessage />
                        <div class="flex justify-end m-4">
                            <Link :href="route('owner.images.create')">
                            <SecondaryButton>
                                新規登録する
                            </SecondaryButton>
                            </Link>
                        </div>
                        <div class="flex flex-wrap">
                            <div v-for="image in images.data" class="w-1/4 p-2 md:p-4">
                                <Link :href="route('owner.images.edit', { image: image.id })">
                                <div class="border rounded-md p-4">
                                    <Thumbnail type="products" :filename="image.filename" />
                                    <div class="text-xl">{{ image.title }}</div>
                                </div>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
