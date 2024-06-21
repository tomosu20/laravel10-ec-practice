<script setup>
import { StripeCheckout } from '@vue-stripe/vue-stripe';
import { onMounted, ref } from 'vue';

const props = defineProps({
    publicKey: String,
    session: String,
})

const checkoutRef = ref(null);

onMounted(() => {
    checkoutRef.value.redirectToCheckout();
})

</script>

<template>
    <div>
        <StripeCheckout ref="checkoutRef" :pk="publicKey" :session-id="session.id" />
        <p>決済ページへリダイレクトします。</p>
    </div>
</template>