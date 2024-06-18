<script setup>
import { ref } from 'vue';

// boolean型の変数 初期値がfalse
// クリックしたらtrueに変わる
const isShow = ref(false)
const toggleStatus = () => { isShow.value = !isShow.value }
</script>

<template>
    <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
        <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                <header class="modal__header">
                    <h2 class="modal__title" id="modal-1-title">
                        Micromodal
                    </h2>
                    <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal"
                        data-micromodal-close></button>
                </header>
                <main class="modal__content" id="modal-1-content">
                    <p>
                        Try hitting the <code>tab</code> key and notice how the focus stays within the modal itself.
                        Also, <code>esc</code> to close modal.
                    </p>
                </main>
                <footer class="modal__footer">
                    <button @click="toggleStatus" type="button" class="modal__btn modal__btn-primary">Continue</button>
                    <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close
                        aria-label="Close this dialog window">Close</button>
                </footer>
            </div>
        </div>
    </div>

    <div class="flex justify-around items-center mb4">
        <button class="py-2 px-4 bg-gray-200" @click="toggleStatus" type="button" data-micromodal-trigger="modal-1"
            href='javascript:;'>ファイルを選択</button>
        <div class="w-1/4">
            <img :id="'name' + '_thumbnail'" :src="'/storage/products/' + 'sample1.jpg'">
        </div>
    </div>
</template>
