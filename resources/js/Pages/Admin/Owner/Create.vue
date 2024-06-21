<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

const storeOwner = () => {
    form.post(route('admin.owners.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
}

</script>

<template>

    <Head title="Owner Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Owner新規作成</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font relative">
                            <div class="container px-5 mx-auto">
                                <div class="flex flex-col text-center w-full mb-12">
                                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Owner登録
                                    </h1>
                                </div>
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->
                                    <form @submit.prevent="storeOwner">
                                        <div class="-m-2">
                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="Name" />
                                                    <TextInput id="name" type="text" class="mt-1 block w-full"
                                                        v-model="form.name" required autofocus autocomplete="name" />
                                                    <InputError class="mt-2" :message="form.errors.name" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="Email" />
                                                    <TextInput id="email" type="email" class="mt-1 block w-full"
                                                        v-model="form.email" required autocomplete="username" />
                                                    <InputError class="mt-2" :message="form.errors.email" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="Password" />
                                                    <TextInput id="password" type="password" class="mt-1 block w-full"
                                                        v-model="form.password" required autocomplete="new-password" />
                                                    <InputError class="mt-2" :message="form.errors.password" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-1/2 mx-auto">
                                                <div class="relative">
                                                    <InputLabel value="Password Confirm" />
                                                    <TextInput id="password_confirmation" type="password"
                                                        class="mt-1 block w-full" v-model="form.password_confirmation"
                                                        required autocomplete="new-password" />
                                                    <InputError class="mt-2"
                                                        :message="form.errors.password_confirmation" />
                                                </div>
                                            </div>
                                            <div class="p-2 w-full flex justify-around mt-4">
                                                <Link :href="route('admin.owners.index')">
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
