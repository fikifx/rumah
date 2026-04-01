<template>
  <div class="fixed inset-0 z-[100] flex flex-col" :class="isDark ? 'bg-[#0a0f1e]' : 'bg-[#f0f4ff]'">

    <!-- ── TOP BAR ── -->
    <div :class="['flex items-center gap-3 px-4 sm:px-6 py-4 border-b sticky top-0 z-10', isDark ? 'bg-[#0e1729] border-blue-900/40' : 'bg-white border-slate-200 shadow-sm']">
      <button @click="$emit('close')" :class="['p-2 rounded-xl transition-all', isDark ? 'hover:bg-slate-800 text-slate-300' : 'hover:bg-slate-100 text-slate-600']">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
      </button>
      <div>
        <h1 :class="['text-base sm:text-lg font-extrabold tracking-tight', isDark ? 'text-white' : 'text-slate-900']">Cluster RumahImpian — Progress Unit</h1>
        <p :class="['text-xs', isDark ? 'text-slate-400' : 'text-slate-500']">Bintaro, Tangerang Selatan · 43 Unit</p>
      </div>
      <div class="ml-auto flex items-center gap-2 text-xs font-semibold">
        <span class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/15 text-emerald-500"><span class="w-2 h-2 rounded-full bg-emerald-500"></span>Selesai</span>
        <span class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-500/15 text-amber-500"><span class="w-2 h-2 rounded-full bg-amber-500"></span>Proses</span>
        <span class="flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-400/15 text-slate-400"><span class="w-2 h-2 rounded-full bg-slate-400"></span>Belum</span>
      </div>
    </div>

    <!-- ── CONTENT ── -->
    <div class="flex-1 overflow-y-auto">

      <!-- HOUSE DETAIL -->
      <div v-if="selectedUnit" class="max-w-4xl mx-auto px-4 sm:px-6 py-6">
        <!-- Back button -->
        <button @click="selectedUnit = null" :class="['flex items-center gap-2 text-sm font-semibold mb-6 px-4 py-2 rounded-xl transition-all', isDark ? 'text-blue-400 hover:bg-blue-900/30' : 'text-blue-600 hover:bg-blue-50']">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
          Kembali ke Daftar Unit
        </button>

        <!-- Unit Header -->
        <div :class="['rounded-2xl p-6 mb-6 border', isDark ? 'bg-[#0e1729] border-blue-900/40' : 'bg-white border-slate-200 shadow-sm']">
          <div class="flex items-start justify-between flex-wrap gap-4">
            <div>
              <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-extrabold text-lg shadow-lg shadow-blue-500/30">
                  {{ selectedUnit.number }}
                </div>
                <div>
                  <h2 :class="['text-xl font-extrabold', isDark ? 'text-white' : 'text-slate-900']">Unit {{ selectedUnit.number }}</h2>
                  <p :class="['text-sm', isDark ? 'text-slate-400' : 'text-slate-500']">{{ selectedUnit.type }} · {{ selectedUnit.luas }}</p>
                </div>
              </div>
              <p class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">{{ selectedUnit.price }}</p>
            </div>
            <div class="flex flex-col items-end gap-2">
              <span :class="['px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest', statusStyle(selectedUnit.overallStatus)]">{{ selectedUnit.overallStatus }}</span>
              <!-- Progress Bar -->
              <div class="w-40">
                <div class="flex justify-between text-xs mb-1" :class="isDark ? 'text-slate-400' : 'text-slate-500'">
                  <span>Total Progress</span>
                  <span class="font-bold text-blue-500">{{ calcProgress(selectedUnit) }}%</span>
                </div>
                <div class="h-2 rounded-full" :class="isDark ? 'bg-slate-700' : 'bg-slate-100'">
                  <div class="h-2 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 transition-all duration-700" :style="{ width: calcProgress(selectedUnit) + '%' }"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Progress Timeline -->
        <div class="space-y-4">
          <h3 :class="['text-base font-extrabold mb-4', isDark ? 'text-white' : 'text-slate-900']">Timeline Pembangunan</h3>
          <div v-for="(stage, si) in selectedUnit.stages" :key="si"
               :class="['rounded-2xl border overflow-hidden transition-all', isDark ? 'bg-[#0e1729] border-blue-900/40' : 'bg-white border-slate-100 shadow-sm']">
            <!-- Stage Header (Clickable) -->
            <button @click="toggleStage(si)" class="w-full px-5 py-4 flex items-center gap-4 text-left">
              <!-- Icon -->
              <div :class="['w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 text-white font-bold text-sm', stageIconBg(stage.status)]">
                <svg v-if="stage.status === 'done'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                <svg v-else-if="stage.status === 'active'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span v-else class="text-xs font-bold">{{ si + 1 }}</span>
              </div>
              <div class="flex-1">
                <p :class="['font-bold text-sm sm:text-base', isDark ? 'text-slate-100' : 'text-slate-900']">{{ stage.name }}</p>
                <p :class="['text-xs', isDark ? 'text-slate-500' : 'text-slate-400']">{{ stage.date || 'Belum dijadwalkan' }}</p>
              </div>
              <div class="flex items-center gap-3">
                <span v-if="stage.photos && stage.photos.length" :class="['text-xs font-semibold px-2.5 py-1 rounded-full', isDark ? 'bg-blue-900/50 text-blue-300' : 'bg-blue-50 text-blue-600']">
                  {{ stage.photos.length }} Foto
                </span>
                <span :class="['text-xs font-bold px-2.5 py-1 rounded-full', stageStatusStyle(stage.status)]">{{ stageStatusLabel(stage.status) }}</span>
                <svg :class="['h-4 w-4 transition-transform', isDark ? 'text-slate-500' : 'text-slate-400', openStage === si ? 'rotate-180' : '']" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
              </div>
            </button>

            <!-- Stage Detail (Expandable) -->
            <div v-if="openStage === si" :class="['border-t px-5 py-4', isDark ? 'border-blue-900/30 bg-[#080d1a]' : 'border-slate-100 bg-slate-50']">
              <p v-if="stage.notes" :class="['text-sm font-light mb-4', isDark ? 'text-slate-300' : 'text-slate-600']">{{ stage.notes }}</p>

              <!-- Photos Grid -->
              <div v-if="stage.photos && stage.photos.length">
                <h4 :class="['text-xs font-bold uppercase tracking-widest mb-3', isDark ? 'text-slate-400' : 'text-slate-500']">Dokumentasi Foto</h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                  <div v-for="(photo, pi) in stage.photos" :key="pi"
                       @click="openPhoto = photo"
                       class="relative aspect-square rounded-xl overflow-hidden cursor-pointer group">
                    <img :src="photo.url" :alt="photo.caption" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-2">
                      <p class="text-white text-xs font-medium line-clamp-2">{{ photo.caption }}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div v-else class="flex items-center gap-2 text-sm" :class="isDark ? 'text-slate-500' : 'text-slate-400'">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Belum ada dokumentasi foto
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- UNIT GRID -->
      <div v-else class="max-w-7xl mx-auto px-4 sm:px-6 py-6">
        <!-- Summary Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
          <div v-for="(s, i) in summary" :key="i" :class="['rounded-2xl p-4 border text-center', isDark ? 'bg-[#0e1729] border-blue-900/40' : 'bg-white border-slate-200 shadow-sm']">
            <p :class="['text-3xl font-extrabold', s.color]">{{ s.count }}</p>
            <p :class="['text-xs font-semibold mt-1 uppercase tracking-widest', isDark ? 'text-slate-400' : 'text-slate-500']">{{ s.label }}</p>
          </div>
        </div>

        <!-- Grid of Units -->
        <h2 :class="['text-base font-extrabold mb-4', isDark ? 'text-white' : 'text-slate-900']">Peta Unit Kavling (43 Unit)</h2>
        <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 xl:grid-cols-11 gap-3">
          <button
            v-for="unit in units" :key="unit.number"
            @click="openUnit(unit)"
            :class="['relative aspect-square rounded-2xl border-2 flex flex-col items-center justify-center transition-all hover:scale-105 hover:shadow-lg group', unitCardStyle(unit.overallStatus)]"
          >
            <!-- House Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-1" :class="unitIconColor(unit.overallStatus)" fill="currentColor" viewBox="0 0 24 24">
              <path d="M11.47 3.84a1 1 0 011.06 0l8.99 5.83a1 1 0 01-.06 1.74v8.59A2 2 0 0119.5 22h-4a1 1 0 01-1-1v-5h-5v5a1 1 0 01-1 1h-4A2 2 0 012.5 20v-8.59a1 1 0 01-.06-1.74l8.99-5.83z"/>
            </svg>
            <span class="text-[11px] font-extrabold leading-none">{{ unit.number }}</span>

            <!-- Progress dot -->
            <div :class="['absolute top-1.5 right-1.5 w-2 h-2 rounded-full', progressDot(unit.overallStatus)]"></div>

            <!-- Tooltip on hover -->
            <div class="absolute -top-16 left-1/2 -translate-x-1/2 hidden group-hover:block z-20 w-36">
              <div :class="['px-3 py-2 rounded-xl text-xs shadow-xl text-center', isDark ? 'bg-slate-700 text-white' : 'bg-slate-900 text-white']">
                <p class="font-bold">Unit {{ unit.number }}</p>
                <p class="opacity-80">{{ unit.type }}</p>
                <p class="opacity-70">{{ unit.price }}</p>
              </div>
            </div>
          </button>
        </div>

        <!-- Legend -->
        <div :class="['mt-8 p-4 rounded-2xl border text-sm', isDark ? 'bg-[#0e1729] border-blue-900/40 text-slate-300' : 'bg-white border-slate-200 text-slate-600 shadow-sm']">
          <p class="font-semibold mb-2">Keterangan:</p>
          <div class="flex flex-wrap gap-4 text-xs">
            <span class="flex items-center gap-2"><span class="w-5 h-5 rounded bg-emerald-500/20 border-2 border-emerald-500 inline-block"></span>Selesai / Terbangun</span>
            <span class="flex items-center gap-2"><span class="w-5 h-5 rounded bg-amber-500/20 border-2 border-amber-400 inline-block"></span>Dalam Pembangunan</span>
            <span class="flex items-center gap-2"><span class="w-5 h-5 rounded bg-blue-500/20 border-2 border-blue-400 inline-block"></span>DP / Booking</span>
            <span class="flex items-center gap-2"><span class="w-5 h-5 rounded bg-slate-200 border-2 border-slate-300 inline-block"></span>Tersedia / Belum Terjual</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Photo Lightbox -->
    <div v-if="openPhoto" class="fixed inset-0 z-[200] bg-black/90 flex items-center justify-center p-4" @click.self="openPhoto = null">
      <div class="relative max-w-3xl w-full">
        <button @click="openPhoto = null" class="absolute -top-10 right-0 text-white/70 hover:text-white p-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img :src="openPhoto.url" :alt="openPhoto.caption" class="w-full rounded-2xl shadow-2xl max-h-[75vh] object-contain">
        <p class="text-white/80 text-sm text-center mt-3">{{ openPhoto.caption }}</p>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps(['isDark'])
const emit = defineEmits(['close'])

const selectedUnit = ref(null)
const openStage = ref(null)
const openPhoto = ref(null)

const toggleStage = (i) => { openStage.value = openStage.value === i ? null : i }

// ── Helper functions ──
const stageIconBg = (s) => s === 'done' ? 'bg-emerald-500' : s === 'active' ? 'bg-amber-500' : 'bg-slate-400'
const stageStatusStyle = (s) => s === 'done' ? 'bg-emerald-500/15 text-emerald-500' : s === 'active' ? 'bg-amber-500/15 text-amber-500' : 'bg-slate-200/50 text-slate-400'
const stageStatusLabel = (s) => s === 'done' ? 'Selesai' : s === 'active' ? 'Proses' : 'Belum'
const statusStyle = (s) => s === 'Selesai' ? 'bg-emerald-500/20 text-emerald-500' : s === 'Proses' ? 'bg-amber-500/20 text-amber-600' : s === 'Booking' ? 'bg-blue-500/20 text-blue-600' : 'bg-slate-200 text-slate-500'
const unitCardStyle = (s) => s === 'Selesai' ? 'bg-emerald-500/10 border-emerald-500 text-emerald-700' : s === 'Proses' ? 'bg-amber-500/10 border-amber-400 text-amber-700' : s === 'Booking' ? 'bg-blue-500/10 border-blue-400 text-blue-700' : 'bg-slate-100 border-slate-300 text-slate-500 dark:bg-slate-800/50 dark:border-slate-600 dark:text-slate-400'
const unitIconColor = (s) => s === 'Selesai' ? 'text-emerald-500' : s === 'Proses' ? 'text-amber-500' : s === 'Booking' ? 'text-blue-500' : 'text-slate-400'
const progressDot = (s) => s === 'Selesai' ? 'bg-emerald-500' : s === 'Proses' ? 'bg-amber-400 animate-pulse' : s === 'Booking' ? 'bg-blue-500' : 'bg-slate-300'
const calcProgress = (unit) => {
  const total = unit.stages.length
  const done = unit.stages.filter(s => s.status === 'done').length
  return Math.round((done / total) * 100)
}

const openUnit = (unit) => {
  selectedUnit.value = unit
  openStage.value = null
}

// ── Dummy photos (using picsum for placeholder) ──
const p = (id, caption) => ({ url: `https://picsum.photos/seed/${id}/400/300`, caption })

// ── Stage template generator ──
const makeStages = (progress) => {
  const stageNames = [
    { name: 'DP / Booking', key: 'dp' },
    { name: 'Mulai Pembangunan', key: 'start' },
    { name: 'Pondasi', key: 'foundation' },
    { name: 'Dinding & Struktur', key: 'walls' },
    { name: 'Naikkan Atap', key: 'roof' },
    { name: 'Finishing Indoor', key: 'indoor' },
    { name: 'Finishing Outdoor', key: 'outdoor' },
    { name: 'Kusen Jendela', key: 'windows' },
    { name: 'Kusen Pintu', key: 'doors' },
    { name: 'Instalasi PDAM', key: 'water' },
    { name: 'Instalasi Listrik', key: 'electric' },
    { name: 'Foto Realisasi', key: 'final' },
  ]
  return stageNames.map((s, i) => {
    const stat = i < progress ? 'done' : i === progress ? 'active' : 'pending'
    const dummyDates = ['10 Jan 2025','25 Jan 2025','5 Feb 2025','20 Feb 2025','10 Mar 2025','28 Mar 2025','15 Apr 2025','30 Apr 2025','12 Mei 2025','25 Mei 2025','10 Jun 2025','25 Jun 2025']
    return {
      name: s.name,
      status: stat,
      date: stat !== 'pending' ? dummyDates[i] : null,
      notes: stat !== 'pending' ? `Pekerjaan ${s.name.toLowerCase()} telah ${stat === 'done' ? 'selesai dikerjakan sesuai spesifikasi' : 'sedang dalam pengerjaan oleh tim kontraktor'}.` : null,
      photos: stat === 'done' ? [p(s.key+'-a', `${s.name} - tampak depan`), p(s.key+'-b', `${s.name} - detail`)] : stat === 'active' ? [p(s.key+'-c', `${s.name} - proses`)] : []
    }
  })
}

// ── 43 Unit data ──
const units = ref(Array.from({ length: 43 }, (_, i) => {
  const n = i + 1
  const str = n.toString().padStart(2, '0')

  // Determine status distribution for realism
  let overallStatus, progress
  if (n <= 8) { overallStatus = 'Selesai'; progress = 12 }
  else if (n <= 15) { overallStatus = 'Proses'; progress = [9,10,7,8,6,11,5][n-9] || 8 }
  else if (n <= 20) { overallStatus = 'Booking'; progress = [2,1,3,2,1][n-16] || 1 }
  else { overallStatus = 'Tersedia'; progress = 0 }

  const typeMap = ['Tipe 36','Tipe 45','Tipe 54','Tipe 60','Tipe 72'][n % 5]
  const priceMap = ['Rp 650 Jt','Rp 750 Jt','Rp 850 Jt','Rp 950 Jt','Rp 1,1 M'][n % 5]

  return {
    number: str,
    type: typeMap,
    luas: `LT ${[72,90,105,120,144][n%5]} / LB ${[36,45,54,60,72][n%5]}`,
    price: priceMap,
    overallStatus,
    stages: makeStages(progress),
  }
}))

// ── Summary stats ──
const summary = computed(() => [
  { label: 'Total Unit', count: units.value.length, color: 'text-blue-500' },
  { label: 'Selesai', count: units.value.filter(u => u.overallStatus === 'Selesai').length, color: 'text-emerald-500' },
  { label: 'Dalam Proses', count: units.value.filter(u => u.overallStatus === 'Proses').length, color: 'text-amber-500' },
  { label: 'Tersedia', count: units.value.filter(u => u.overallStatus === 'Tersedia').length, color: 'text-slate-400' },
])
</script>
