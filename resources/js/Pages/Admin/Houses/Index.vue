<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({
    houses: Array,
});

const deleteHouse = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus rumah ini?')) {
        router.delete(route('admin.houses.destroy', id));
    }
};
</script>

<template>
    <Head title="Kelola Rumah" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Daftar Properti
                </h2>
                <Link
                    :href="route('admin.houses.create')"
                    class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                >
                    Tambah Rumah
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="border-b bg-gray-50 uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-6 py-3">Properti</th>
                                        <th class="px-6 py-3">Lokasi</th>
                                        <th class="px-6 py-3">Harga</th>
                                        <th class="px-6 py-3">Status</th>
                                        <th class="px-4 py-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="house in houses" :key="house.id" class="border-b hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-600">
                                        <td class="flex items-center gap-3 px-6 py-4">
                                            <img :src="house.image ? (house.image.startsWith('http') ? house.image : (house.image.startsWith('image/') ? '/' + house.image : '/storage/' + house.image)) : '/image/placeholder.jpg'" class="h-10 w-14 rounded object-cover" />
                                            <span class="font-bold">{{ house.title }}</span>
                                        </td>
                                        <td class="px-6 py-4">{{ house.location }}</td>
                                        <td class="px-6 py-4 font-semibold text-blue-500">{{ house.price }}</td>
                                        <td class="px-6 py-4">
                                            <span :class="['rounded-full px-2 py-1 text-[10px] font-bold uppercase', house.status === 'Dijual' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700']">
                                                {{ house.status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-right space-x-2">
                                            <Link :href="route('admin.houses.edit', house.id)" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">Edit</Link>
                                            <button @click="deleteHouse(house.id)" class="text-red-600 hover:text-red-900 dark:text-red-400">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr v-if="houses.length === 0">
                                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">Belum ada properti.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
