<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import HouseForm from '@/Components/HouseForm.vue';

defineProps({
    house: Object,
});
</script>

<template>
    <Head title="Edit Rumah" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Edit Rumah
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border-l-4 border-blue-500">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <HouseForm :house="house" :is-edit="true" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
