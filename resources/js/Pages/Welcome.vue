<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed, onMounted, onUnmounted } from 'vue';
import ClusterProgress from '@/Components/ClusterProgress.vue';

const props = defineProps({
    houses: Array,
});

const isScrolled = ref(false)
const isDark = ref(false)
const activeTab = ref('Beli')
const selectedProperty = ref(null)
const activeFaq = ref(null)
const showCluster = ref(false)
const mobileMenuOpen = ref(false)

const closeMobileMenu = () => { mobileMenuOpen.value = false }

// Dark mode toggle
const toggleDarkMode = () => {
    isDark.value = !isDark.value
    localStorage.setItem('rumah-dark-mode', isDark.value.toString())
}

onMounted(() => {
    const savedDarkMode = localStorage.getItem('rumah-dark-mode')
    if (savedDarkMode !== null) {
        isDark.value = savedDarkMode === 'true'
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        isDark.value = true
    }
    window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll)
})

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50
}

const openModal = (property) => {
    selectedProperty.value = property
    document.body.style.overflow = 'hidden'
}

const closeModal = () => {
    selectedProperty.value = null
    document.body.style.overflow = 'auto'
}

const toggleFaq = (index) => {
    activeFaq.value = activeFaq.value === index ? null : index
}

const heroImage = '/image/desain-rumah-kecil-sederhana-kontemporer.jpg'

// FAQ Data
const faqs = [
    {
        question: 'Bagaimana cara membeli properti di RumahImpian.id?',
        answer: 'Proses pembelian sangat mudah! Cari properti yang Anda inginkan, hubungi agen kami, dan kami akan membimbing Anda melalui setiap tahap mulai dari negosiasi harga, verifikasi dokumen, hingga penandatanganan akta jual-beli.'
    },
    {
        question: 'Apakah semua properti sudah terverifikasi?',
        answer: 'Ya, 100% properti yang kami tampilkan telah melalui proses verifikasi ketat. Kami memastikan setiap properti memiliki legalitas yang jelas baik dari segi sertifikat tanah maupun izin bangunan.'
    },
    {
        question: 'Berapa lama proses KPR biasanya?',
        answer: 'Proses KPR melalui RumahImpian.id berlangsung cepat, biasanya 5-10 hari kerja saja. Tim kami yang berpengalaman akan mengurus segala dokumen dan berkoordinasi langsung dengan pihak bank.'
    }
];
</script>

<template>
    <Head title="Griya Ketapang — Hunian Modern di Banyuwangi" />

    <div :class="['min-h-screen overflow-x-hidden transition-colors duration-500', isDark ? 'bg-[#0a0f1e] text-slate-100' : 'bg-[#f8faff] text-slate-800']">

        <!-- CLUSTER PROGRESS Overlay -->
        <ClusterProgress v-if="showCluster" :isDark="isDark" @close="showCluster = false" />
        
        <!-- 1. STICKY NAVIGATION -->
        <nav 
            :class="[
                'fixed w-full z-50 transition-all duration-500',
                isScrolled 
                    ? (isDark ? 'bg-[#0a0f1e]/95 border-b border-blue-900/40' : 'bg-white/95 border-b border-slate-200/60') + ' backdrop-blur-2xl shadow-2xl shadow-black/10 py-3 sm:py-4' 
                    : 'bg-gradient-to-b from-black/60 to-transparent py-5 sm:py-7'
            ]"
        >
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <!-- Logo -->
                <Link href="/" class="flex items-center gap-2 group transition-transform duration-300 hover:scale-[1.02]">
                    <div class="relative flex items-center justify-center h-8 w-8 sm:h-10 sm:w-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.47 3.84a1 1 0 011.06 0l8.99 5.83a1 1 0 01.37 1.35l-.01.02a1 1 0 01-1.35.37L20 10.95V20a2 2 0 01-2 2h-4a1 1 0 01-1-1v-5h-2v5a1 1 0 01-1 1H6a2 2 0 01-2-2v-9.05l-.53.46a1 1 0 01-1.35-.37l-.01-.02a1 1 0 01.37-1.35l8.99-5.83z" />
                        </svg>
                    </div>
                    <span :class="['text-xl sm:text-2xl font-black tracking-tight', isScrolled ? (isDark ? 'text-white' : 'text-slate-900') : 'text-white']">
                        Griya<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">Ketapang</span>
                    </span>
                </Link>

                <!-- Desktop Links -->
                <div class="hidden lg:flex items-center gap-8 xl:gap-10">
                    <a href="#jual" :class="['text-sm font-semibold tracking-wide hover:text-blue-500 transition-colors', isScrolled ? (isDark ? 'text-slate-300' : 'text-slate-600') : 'text-white/90']">Beli</a>
                    <a href="#sewa" :class="['text-sm font-semibold tracking-wide hover:text-blue-500 transition-colors', isScrolled ? (isDark ? 'text-slate-300' : 'text-slate-600') : 'text-white/90']">Sewa</a>
                    <button @click="showCluster = true" :class="['text-sm font-semibold tracking-wide hover:text-blue-500 transition-colors flex items-center gap-1.5', isScrolled ? (isDark ? 'text-slate-300' : 'text-slate-600') : 'text-white/90']">
                        Progress Unit
                    </button>
                    
                    <button @click="toggleDarkMode" :class="['group p-2.5 rounded-xl transition-all duration-300', isDark ? 'bg-slate-800 text-amber-300 hover:bg-slate-700 shadow-inner' : isScrolled ? 'text-slate-600 hover:bg-slate-100' : 'text-white/80 hover:bg-white/10']">
                        <svg v-if="!isDark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                    </button>
                    
                    <Link :href="route('login')" :class="['px-6 py-2.5 rounded-full text-sm font-bold transition-all tracking-wide', isScrolled ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg' : 'bg-white text-blue-700 hover:bg-slate-50 shadow-lg']">
                        Masuk Admin
                    </Link>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center gap-2">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2" :class="[isScrolled ? 'text-slate-900' : 'text-white']">
                        <svg v-if="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 6h16M4 12h16M4 18h16" /></svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </nav>

        <!-- HERO SECTION -->
        <header class="relative w-full min-h-screen flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0 bg-cover bg-center" :style="{ backgroundImage: 'url(' + heroImage + ')' }"></div>
            <div class="absolute inset-0 z-10 bg-gradient-to-br from-slate-950/90 via-slate-900/80 to-indigo-950/70"></div>
            
            <div class="relative z-20 w-full max-w-7xl px-4 text-center lg:text-left flex flex-col lg:flex-row items-center justify-between gap-10">
                <div class="w-full lg:w-[55%] space-y-7">
                    <h1 class="text-5xl sm:text-7xl font-extrabold text-white leading-tight">
                        Rumah <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Idaman</span><br/>
                        di Banyuwangi
                    </h1>
                    <p class="text-lg text-slate-300 max-w-xl mx-auto lg:mx-0">
                        Griya Ketapang — hunian modern strategis dengan legalitas SHM dan cicilan ringan.
                    </p>
                    <div class="flex gap-4 justify-center lg:justify-start">
                        <button class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-500 transition-all">Cari Properti</button>
                        <button @click="showCluster = true" class="border border-white/25 text-white px-8 py-4 rounded-2xl font-bold hover:bg-white/10 transition-all">Progress Unit</button>
                    </div>
                </div>
            </div>
        </header>

        <!-- FEATURED PROPERTIES -->
        <section id="jual" class="py-24 relative z-20" :class="isDark ? 'bg-slate-900' : 'bg-white'">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-black mb-4">Properti Pilihan Terkini</h2>
                    <p class="text-slate-500">Koleksi hunian premium dengan nilai investasi terbaik.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div 
                        v-for="house in houses" 
                        :key="house.id"
                        @click="openModal(house)"
                        class="group cursor-pointer rounded-3xl overflow-hidden border transition-all duration-500"
                        :class="isDark ? 'bg-slate-800 border-slate-700 hover:border-blue-500' : 'bg-white border-slate-100 hover:border-blue-300 shadow-xl'"
                    >
                        <div class="relative h-64 overflow-hidden">
                            <img :src="house.image ? (house.image.startsWith('http') ? house.image : (house.image.startsWith('image/') ? '/' + house.image : '/storage/' + house.image)) : '/image/placeholder.jpg'" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                            <div class="absolute top-4 left-4 flex flex-col gap-2">
                                <span v-if="house.is_new" class="bg-emerald-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase">Baru</span>
                                <span class="bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase">{{ house.status }}</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ house.title }}</h3>
                            <p class="text-2xl font-black text-blue-500 mb-4">{{ house.price }}</p>
                            <p class="text-sm text-slate-500 flex items-center gap-1.5 mb-6">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"/></svg>
                                {{ house.location }}
                            </p>
                            <div class="grid grid-cols-3 border-t pt-4 border-slate-100 dark:border-slate-700">
                                <div class="text-center">
                                    <p class="text-[10px] font-bold text-slate-400">KT</p>
                                    <p class="font-bold">{{ house.beds }}</p>
                                </div>
                                <div class="text-center border-x border-slate-100 dark:border-slate-700">
                                    <p class="text-[10px] font-bold text-slate-400">KM</p>
                                    <p class="font-bold">{{ house.baths }}</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-[10px] font-bold text-slate-400">LUAS</p>
                                    <p class="font-bold">{{ house.area }}m²</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-slate-950 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-slate-500">&copy; 2026 Griya Ketapang — Banyuwangi Properti</p>
            </div>
        </footer>

        <!-- Detail Modal -->
        <div v-if="selectedProperty" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm" @click.self="closeModal">
            <div class="bg-white rounded-3xl w-full max-w-4xl max-h-[90vh] overflow-y-auto text-slate-900">
                <div class="relative h-64 sm:h-96">
                    <img :src="selectedProperty.image ? (selectedProperty.image.startsWith('http') ? selectedProperty.image : (selectedProperty.image.startsWith('image/') ? '/' + selectedProperty.image : '/storage/' + selectedProperty.image)) : '/image/placeholder.jpg'" class="w-full h-full object-cover rounded-t-3xl" />
                    <button @click="closeModal" class="absolute top-6 right-6 bg-white rounded-full p-2 shadow-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h2 class="text-3xl font-black mb-2">{{ selectedProperty.title }}</h2>
                            <p class="text-blue-600 text-2xl font-black">{{ selectedProperty.price }}</p>
                        </div>
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full font-bold uppercase text-xs">{{ selectedProperty.status }}</span>
                    </div>
                    <p class="text-slate-600 leading-relaxed mb-8">{{ selectedProperty.description }}</p>
                    <div class="grid grid-cols-3 gap-4 border-y py-6 border-slate-100 mb-8">
                        <div class="text-center">
                            <p class="text-slate-400 text-xs font-bold mb-1">KAMAR TIDUR</p>
                            <p class="text-xl font-black">{{ selectedProperty.beds }}</p>
                        </div>
                        <div class="text-center border-x border-slate-100">
                            <p class="text-slate-400 text-xs font-bold mb-1">KAMAR MANDI</p>
                            <p class="text-xl font-black">{{ selectedProperty.baths }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-slate-400 text-xs font-bold mb-1">LUAS BANGUNAN</p>
                            <p class="text-xl font-black">{{ selectedProperty.area }} m²</p>
                        </div>
                    </div>
                    <button class="w-full bg-green-500 text-white font-black py-5 rounded-2xl shadow-lg hover:bg-green-600 transition-all flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                        Hubungi via WhatsApp
                    </button>
                </div>
            </div>
        </div>

    </div>
</template>
