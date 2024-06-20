<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/UserAuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { ref } from 'vue';

const props = defineProps({
    product: Object,
    quantity: [Number, String],
});

const form = useForm({
    product_id: props.product.id,
    quantity: 1,
});

const addCart = () => {
    form.post(route('user.cart.add'));
}

const isShow = ref(false);
const toggleStatus = () => { isShow.value = !isShow.value }

</script>

<template>

    <Head title="商品詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品詳細</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="md:flex md:justify-around">
                            <div class="md:w-1/2">
                                <Swiper :pagination="true" :scrollbar="true" :navigation="true" :loop="true">
                                    <SwiperSlide>
                                        <img v-if="product.image_first.filename !== null"
                                            :src="'/storage/products/' + product.image_first.filename">
                                        <img v-else src="">
                                    </SwiperSlide>
                                    <SwiperSlide>
                                        <img v-if="product.image_second.filename !== null"
                                            :src="'/storage/products/' + product.image_second.filename">
                                        <img v-else src="">
                                    </SwiperSlide>
                                    <SwiperSlide>
                                        <img v-if="product.image_third.filename !== null"
                                            :src="'/storage/products/' + product.image_third.filename">
                                        <img v-else src="">
                                    </SwiperSlide>
                                    <SwiperSlide>
                                        <img v-if="product.image_fourth.filename !== null"
                                            :src="'/storage/products/' + product.image_fourth.filename">
                                        <img v-else src="">
                                    </SwiperSlide>
                                </Swiper>
                            </div>
                            <div class="md:w-1/2 ml-4">
                                <h2 class="mb-4 text-sm title-font text-gray-500 tracking-widest">
                                    {{ product.category.name }}
                                </h2>
                                <h1 class="mb-4 text-gray-900 text-3xl title-font font-medium">
                                    {{ product.name }}
                                </h1>
                                <p class="mb-4 leading-relaxed">{{ product.information }}</p>
                                <div class="flex justify-around items-center">
                                    <div>
                                        <span class="title-font font-medium text-2xl text-gray-900">
                                            {{ product.price.toLocaleString() }}<span
                                                class="text-sm text-gray-700">円(税込)</span>
                                        </span>
                                    </div>
                                    <form @submit.prevent="addCart">
                                        <div class="flex items-center">
                                            <span class="mr-3">数量</span>
                                            <div class="relative">
                                                <select name="quantity" v-model="form.quantity"
                                                    class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10">
                                                    <option v-for="i in Number(quantity)" :value="i">{{ i }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <PrimaryButton>カートに入れる</PrimaryButton>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-gray-400 my-8"></div>
                        <div class="mb-4 text-center">この商品を販売しているショップ</div>
                        <div class="mb-4 text-center">{{ product.shop.name }}</div>
                        <div class="mb-4 text-center">

                            <img v-if="product.shop.filename !== null"
                                class="mx-auto w-40 h-40 object-cover rounded-full"
                                :src="'/storage/shops/' + product.shop.filename">
                            <img v-else src="">
                        </div>
                        <div class="mb-4 text-center">
                            <SecondaryButton @click="toggleStatus" data-micromodal-trigger="modal-1" href='javascript:;'
                                type="button">ショップの詳細を見る</SecondaryButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
            <div class="modal__overlay" tabindex="-1" data-micromodal-close>
                <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                    <header class="modal__header">
                        <h2 class="text-xl text-gray-700 modal__title" id="modal-1-title">
                            {{ product.shop.name }}
                        </h2>
                        <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal"
                            data-micromodal-close></button>
                    </header>
                    <main class="modal__content" id="modal-1-content">
                        <p>
                            {{ product.shop.information }}
                        </p>
                    </main>
                    <footer class="modal__footer">
                        <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close
                            aria-label="Close this dialog window">閉じる</button>
                    </footer>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
