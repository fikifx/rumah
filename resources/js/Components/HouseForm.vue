<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue'; // I'll check if this exists or use native textarea

const props = defineProps({
    house: {
        type: Object,
        default: () => ({
            title: '',
            location: 'Banyuwangi',
            price: 'Rp ',
            status: 'Dijual',
            beds: 2,
            baths: 1,
            area: 60,
            is_new: true,
            description: '',
            image: null,
        }),
    },
    isEdit: {
        type: Boolean,
        default: false,
    },
});

const form = useForm({
    _method: props.isEdit ? 'patch' : 'post', // For file uploads on update
    title: props.house.title,
    location: props.house.location,
    price: props.house.price,
    status: props.house.status,
    beds: props.house.beds,
    baths: props.house.baths,
    area: props.house.area,
    is_new: props.house.is_new,
    description: props.house.description,
    image: null,
});

const submit = () => {
    if (props.isEdit) {
        form.post(route('admin.houses.update', props.house.id), {
            forceFormData: true,
        });
    } else {
        form.post(route('admin.houses.store'));
    }
};
</script>

<template>
    <form @submit.prevent="submit" class="mt-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <InputLabel for="title" value="Nama Properti" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus />
                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div>
                <InputLabel for="location" value="Lokasi / Alamat" />
                <TextInput id="location" type="text" class="mt-1 block w-full" v-model="form.location" required />
                <InputError class="mt-2" :message="form.errors.location" />
            </div>

            <div>
                <InputLabel for="price" value="Harga (Contoh: Rp 750.000.000)" />
                <TextInput id="price" type="text" class="mt-1 block w-full" v-model="form.price" required />
                <InputError class="mt-2" :message="form.errors.price" />
            </div>

            <div>
                <InputLabel for="status" value="Status" />
                <select id="status" v-model="form.status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="Dijual">Dijual</option>
                    <option value="Disewa">Disewa</option>
                </select>
                <InputError class="mt-2" :message="form.errors.status" />
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <InputLabel for="beds" value="Kamar Tidur" />
                    <TextInput id="beds" type="number" class="mt-1 block w-full" v-model="form.beds" required />
                </div>
                <div>
                    <InputLabel for="baths" value="Kamar Mandi" />
                    <TextInput id="baths" type="number" class="mt-1 block w-full" v-model="form.baths" required />
                </div>
                <div>
                    <InputLabel for="area" value="Luas (m²)" />
                    <TextInput id="area" type="number" class="mt-1 block w-full" v-model="form.area" required />
                </div>
            </div>

            <div class="flex items-center">
                <label class="flex items-center">
                    <input type="checkbox" v-model="form.is_new" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Unit Baru</span>
                </label>
            </div>
        </div>

        <div>
            <InputLabel for="description" value="Deskripsi" />
            <textarea id="description" v-model="form.description" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4"></textarea>
            <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <div>
            <InputLabel for="image" value="Foto Rumah" />
            <input id="image" type="file" @input="form.image = $event.target.files[0]" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
            <InputError class="mt-2" :message="form.errors.image" />
            <p v-if="isEdit && house.image" class="mt-2 text-xs text-gray-500">Gambar saat ini: {{ house.image }}</p>
        </div>

        <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">Simpan</PrimaryButton>
            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Tersimpan.</p>
            </Transition>
        </div>
    </form>
</template>
