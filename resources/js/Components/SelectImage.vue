<script setup>

import { computed, ref } from 'vue';

const currentId = defineModel();

const props = defineProps({
    name: String,
    images: Object,
    currentImage: {
        type: String,
        default: '',
    },
})

const modal = computed(() => {
    if (props.name === 'image1') {
        return 'modal-1'
    }
    if (props.name === 'image2') {
        return 'modal-2'
    }
    if (props.name === 'image3') {
        return 'modal-3'
    }
    if (props.name === 'image4') {
        return 'modal-4'
    }
});

const isShow = ref(false);
const toggleStatus = () => { isShow.value = !isShow.value }

const cImage = ref(props.currentImage);
const cId = ref(currentId);
const selectImage = (id, filename) => {
    cImage.value = filename;
    cId.value = id;
    toggleStatus();
}

</script>

<template>
    <div v-show="isShow" class="modal" :id="modal" aria-hidden="true">
        <div class="modal__overlay z-50" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" :aria-labelledby="modal + '-title'">
                <header class="modal__header">
                    <h2 class="text-xl text-gray-700" :id="modal + '-title'">
                        ファイルを選択してください
                    </h2>
                    <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal"
                        data-micromodal-close></button>
                </header>
                <main class="modal__content" :id="modal + '-content'">
                    <div class="flex flex-wrap">
                        <div v-for="image in images" class="w-1/4 p-2 md:p-4">
                            <div class=" p-2 md:p-4">
                                <div class="border rounded-md p-2 md:p-4">
                                    <img :src="'/storage/products/' + image.filename" class="image"
                                        @click="selectImage(image.id, image.filename)" :data-id="name + '_' + image.id"
                                        :data-file="image.filename" data-path="/storage/products/" :data-modal="modal">
                                    <div class="text-gray-700"> {{ image.title }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="modal__footer">
                    <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close
                        aria-label="Close this dialog window">閉じる</button>
                </footer>
            </div>
        </div>
    </div>

    <div class="flex justify-around items-center mb-4">
        <button @click="toggleStatus" type="button" class="py-2 px-4 bg-gray-200" :data-micromodal-trigger="modal"
            href='javascript:;'>ファイルを選択</button>
        <div class="w-1/4">
            <img :id="name + '_thumbnail'" v-if="cImage" :src="'/storage/products/' + cImage">
        </div>
    </div>

    <input :id="name + '_hidden'" type="hidden" :name="name" :value="cId">

</template>