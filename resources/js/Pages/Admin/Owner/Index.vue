<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({ owners: Array });

const deleteOwner = id => {
    router.delete(route('admin.owners.destroy', { owner: id }), {
        onBefore: () => confirm('Is Really, delete owner?')
    })
}
</script>


<template>

    <Head title="Owner" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Owner管理</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="md:p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font">
                            <div class="container md:px-5 mx-auto">
                                <FlashMessage />
                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                    <div class="flex justify-end m-4">
                                        <Link :href="route('admin.owners.create')">
                                        <SecondaryButton>
                                            新規登録する
                                        </SecondaryButton>
                                        </Link>
                                    </div>
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                                    Name</th>
                                                <th
                                                    class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    Email</th>
                                                <th
                                                    class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                    Created</th>
                                                <th
                                                    class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                </th>
                                                <th
                                                    class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="owner in owners" :key="owner.id">
                                                <td class="md:px-4 py-3">{{ owner.name }}</td>
                                                <td class="md:px-4 py-3">{{ owner.email }}</td>
                                                <td class="md:px-4 py-3">{{ owner.created_at }}
                                                </td>
                                                <td class="flex md:px-4 py-3">
                                                    <Link as="button"
                                                        :href="route('admin.owners.edit', { owner: owner.id })">
                                                    <SecondaryButton>
                                                        編集
                                                    </SecondaryButton>
                                                    </Link>
                                                    <DangerButton @click="deleteOwner(owner.id)">
                                                        削除
                                                    </DangerButton>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- {{ owners -> links() }}　 //TODO: ページネーション -->
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
