<template>
  <div :class="['min-h-screen overflow-x-hidden transition-colors duration-500', isDark ? 'bg-[#0a0f1e] text-slate-100' : 'bg-[#f8faff] text-slate-800']">

    <!-- CLUSTER PROGRESS (full-screen overlay) -->
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
        <a href="#" class="flex items-center gap-2 group transition-transform duration-300 hover:scale-[1.02]">
          <div class="relative flex items-center justify-center h-8 w-8 sm:h-10 sm:w-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-white" viewBox="0 0 24 24" fill="currentColor">
              <path d="M11.47 3.84a1 1 0 011.06 0l8.99 5.83a1 1 0 01.37 1.35l-.01.02a1 1 0 01-1.35.37L20 10.95V20a2 2 0 01-2 2h-4a1 1 0 01-1-1v-5h-2v5a1 1 0 01-1 1H6a2 2 0 01-2-2v-9.05l-.53.46a1 1 0 01-1.35-.37l-.01-.02a1 1 0 01.37-1.35l8.99-5.83z" />
            </svg>
          </div>
          <span :class="['text-xl sm:text-2xl font-black tracking-tight', isScrolled ? (isDark ? 'text-white' : 'text-slate-900') : 'text-white']">
            Griya<span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">Ketapang</span>
          </span>
        </a>

        <!-- Desktop Links -->
        <div class="hidden lg:flex items-center gap-8 xl:gap-10">
          <a href="#jual" :class="['text-sm font-semibold tracking-wide hover:text-blue-500 transition-colors', isScrolled ? (isDark ? 'text-slate-300' : 'text-slate-600') : 'text-white/90']">Beli</a>
          <a href="#sewa" :class="['text-sm font-semibold tracking-wide hover:text-blue-500 transition-colors', isScrolled ? (isDark ? 'text-slate-300' : 'text-slate-600') : 'text-white/90']">Sewa</a>
          <a href="#baru" :class="['text-sm font-semibold tracking-wide hover:text-blue-500 transition-colors', isScrolled ? (isDark ? 'text-slate-300' : 'text-slate-600') : 'text-white/90']">Proyek Baru</a>
          <button @click="showCluster = true" :class="['text-sm font-semibold tracking-wide hover:text-blue-500 transition-colors flex items-center gap-1.5', isScrolled ? (isDark ? 'text-slate-300' : 'text-slate-600') : 'text-white/90']">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            Progress Unit
          </button>
          
          <!-- Dark Mode Toggle -->
          <button @click="toggleDarkMode" :class="['group p-2.5 rounded-xl transition-all duration-300', isDark ? 'bg-slate-800 text-amber-300 hover:bg-slate-700 shadow-inner' : isScrolled ? 'text-slate-600 hover:bg-slate-100' : 'text-white/80 hover:bg-white/10']" title="Toggle Dark Mode">
            <svg v-if="!isDark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:rotate-90 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-rotate-12 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
          </button>
          
          <button @click="showCluster = true" :class="['px-6 py-2.5 rounded-full text-sm font-bold transition-all tracking-wide',
                           isScrolled ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 hover:scale-105' : 'bg-white text-blue-700 hover:bg-slate-50 shadow-lg hover:scale-105']">
            Masuk
          </button>
        </div>

        <!-- Mobile Menu Button -->
        <div class="lg:hidden flex items-center gap-2">
          <!-- Dark Mode Toggle Mobile -->
          <button @click="toggleDarkMode" :class="['group p-2.5 rounded-xl transition-all duration-300', isDark ? 'bg-gradient-to-br from-slate-700 to-slate-800 text-amber-300 hover:from-slate-600 hover:to-slate-700 shadow-lg shadow-slate-900/50' : isScrolled ? 'text-slate-700 hover:bg-slate-100/80' : 'text-white hover:bg-white/10']" title="Toggle Dark Mode">
            <!-- Sun Icon (Light Mode) -->
            <svg v-if="!isDark" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:rotate-90 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <!-- Moon Icon (Dark Mode) -->
            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-rotate-12 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
          </button>
          
          <button class="p-2 rounded-lg transition-colors" :class="[isScrolled ? 'text-slate-900 hover:bg-slate-100' : 'text-white hover:bg-white/10']">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </nav>

    <!-- 2. HERO SECTION -->
    <header class="relative w-full min-h-screen pt-20 sm:pt-24 lg:pt-32 pb-10 sm:pb-12 flex items-center justify-center overflow-hidden">
      <!-- Background Image with Overlay -->
      <div 
        class="absolute inset-0 z-0 bg-cover bg-center"
        :style="{ backgroundImage: 'url(' + heroImage + ')' }"
      ></div>
      <!-- Premium Gradient Overlay -->
      <div class="absolute inset-0 z-10 bg-gradient-to-br from-slate-950/90 via-slate-900/80 to-indigo-950/70"></div>
      
      <!-- Decorative gradient elements -->
      <div class="absolute top-1/2 -left-64 w-96 h-96 bg-blue-600/20 rounded-full filter blur-3xl -z-10"></div>
      <div class="absolute -bottom-64 right-0 w-96 h-96 bg-indigo-600/20 rounded-full filter blur-3xl -z-10"></div>
      
      <!-- Hero Content -->
      <div class="relative z-20 w-full max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center justify-between gap-10 lg:gap-16">
        
        <!-- Left Content -->
        <div class="w-full lg:w-[55%] space-y-7 text-center lg:text-left">
          <!-- Badge -->
          <div class="flex justify-center lg:justify-start">
            <span class="inline-flex items-center gap-2 py-2 px-4 rounded-full bg-white/10 text-white font-semibold text-xs sm:text-sm border border-white/20 backdrop-blur-md">
              <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-300 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-400"></span>
              </span>
              Perumahan Premium di Ketapang, Banyuwangi
            </span>
          </div>

          <!-- Heading -->
          <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-[1.1] tracking-tight drop-shadow-2xl">
            Rumah <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 via-sky-300 to-cyan-300 anim-gradient">Idaman</span><br/>
            di <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-yellow-300 to-orange-300 anim-gradient">Ketapang</span>
          </h1>

          <!-- Subtitle SEO-friendly -->
          <p class="text-base sm:text-lg text-slate-300 max-w-xl leading-relaxed font-light mx-auto lg:mx-0">
            Perumahan <strong class="text-white font-semibold">Griya Ketapang</strong> — hunian modern dan nyaman di Ketapang, Banyuwangi, Jawa Timur. Kavling strategis, harga terjangkau, dan cicilan ringan. Wujudkan rumah impian keluarga Anda sekarang.
          </p>
          
          <!-- CTA Button -->
          <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start pt-2">
            <button class="group bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold py-4 px-8 rounded-2xl shadow-2xl shadow-blue-700/50 hover:shadow-blue-500/60 transition-all flex items-center justify-center gap-2.5 text-sm sm:text-base hover:scale-105">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
              Cari Properti
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
            </button>
            <button class="px-8 py-4 rounded-2xl border-2 border-white/25 hover:border-white/50 bg-white/5 hover:bg-white/10 text-white font-semibold transition-all flex items-center justify-center gap-2.5 text-sm sm:text-base hover:scale-105">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              Lihat Demo
            </button>
          </div>

          <!-- Quick Stats -->
          <div class="flex items-center gap-8 pt-4 justify-center lg:justify-start">
            <div class="text-center lg:text-left">
              <p class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-cyan-300">43</p>
              <p class="text-xs text-slate-400 font-medium mt-0.5 uppercase tracking-widest">Unit Kavling</p>
            </div>
            <div class="h-10 w-px bg-gradient-to-b from-transparent via-slate-500 to-transparent"></div>
            <div class="text-center lg:text-left">
              <p class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-amber-300 to-orange-300">100%</p>
              <p class="text-xs text-slate-400 font-medium mt-0.5 uppercase tracking-widest">Legalitas SHM</p>
            </div>
            <div class="h-10 w-px bg-gradient-to-b from-transparent via-slate-500 to-transparent"></div>
            <div class="text-center lg:text-left">
              <p class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-cyan-300">KPR</p>
              <p class="text-xs text-slate-400 font-medium mt-0.5 uppercase tracking-widest">Ready</p>
            </div>
          </div>
        </div>

        <!-- Right: Search Box -->
        <div class="w-full lg:w-2/5 mt-8 lg:mt-0">
          <div class="bg-white/15 backdrop-blur-2xl border border-white/30 hover:border-white/50 p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-2xl transition-all duration-300 group">
            <h3 class="text-xl sm:text-2xl font-bold text-white mb-5 sm:mb-6 flex items-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
              Mulai Pencarian Cepat
            </h3>
            
            <!-- Tabs -->
            <div class="flex gap-2 mb-6 bg-white/10 p-1.5 rounded-full border border-white/20">
               <button 
                v-for="tab in ['Beli', 'Sewa', 'Baru']" 
                :key="tab"
                @click="activeTab = tab"
                :class="[
                  'flex-1 py-2 sm:py-2.5 text-xs sm:text-sm font-bold rounded-full transition-all duration-300',
                  activeTab === tab 
                    ? 'bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-600/40' 
                    : 'text-slate-300 hover:text-white hover:bg-white/10'
                ]"
              >
                {{ tab }}
              </button>
            </div>

            <!-- Search Fields -->
            <div class="space-y-3 sm:space-y-4">
              <div>
                <label class="flex items-center gap-1.5 text-xs font-bold text-slate-200 mb-2 uppercase tracking-wide">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                  Lokasi
                </label>
                <input type="text" placeholder="Jakarta, Bandung..." 
                       class="w-full bg-white/95 border border-slate-200 rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-slate-800 placeholder-slate-500 focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 transition-all font-medium text-sm sm:text-base">
              </div>
              
              <div>
                <label class="flex items-center gap-1.5 text-xs font-bold text-slate-200 mb-2 uppercase tracking-wide">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                  Tipe Properti
                </label>
                <select class="w-full bg-white/95 border border-slate-200 rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-slate-800 focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 transition-all appearance-none font-medium cursor-pointer text-sm sm:text-base">
                  <option>Semua Tipe</option>
                  <option>Rumah Tapak</option>
                  <option>Apartemen</option>
                  <option>Ruko</option>
                  <option>Townhouse</option>
                  <option>Tanah</option>
                </select>
              </div>

              <div class="grid grid-cols-2 gap-2 sm:gap-3">
                <div>
                  <label class="block text-xs font-bold text-slate-200 mb-2 uppercase tracking-wide">Min</label>
                  <input type="text" placeholder="500 juta" 
                         class="w-full bg-white/95 border border-slate-200 rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-slate-800 placeholder-slate-500 focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 transition-all text-xs sm:text-sm">
                </div>
                <div>
                  <label class="block text-xs font-bold text-slate-200 mb-2 uppercase tracking-wide">Max</label>
                  <input type="text" placeholder="5 miliar" 
                         class="w-full bg-white/95 border border-slate-200 rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-slate-800 placeholder-slate-500 focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 transition-all text-xs sm:text-sm">
                </div>
              </div>

              <button class="w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white font-bold py-3 sm:py-4 rounded-lg sm:rounded-xl shadow-lg shadow-indigo-600/40 hover:shadow-indigo-600/60 transition-all mt-4 sm:mt-6 flex justify-center items-center gap-2 group text-sm sm:text-base">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Cari Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </button>
            </div>
          </div>
        </div>

      </div>

      <!-- Scroll Indicator -->
      <div class="absolute bottom-6 sm:bottom-8 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 sm:h-6 w-5 sm:w-6 text-white/70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
      </div>
    </header>

    <!-- 3. STATISTICS SECTION -->
    <section class="relative py-14 sm:py-20 overflow-hidden" :class="isDark ? 'bg-[#0e1729]' : 'bg-gradient-to-br from-blue-700 via-indigo-700 to-blue-900'">
      <!-- Decorative orbs -->
      <div class="absolute top-0 left-1/4 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
      <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
      
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
          <div v-for="(stat, i) in [{n:'150K+',l:'Properti',c:'from-blue-300 to-cyan-300'},{n:'50K+',l:'Transaksi',c:'from-emerald-300 to-teal-300'},{n:'200+',l:'Kota & Area',c:'from-amber-300 to-orange-300'},{n:'24/7',l:'Dukungan',c:'from-purple-300 to-pink-300'}]" :key="i"
               class="group text-center p-6 sm:p-8 rounded-2xl border transition-all duration-300"
               :class="isDark ? 'bg-white/5 border-white/10 hover:bg-white/10 hover:border-blue-400/40' : 'bg-white/10 border-white/20 hover:bg-white/20 backdrop-blur-sm'">
            <div :class="['text-4xl sm:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r mb-2 group-hover:scale-110 transition-transform', stat.c]">{{ stat.n }}</div>
            <p class="text-sm font-semibold text-white/70 uppercase tracking-widest">{{ stat.l }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- 4. FEATURED PROPERTIES SECTION -->
    <section id="jual" class="relative py-12 sm:py-16 md:py-24 overflow-hidden transition-colors duration-500" :class="isDark ? 'bg-slate-800' : 'bg-white'">
      <!-- Background -->
      <div :class="['absolute inset-0', isDark ? 'bg-gradient-to-b from-slate-800 to-slate-900' : 'bg-gradient-to-b from-slate-50 to-white']"></div>
      
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
          <span :class="['inline-flex items-center gap-1.5 py-1.5 px-3 sm:px-4 rounded-full font-semibold text-xs sm:text-sm mb-3 sm:mb-4', isDark ? 'bg-slate-700 text-blue-300' : 'bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700']">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
            PILIHAN TERBAIK
          </span>
          <h2 :class="['text-3xl sm:text-4xl md:text-5xl font-black mb-3 sm:mb-4', isDark ? 'text-white' : 'text-slate-900']">Properti Pilihan Premium</h2>
          <p :class="['text-sm sm:text-base md:text-lg font-light px-4 sm:px-0', isDark ? 'text-slate-400' : 'text-slate-600']">Koleksi hunian eksklusif dipilih khusus untuk nilai investasi terbaik dan kualitas hidup premium.</p>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-7 lg:gap-8">
          
          <div 
            v-for="(property, index) in featuredProperties.slice(0, 6)" 
            :key="index"
            @click="openModal(property)"
            :class="['group cursor-pointer rounded-xl sm:rounded-2xl overflow-hidden shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full', isDark ? 'bg-slate-700 border border-slate-600 hover:border-blue-400' : 'bg-white border border-slate-100 hover:border-blue-300']"
          >
            <!-- Image Section -->
            <div class="relative h-48 sm:h-56 md:h-64 overflow-hidden bg-slate-200">
              <img :src="property.image" :alt="property.title" 
                   class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-700" />
              
              <!-- Status Badges -->
              <div class="absolute top-3 sm:top-4 left-3 sm:left-4 flex flex-col gap-2">
                <span v-if="property.isNew" class="flex items-center gap-1 bg-gradient-to-r from-emerald-500 to-cyan-500 text-white text-xs uppercase tracking-wider font-bold px-2.5 sm:px-3.5 py-1 sm:py-1.5 rounded-full shadow-lg max-w-max">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-amber-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                  Baru
                </span>
                <span :class="['text-white text-xs uppercase tracking-wider font-bold px-2.5 sm:px-3.5 py-1 sm:py-1.5 rounded-full shadow-lg w-max', property.status === 'Dijual' ? 'bg-gradient-to-r from-blue-600 to-indigo-600' : 'bg-gradient-to-r from-amber-600 to-orange-600']">
                  {{ property.status }}
                </span>
              </div>
              
              <!-- Wishlist Button -->
              <button :class="['absolute top-3 sm:top-4 right-3 sm:right-4 backdrop-blur-sm p-2 sm:p-2.5 rounded-full text-slate-400 hover:text-red-500 transition-all shadow-lg', isDark ? 'bg-slate-700/90 hover:bg-red-900/50' : 'bg-white/90 hover:bg-red-50']">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
              </button>
            </div>
            
            <!-- Card Content -->
            <div :class="['p-4 sm:p-5 md:p-6 flex-1 flex flex-col', isDark ? 'bg-slate-700' : 'bg-white']">
              <h3 :class="['text-lg sm:text-xl font-bold group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-indigo-600 transition-all line-clamp-2 mb-2 sm:mb-3', isDark ? 'text-slate-100' : 'text-slate-900']">
                {{ property.title }}
              </h3>
              
              <p class="text-lg sm:text-xl md:text-2xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 text-transparent bg-clip-text mb-3 sm:mb-4">{{ property.price }}</p>
              
              <p :class="['flex items-center gap-1.5 mb-4 sm:mb-5 font-medium text-xs sm:text-sm line-clamp-1', isDark ? 'text-slate-400' : 'text-slate-600']">
                <svg :class="['h-3 sm:h-4 w-3 sm:w-4 flex-shrink-0', isDark ? 'text-slate-500' : 'text-slate-400']" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
                {{ property.location }}
              </p>
              
              <!-- Specs -->
              <div :class="['grid grid-cols-3 gap-2 pt-4 sm:pt-5 mt-auto', isDark ? 'border-t border-slate-600' : 'border-t border-slate-100']">
                <div class="text-center">
                   <div :class="['text-xs font-bold mb-1', isDark ? 'text-slate-500' : 'text-slate-400']">KAMAR</div>
                   <div :class="['text-lg sm:text-xl font-bold', isDark ? 'text-slate-200' : 'text-slate-900']">{{ property.beds }}</div>
                </div>
                <div :class="['text-center', isDark ? 'border-l border-r border-slate-600' : 'border-l border-r border-slate-100']">
                   <div :class="['text-xs font-bold mb-1', isDark ? 'text-slate-500' : 'text-slate-400']">MANDI</div>
                   <div :class="['text-lg sm:text-xl font-bold', isDark ? 'text-slate-200' : 'text-slate-900']">{{ property.baths }}</div>
                </div>
                <div class="text-center">
                   <div :class="['text-xs font-bold mb-1', isDark ? 'text-slate-500' : 'text-slate-400']">LUAS</div>
                   <div :class="['text-lg sm:text-xl font-bold', isDark ? 'text-slate-200' : 'text-slate-900']">{{ property.area }}m²</div>
                </div>
              </div>

              <!-- View Button -->
              <button :class="['flex items-center justify-center gap-1.5 w-full mt-4 sm:mt-5 px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg font-bold transition-all group/btn text-xs sm:text-sm', isDark ? 'bg-slate-600 hover:bg-slate-500 text-blue-300' : 'bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 text-blue-600']">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Lihat Detail
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 sm:h-4 w-3.5 sm:w-4 inline ml-1.5 group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </button>
            </div>
          </div>

        </div>

        <!-- View All Button -->
        <div class="text-center mt-12 sm:mt-16">
          <button class="px-6 sm:px-8 py-3 sm:py-4 rounded-lg sm:rounded-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 hover:from-blue-700 hover:via-indigo-700 hover:to-purple-700 text-white font-bold shadow-lg sm:shadow-xl shadow-indigo-600/40 hover:shadow-indigo-600/60 transition-all text-sm sm:text-base flex items-center gap-2 mx-auto group">
            Jelajahi Semua Properti
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </button>
        </div>
      </div>
    </section>

    <!-- 5. FEATURES SECTION -->
    <section :class="['py-12 sm:py-16 md:py-20 lg:py-24 relative overflow-hidden transition-colors duration-500', isDark ? 'bg-slate-800' : 'bg-gradient-to-b from-slate-50 to-white']">
      <div :class="['absolute inset-0', isDark ? 'opacity-10' : 'opacity-5']">
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply blur-3xl"></div>
      </div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-14 md:mb-16">
          <span :class="['inline-flex items-center gap-1.5 py-1 px-4 rounded-full font-semibold text-xs sm:text-sm mb-3 sm:mb-4', isDark ? 'bg-slate-700 text-blue-300' : 'bg-blue-100 text-blue-600']">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            KEUNGGULAN KAMI
          </span>
          <h2 :class="['text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black mb-3 sm:mb-4', isDark ? 'text-white' : 'text-slate-900']">Mengapa Memilih RumahImpian.id?</h2>
          <p :class="['text-base sm:text-lg md:text-xl font-light leading-relaxed', isDark ? 'text-slate-400' : 'text-slate-600']">Pengalaman mencari dan membeli properti yang paling aman, transparan, dan efisien dengan dukungan tim profesional.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 md:gap-6 lg:gap-8">
          <!-- Feature 1 -->
          <div :class="['group p-5 sm:p-6 md:p-7 lg:p-8 rounded-xl sm:rounded-2xl border hover:shadow-xl transition-all hover:-translate-y-2', isDark ? 'bg-slate-700 border-slate-600 hover:border-blue-400' : 'bg-white border-slate-100 hover:border-blue-300']">
            <div :class="['w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-5 md:mb-6 group-hover:scale-110 transition-transform', isDark ? 'bg-slate-600 text-blue-400' : 'bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-600']">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-7 md:h-8 w-6 sm:w-7 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 :class="['text-lg sm:text-xl md:text-2xl font-bold mb-2 sm:mb-3', isDark ? 'text-white' : 'text-slate-900']">Terverifikasi 100%</h3>
            <p :class="['text-sm sm:text-base font-light leading-relaxed', isDark ? 'text-slate-400' : 'text-slate-600']">Semua properti melalui verifikasi ketat untuk jaminan legalitas dan keamanan investasi Anda.</p>
          </div>

          <!-- Feature 2 -->
          <div :class="['group p-5 sm:p-6 md:p-7 lg:p-8 rounded-xl sm:rounded-2xl border hover:shadow-xl transition-all hover:-translate-y-2', isDark ? 'bg-slate-700 border-slate-600 hover:border-green-400' : 'bg-white border-slate-100 hover:border-green-300']">
            <div :class="['w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-5 md:mb-6 group-hover:scale-110 transition-transform', isDark ? 'bg-slate-600 text-green-400' : 'bg-gradient-to-br from-green-100 to-emerald-100 text-green-600']">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-7 md:h-8 w-6 sm:w-7 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 :class="['text-lg sm:text-xl md:text-2xl font-bold mb-2 sm:mb-3', isDark ? 'text-white' : 'text-slate-900']">Harga Transparan</h3>
            <p :class="['text-sm sm:text-base font-light leading-relaxed', isDark ? 'text-slate-400' : 'text-slate-600']">Tidak ada biaya tersembunyi. Dapatkan penawaran terbaik langsung dari developer atau pemilik properti.</p>
          </div>

          <!-- Feature 3 -->
          <div class="group p-5 sm:p-6 md:p-7 lg:p-8 rounded-xl sm:rounded-2xl bg-white border border-slate-100 hover:border-amber-300 hover:shadow-xl transition-all hover:-translate-y-2">
            <div class="w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16 bg-gradient-to-br from-amber-100 to-orange-100 text-amber-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-5 md:mb-6 group-hover:scale-110 transition-transform">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-7 md:h-8 w-6 sm:w-7 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 mb-2 sm:mb-3">Proses Cepat</h3>
            <p class="text-sm sm:text-base text-slate-600 font-light leading-relaxed">Dukungan KPR dari 20+ bank ternama yang diurus oleh tim ahli kami dalam hitungan hari.</p>
          </div>

          <!-- Feature 4 -->
          <div class="group p-5 sm:p-6 md:p-7 lg:p-8 rounded-xl sm:rounded-2xl bg-white border border-slate-100 hover:border-purple-300 hover:shadow-xl transition-all hover:-translate-y-2">
            <div class="w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16 bg-gradient-to-br from-purple-100 to-pink-100 text-purple-600 rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-5 md:mb-6 group-hover:scale-110 transition-transform">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-7 md:h-8 w-6 sm:w-7 md:w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
            </div>
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 mb-2 sm:mb-3">Dukungan 24/7</h3>
            <p class="text-sm sm:text-base text-slate-600 font-light leading-relaxed">Tim customer service profesional siap membantu Anda kapan saja melalui berbagai saluran komunikasi.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- 6. TESTIMONIALS SECTION -->
    <section :class="['py-16 sm:py-20 md:py-28 transition-colors duration-500', isDark ? 'bg-[#0a0f1e]' : 'bg-[#f8faff]']">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 md:mb-18">
          <span :class="['inline-flex items-center gap-2 py-1.5 px-4 rounded-full font-semibold text-xs uppercase tracking-widest mb-4', isDark ? 'bg-blue-900/50 text-blue-300 border border-blue-700/50' : 'bg-blue-600/10 text-blue-700 border border-blue-200']">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            Kepuasan Pelanggan
          </span>
          <h2 :class="['text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4 tracking-tight', isDark ? 'text-white' : 'text-slate-900']">Cerita Sukses dari <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Ribuan Pelanggan</span></h2>
          <p :class="['text-base sm:text-lg font-light leading-relaxed', isDark ? 'text-slate-400' : 'text-slate-500']">Kepercayaan dari pelanggan kami adalah bukti komitmen terhadap layanan berkualitas terbaik.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          <!-- Testimonial 1 -->
          <div :class="['relative p-7 rounded-2xl border card-hover', isDark ? 'bg-[#0e1729] border-blue-900/40 hover:border-blue-500/50 shadow-xl' : 'bg-white border-slate-200 hover:border-blue-200 shadow-lg hover:shadow-xl']">
            <!-- Quote Icon -->
            <div class="absolute top-5 right-6 text-6xl leading-none font-serif font-black opacity-10" :class="isDark ? 'text-blue-400' : 'text-blue-600'">"</div>
            <div class="flex gap-1 text-amber-400 mb-5">
              <svg v-for="i in 5" :key="i" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
            </div>
            <p :class="['mb-6 font-light text-sm leading-relaxed', isDark ? 'text-slate-300' : 'text-slate-600']">"Proses pembelian sangat mudah dan cepat. Tim RumahImpian sangat membantu dalam setiap tahap transaksi. Terima kasih telah mewujudkan impian memiliki rumah!"</p>
            <div :class="['flex items-center gap-3 border-t pt-5', isDark ? 'border-blue-900/40' : 'border-slate-100']">
              <img src="https://i.pravatar.cc/150?img=1" alt="Customer" class="w-11 h-11 rounded-full ring-2 ring-blue-500/30">
              <div>
                <p :class="['font-bold text-sm', isDark ? 'text-white' : 'text-slate-900']">Budi Santoso</p>
                <p class="text-xs text-slate-500 mt-0.5">Jakarta · 2024</p>
              </div>
              <span class="ml-auto text-[10px] font-bold px-2.5 py-1 rounded-full" :class="isDark ? 'bg-blue-900/50 text-blue-300' : 'bg-blue-50 text-blue-600'">Verified</span>
            </div>
          </div>

          <!-- Testimonial 2 -->
          <div :class="['relative p-7 rounded-2xl border card-hover', isDark ? 'bg-[#0e1729] border-blue-900/40 hover:border-blue-500/50 shadow-xl' : 'bg-white border-slate-200 hover:border-blue-200 shadow-lg hover:shadow-xl']">
            <div class="absolute top-5 right-6 text-6xl leading-none font-serif font-black opacity-10" :class="isDark ? 'text-blue-400' : 'text-blue-600'">"</div>
            <div class="flex gap-1 text-amber-400 mb-5">
              <svg v-for="i in 5" :key="i" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
            </div>
            <p :class="['mb-6 font-light text-sm leading-relaxed', isDark ? 'text-slate-300' : 'text-slate-600']">"Sangat puas dengan layanan properti dari RumahImpian. Pilihan properti lengkap, harga kompetitif, dan konsultasinya sangat helpful."</p>
            <div :class="['flex items-center gap-3 border-t pt-5', isDark ? 'border-blue-900/40' : 'border-slate-100']">
              <img src="https://i.pravatar.cc/150?img=2" alt="Customer" class="w-11 h-11 rounded-full ring-2 ring-emerald-500/30">
              <div>
                <p :class="['font-bold text-sm', isDark ? 'text-white' : 'text-slate-900']">Siti Nurhaliza</p>
                <p class="text-xs text-slate-500 mt-0.5">Bandung · 2024</p>
              </div>
              <span class="ml-auto text-[10px] font-bold px-2.5 py-1 rounded-full" :class="isDark ? 'bg-emerald-900/50 text-emerald-300' : 'bg-emerald-50 text-emerald-600'">Verified</span>
            </div>
          </div>

          <!-- Testimonial 3 -->
          <div :class="['relative p-7 rounded-2xl border card-hover', isDark ? 'bg-[#0e1729] border-blue-900/40 hover:border-blue-500/50 shadow-xl' : 'bg-white border-slate-200 hover:border-blue-200 shadow-lg hover:shadow-xl']">
            <div class="absolute top-5 right-6 text-6xl leading-none font-serif font-black opacity-10" :class="isDark ? 'text-blue-400' : 'text-blue-600'">"</div>
            <div class="flex gap-1 text-amber-400 mb-5">
              <svg v-for="i in 5" :key="i" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
            </div>
            <p :class="['mb-6 font-light text-sm leading-relaxed', isDark ? 'text-slate-300' : 'text-slate-600']">"Investasi properti saya berkembang pesat setelah membeli melalui RumahImpian. Kepercayaan dan transparansi mereka luar biasa!"</p>
            <div :class="['flex items-center gap-3 border-t pt-5', isDark ? 'border-blue-900/40' : 'border-slate-100']">
              <img src="https://i.pravatar.cc/150?img=3" alt="Customer" class="w-11 h-11 rounded-full ring-2 ring-purple-500/30">
              <div>
                <p :class="['font-bold text-sm', isDark ? 'text-white' : 'text-slate-900']">Ahmad Wijaya</p>
                <p class="text-xs text-slate-500 mt-0.5">Surabaya · 2024</p>
              </div>
              <span class="ml-auto text-[10px] font-bold px-2.5 py-1 rounded-full" :class="isDark ? 'bg-purple-900/50 text-purple-300' : 'bg-purple-50 text-purple-600'">Verified</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 7. CTA NEWSLETTER SECTION -->
    <section :class="['py-12 sm:py-16 md:py-20 lg:py-24 relative overflow-hidden transition-colors duration-500', isDark ? 'bg-gradient-to-r from-slate-800 via-slate-700 to-slate-800' : 'bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-700']">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply blur-3xl"></div>
        <div class="absolute -bottom-8 right-20 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply blur-3xl"></div>
      </div>
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-white mb-3 sm:mb-4 leading-tight">Dapatkan Update Properti Terbaru</h2>
        <p :class="['text-sm sm:text-base md:text-lg mb-6 sm:mb-8 font-light leading-relaxed', isDark ? 'text-slate-300' : 'text-blue-100']">Terima notifikasi properti terbaru, penawaran eksklusif, dan tips investasi properti langsung ke email Anda.</p>
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 justify-center">
          <input type="email" :class="['px-4 sm:px-6 py-3 sm:py-4 rounded-full w-full sm:w-96 placeholder-slate-500 focus:ring-4 focus:outline-none transition-all text-sm sm:text-base', isDark ? 'bg-slate-700 text-slate-100 focus:ring-slate-600/30' : 'bg-white text-slate-800 focus:ring-white/30']" placeholder="Masukkan email Anda...">
          <button :class="['px-6 sm:px-8 py-3 sm:py-4 rounded-full hover:transition-all shadow-xl whitespace-nowrap group text-sm sm:text-base font-bold', isDark ? 'bg-slate-100 text-slate-800 hover:bg-slate-200' : 'bg-white text-blue-600 hover:bg-blue-50']">
            Berlangganan
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5 inline ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </button>
        </div>
      </div>
    </section>

    <!-- 8. FAQ SECTION -->
    <section :class="['py-12 sm:py-16 md:py-20 lg:py-24 border-t transition-colors duration-500', isDark ? 'bg-slate-800 border-slate-700' : 'bg-white border-slate-100']">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-14 md:mb-16">
          <span :class="['inline-flex items-center gap-1.5 py-1 px-4 rounded-full font-semibold text-xs sm:text-sm mb-3 sm:mb-4', isDark ? 'bg-slate-700 text-purple-300' : 'bg-purple-100 text-purple-600']">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            FAQ
          </span>
          <h2 :class="['text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black mb-3 sm:mb-4', isDark ? 'text-white' : 'text-slate-900']">Pertanyaan yang Sering Diajukan</h2>
          <p :class="['text-base sm:text-lg md:text-xl font-light leading-relaxed', isDark ? 'text-slate-400' : 'text-slate-600']">Temukan jawaban atas pertanyaan umum tentang layanan dan properti kami.</p>
        </div>

        <div class="max-w-3xl mx-auto space-y-3 sm:space-y-4">
          <div 
            v-for="(faq, index) in faqs"
            :key="index"
            :class="['group border rounded-lg sm:rounded-xl overflow-hidden transition-all', isDark ? 'bg-slate-700  border-slate-600 hover:border-blue-400 hover:bg-slate-600' : 'bg-slate-50 border-slate-200 hover:border-blue-300 hover:bg-white']"
          >
            <button 
              @click="toggleFaq(index)"
              :class="['w-full px-4 sm:px-6 lg:px-8 py-4 sm:py-6 flex justify-between items-start sm:items-center gap-4 transition-colors', isDark ? 'hover:bg-slate-600' : 'hover:bg-blue-50']"
            >
              <span :class="['text-sm sm:text-base md:text-lg font-bold text-left leading-snug', isDark ? 'text-slate-200' : 'text-slate-900']">{{ faq.question }}</span>
              <svg :class="['h-5 sm:h-6 w-5 sm:w-6 transition-all duration-300 flex-shrink-0', isDark ? 'text-slate-500 group-hover:text-blue-400' : 'text-slate-400 group-hover:text-blue-600', activeFaq === index ? 'rotate-180' : '']" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
            </button>
            <div v-if="activeFaq === index" :class="['px-4 sm:px-6 lg:px-8 pb-4 sm:pb-6 border-t', isDark ? 'bg-slate-700 border-slate-600' : 'bg-blue-50 border-slate-200']">
              <p :class="['font-light leading-relaxed text-sm sm:text-base', isDark ? 'text-slate-300' : 'text-slate-700']">{{ faq.answer }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer :class="['text-white py-8 sm:py-12 md:py-16 border-t transition-colors duration-500', isDark ? 'bg-slate-900 border-slate-800' : 'bg-slate-900 border-slate-800']">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8 md:gap-10 lg:gap-12 mb-8 sm:mb-10 md:mb-12">
          <!-- About -->
          <div>
            <div class="flex items-center gap-2 mb-3 sm:mb-4 transition-transform duration-300 hover:scale-[1.02]">
              <div class="flex items-center justify-center h-8 w-8 sm:h-10 sm:w-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 shadow-lg shadow-blue-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 text-white" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M11.47 3.84a1 1 0 011.06 0l8.99 5.83a1 1 0 01.37 1.35l-.01.02a1 1 0 01-1.35.37L20 10.95V20a2 2 0 01-2 2h-4a1 1 0 01-1-1v-5h-2v5a1 1 0 01-1 1H6a2 2 0 01-2-2v-9.05l-.53.46a1 1 0 01-1.35-.37l-.01-.02a1 1 0 01.37-1.35l8.99-5.83z" />
                </svg>
              </div>
              <span class="text-lg sm:text-xl md:text-2xl font-black tracking-tight text-white">
                Rumah<span class="text-blue-400">Impian</span>
              </span>
            </div>
            <p class="text-slate-400 font-light mb-3 sm:mb-4 text-xs sm:text-sm md:text-base leading-relaxed">Platform properti terpercaya dengan 150KB+ listing dan jutaan pengguna aktif di seluruh Indonesia.</p>
            <div class="flex gap-2 sm:gap-3">
              <a href="#" class="w-9 sm:w-10 h-9 sm:h-10 bg-slate-800 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
              </a>
              <a href="#" class="w-9 sm:w-10 h-9 sm:h-10 bg-slate-800 hover:bg-blue-400 rounded-full flex items-center justify-center transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75 2.25 7-7 7-7s1.1 5-5 7l-1 .5"></path></svg>
              </a>
              <a href="#" class="w-9 sm:w-10 h-9 sm:h-10 bg-slate-800 hover:bg-red-600 rounded-full flex items-center justify-center transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.5 12 3.5 12 3.5s-7.505 0-9.377.55A3.016 3.016 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.552 9.376.552 9.376.552s7.505 0 9.377-.55a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
              </a>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h4 class="font-bold text-base sm:text-lg mb-4 sm:mb-6">Navigasi</h4>
            <ul class="space-y-2 sm:space-y-3 text-slate-400 font-light text-xs sm:text-sm">
              <li><a href="#" class="hover:text-blue-400 transition-colors">Beranda</a></li>
              <li><a href="#" class="hover:text-blue-400 transition-colors">Cari Properti</a></li>
              <li><a href="#" class="hover:text-blue-400 transition-colors">Properti Baru</a></li>
              <li><a href="#" class="hover:text-blue-400 transition-colors">Panduan</a></li>
              <li><a href="#" class="hover:text-blue-400 transition-colors">Blog</a></li>
            </ul>
          </div>

          <!-- Services -->
          <div>
            <h4 class="font-bold text-base sm:text-lg mb-4 sm:mb-6">Layanan</h4>
            <ul class="space-y-2 sm:space-y-3 text-slate-400 font-light text-xs sm:text-sm">
              <li><a href="#" class="hover:text-blue-400 transition-colors">Cari Rumah</a></li>
              <li><a href="#" class="hover:text-blue-400 transition-colors">Cicilan KPR</a></li>
              <li><a href="#" class="hover:text-blue-400 transition-colors">Jual Properti</a></li>
              <li><a href="#" class="hover:text-blue-400 transition-colors">Sewa Properti</a></li>
              <li><a href="#" class="hover:text-blue-400 transition-colors">Konsultasi</a></li>
            </ul>
          </div>

          <!-- Contact -->
          <div>
            <h4 class="font-bold text-base sm:text-lg mb-4 sm:mb-6">Hubungi Kami</h4>
            <ul class="space-y-2 sm:space-y-4 text-slate-400 font-light text-xs sm:text-sm">
              <li class="flex gap-2 sm:gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span>+62 812 345 678</span>
              </li>
              <li class="flex gap-2 sm:gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5 text-green-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" /></svg>
                <span>+62 812 345 678</span>
              </li>
              <li class="flex gap-2 sm:gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5 text-blue-300 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                <span>info@rumahimpian.id</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="border-t border-slate-800 pt-6 sm:pt-8">
          <div class="flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-6">
            <p class="text-slate-400 font-light text-center sm:text-left text-xs sm:text-sm">&copy; 2025 GriyaKetapang.id — Perumahan Premium di Ketapang, Banyuwangi, Jawa Timur. Semua Hak Cipta Dilindungi.</p>
            <div class="flex gap-4 sm:gap-6 text-slate-400 font-light text-xs sm:text-sm">
              <a href="#" class="hover:text-blue-400 transition-colors">Kebijakan Privasi</a>
              <a href="#" class="hover:text-blue-400 transition-colors">Syarat Layanan</a>
              <a href="#" class="hover:text-blue-400 transition-colors">Sitemap</a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- MODAL DETAIL PROPERTI - Enhanced Version -->
    <div 
      v-if="selectedProperty" 
      class="fixed inset-0 z-[100] flex items-start justify-center p-3 sm:p-4 bg-slate-900/70 backdrop-blur-sm transition-opacity overflow-y-auto"
      @click.self="closeModal"
    >
      <div class="bg-white rounded-2xl sm:rounded-3xl w-full max-w-6xl shadow-2xl animate-in fade-in zoom-in duration-300 my-6 sm:my-8">
        
        <!-- Modal Header with Image -->
        <div class="relative h-48 sm:h-64 md:h-80 lg:h-96">
          <img :src="selectedProperty.image" class="w-full h-full object-cover rounded-t-2xl sm:rounded-t-3xl" />

          <!-- Back / Close Buttons -->
          <button @click="closeModal" class="absolute top-3 sm:top-4 md:top-6 left-3 sm:left-4 md:left-6 bg-white/90 hover:bg-white text-slate-800 rounded-full px-4 py-2 shadow-xl transition-all z-10 flex items-center gap-2 font-semibold text-sm backdrop-blur-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
          </button>
          <button @click="closeModal" class="absolute top-3 sm:top-4 md:top-6 right-3 sm:right-4 md:right-6 bg-white hover:bg-slate-100 text-slate-900 rounded-full p-2 sm:p-3 shadow-xl transition-all z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 sm:h-6 w-5 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
          </button>
          
          <!-- Status Badges -->
          <div class="absolute bottom-3 sm:bottom-4 md:bottom-6 left-3 sm:left-4 md:left-6 flex gap-1 sm:gap-2 flex-wrap">
            <span class="bg-blue-600 text-white text-xs uppercase font-bold px-3 sm:px-4 py-1.5 sm:py-2 rounded-full">{{ selectedProperty.status }}</span>
            <span v-if="selectedProperty.isNew" class="flex items-center gap-1 bg-emerald-500 text-white text-xs uppercase font-bold px-3 sm:px-4 py-1.5 sm:py-2 rounded-full shadow-lg">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-amber-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
              Proyek Baru
            </span>
          </div>
        </div>

        <!-- Modal Body -->
        <div class="p-4 sm:p-6 md:p-8 lg:p-12">
          <!-- Title & Price -->
          <div class="mb-6 sm:mb-8 pb-6 sm:pb-8 border-b border-slate-200">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black text-slate-900 mb-3 sm:mb-4 leading-tight">{{ selectedProperty.title }}</h2>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 sm:gap-6">
              <div>
                <p class="text-blue-600 text-2xl sm:text-3xl md:text-4xl font-black">{{ selectedProperty.price }}</p>
                <p class="text-slate-500 font-medium mt-1.5 sm:mt-2 flex items-center gap-2 text-sm sm:text-base">
                  <svg class="h-4 sm:h-5 w-4 sm:w-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                  </svg>
                  {{ selectedProperty.location }}
                </p>
              </div>
              <div class="flex gap-2 sm:gap-3 w-full md:w-auto">
                <button class="flex-1 md:flex-none px-3 sm:px-6 py-2 sm:py-3 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg font-bold transition-colors flex items-center justify-center gap-2 text-xs sm:text-sm md:text-base">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                  <span class="hidden sm:inline">Simpan</span>
                </button>
                <button class="flex-1 md:flex-none px-3 sm:px-6 py-2 sm:py-3 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg font-bold transition-colors flex items-center justify-center gap-2 text-xs sm:text-sm md:text-base">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" style="opacity: 0.3;"/><path d="M16 11h-3V8h-2v3h-3v2h3v3h2v-3h3z"/></svg>
                  <span class="hidden sm:inline">Bagikan</span>
                </button>
              </div>
            </div>
          </div>

          <!-- Main Content -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 mb-6 sm:mb-8">
            
            <!-- Left: Details -->
            <div class="lg:col-span-2 space-y-6 sm:space-y-8">
              
              <!-- Property Specs -->
              <div>
                <h3 class="flex items-center gap-2 text-lg sm:text-xl md:text-2xl font-black text-slate-900 mb-4 sm:mb-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                  Spesifikasi Properti
                </h3>
                <div class="grid grid-cols-3 gap-2 sm:gap-4 bg-slate-50 p-4 sm:p-6 rounded-xl sm:rounded-2xl border border-slate-200">
                  <div class="text-center">
                    <div class="text-slate-500 text-xs sm:text-sm font-bold mb-2">KAMAR TIDUR</div>
                    <div class="text-2xl sm:text-3xl font-black text-slate-900">{{ selectedProperty.beds }}</div>
                    <div class="text-xs text-slate-500 mt-1">Kamar</div>
                  </div>
                  <div class="w-px bg-slate-300"></div>
                  <div class="text-center">
                    <div class="text-slate-500 text-xs sm:text-sm font-bold mb-2">KAMAR MANDI</div>
                    <div class="text-2xl sm:text-3xl font-black text-slate-900">{{ selectedProperty.baths }}</div>
                    <div class="text-xs text-slate-500 mt-1">Kamar</div>
                  </div>
                  <div class="col-span-3 w-px bg-slate-300"></div>
                  <div class="col-span-3 text-center">
                    <div class="text-slate-500 text-xs sm:text-sm font-bold mb-2">LUAS BANGUNAN</div>
                    <div class="text-2xl sm:text-3xl font-black text-slate-900">{{ selectedProperty.area }} m²</div>
                    <div class="text-xs text-slate-500 mt-1">Meter Persegi</div>
                  </div>
                </div>
              </div>

              <!-- Description -->
              <div>
                <h3 class="flex items-center gap-2 text-lg sm:text-xl md:text-2xl font-black text-slate-900 mb-3 sm:mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                  Deskripsi Properti
                </h3>
                <p class="text-slate-700 font-light leading-relaxed text-sm sm:text-base md:text-lg">
                  {{ selectedProperty.description }}
                </p>
              </div>

              <!-- Amenities -->
              <div>
                <h3 class="flex items-center gap-2 text-lg sm:text-xl md:text-2xl font-black text-slate-900 mb-3 sm:mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                  Fasilitas & Amenitas
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 sm:gap-3 md:gap-4">
                  <div class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 bg-blue-50 rounded-lg text-xs sm:text-sm hover:bg-blue-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    <span class="font-medium text-slate-700">Kolam Renang</span>
                  </div>
                  <div class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 bg-blue-50 rounded-lg text-xs sm:text-sm hover:bg-blue-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                    <span class="font-medium text-slate-700">Gym Center</span>
                  </div>
                  <div class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 bg-blue-50 rounded-lg text-xs sm:text-sm hover:bg-blue-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                    <span class="font-medium text-slate-700">Parkir Luas</span>
                  </div>
                  <div class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 bg-blue-50 rounded-lg text-xs sm:text-sm hover:bg-blue-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span class="font-medium text-slate-700">Keamanan 24/7</span>
                  </div>
                  <div class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 bg-blue-50 rounded-lg text-xs sm:text-sm hover:bg-blue-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    <span class="font-medium text-slate-700">Taman Luas</span>
                  </div>
                  <div class="flex items-center gap-2 sm:gap-3 p-3 sm:p-4 bg-blue-50 rounded-lg text-xs sm:text-sm hover:bg-blue-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-medium text-slate-700">Playground</span>
                  </div>
                </div>
              </div>

            </div>

            <!-- Right: CTA & Agent -->
            <div class="lg:col-span-1">
              <!-- Agent Card -->
              <div class="sticky top-4 sm:top-6 lg:top-8 bg-white border-2 border-slate-200 rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 shadow-xl">
                <h3 class="flex items-center gap-2 font-black text-base sm:text-lg text-slate-900 mb-4 sm:mb-6">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                  Agen Properti
                </h3>
                
                <div class="flex flex-col items-center mb-4 sm:mb-6">
                  <img src="https://i.pravatar.cc/150?img=12" alt="Agen" class="w-20 sm:w-24 h-20 sm:h-24 rounded-full border-4 border-blue-200 mb-3 sm:mb-4">
                  <h4 class="font-bold text-base sm:text-lg text-slate-900">Dedi Hermawan</h4>
                  <p class="text-xs sm:text-sm text-blue-600 font-semibold">Agen Berpengalaman 10 Tahun</p>
                </div>

                <div class="space-y-2 mb-4 sm:mb-6 pb-4 sm:pb-6 border-b border-slate-200">
                  <div class="flex items-center gap-2 text-slate-700 text-xs sm:text-sm">
                    <div class="flex text-amber-400">
                      <svg v-for="i in 5" :key="i" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <span class="font-medium">4.9/5 (500+ review)</span>
                  </div>
                  <p class="text-xs sm:text-sm text-slate-600">Responsif, profesional, dan terpercaya</p>
                </div>

                <!-- CTA Buttons -->
                <div class="space-y-2 sm:space-y-3">
                  <button class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-2.5 sm:py-4 px-3 sm:px-4 rounded-lg sm:rounded-xl transition-all shadow-lg shadow-green-500/30 flex items-center justify-center gap-2 text-xs sm:text-sm md:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                    <span class="hidden sm:inline">Hubungi via WhatsApp</span>
                    <span class="sm:hidden">WhatsApp</span>
                  </button>
                  <button class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-2.5 sm:py-4 px-3 sm:px-4 rounded-lg sm:rounded-xl transition-all flex items-center justify-center gap-2 text-xs sm:text-sm md:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span class="hidden sm:inline">+62 812 345 6789</span>
                    <span class="sm:hidden">Telepon</span>
                  </button>
                  <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 sm:py-4 px-3 sm:px-4 rounded-lg sm:rounded-xl transition-all flex items-center justify-center gap-2 text-xs sm:text-sm md:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 sm:h-5 w-4 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="hidden sm:inline">Kirim Email</span>
                    <span class="sm:hidden">Email</span>
                  </button>
                </div>

                <!-- Info Box -->
                <div class="mt-4 sm:mt-6 pt-4 sm:pt-6 border-t border-slate-200 text-xs sm:text-sm text-slate-600 font-light">
                  <p class="flex items-start gap-2 mb-1 sm:mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <span><strong>Gratis konsultasi</strong> tentang pembiayaan KPR dan proses jual-beli.</span>
                  </p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import ClusterProgress from './components/ClusterProgress.vue'

const isScrolled = ref(false)
const isDark = ref(false)
const activeTab = ref('Beli')
const selectedProperty = ref(null)
const activeFaq = ref(null)
const showCluster = ref(false)

// Dark mode toggle
const toggleDarkMode = () => {
  isDark.value = !isDark.value
  localStorage.setItem('rumah-dark-mode', isDark.value.toString())
}

// Load dark mode preference from localStorage
onMounted(() => {
  const savedDarkMode = localStorage.getItem('rumah-dark-mode')
  if (savedDarkMode !== null) {
    isDark.value = savedDarkMode === 'true'
  } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    isDark.value = true
  }
  
  // Rest of onMounted...
})

const heroImage = '/image/desain-rumah-kecil-sederhana-kontemporer.jpg'

// FAQ Data
const faqs = ref([
  {
    question: 'Bagaimana cara membeli properti di RumahImpian.id?',
    answer: 'Proses pembelian sangat mudah! Cari properti yang Anda inginkan, hubungi agen kami, dan kami akan membimbing Anda melalui setiap tahap mulai dari negosiasi harga, verifikasi dokumen, hingga penandatanganan akta jual-beli. Kami juga menyediakan bantuan pembiayaan KPR dari berbagai bank terkemuka.'
  },
  {
    question: 'Apakah semua properti sudah terverifikasi?',
    answer: 'Ya, 100% properti yang kami tampilkan telah melalui proses verifikasi ketat. Kami memastikan setiap properti memiliki legalitas yang jelas baik dari segi sertifikat tanah, izin bangunan, maupun status kepemilikan. Keamanan investasi Anda adalah prioritas utama kami.'
  },
  {
    question: 'Berapa lama proses KPR biasanya?',
    answer: 'Proses KPR melalui RumahImpian.id berlangsung cepat, biasanya 5-10 hari kerja saja. Tim kami yang berpengalaman akan mengurus segala dokumen dan berkoordinasi langsung dengan pihak bank. Kami bekerja sama dengan 20+ bank terkemuka untuk memberikan solusi pembiayaan terbaik.'
  },
  {
    question: 'Apa saja biaya tersembunyi yang mungkin ada?',
    answer: 'Di RumahImpian.id, tidak ada biaya tersembunyi! Semua biaya dijelaskan dengan transparan sejak awal termasuk harga properti, biaya administrasi, biaya notaris, dan biaya lainnya. Anda akan mendapatkan penawaran harga langsung dari developer atau pemilik properti.'
  },
  {
    question: 'Bagaimana jika saya ingin menjual properti saya?',
    answer: 'Sangat mudah! Cukup daftarkan properti Anda melalui platform kami. Tim kami akan membantu dengan strategi pemasaran, fotografi profesional, dan negosiasi dengan calon pembeli. Kami menawarkan solusi end-to-end untuk penjualan properti yang sukses.'
  },
  {
    question: 'Apakah ada garansi atau perlindungan pembeli?',
    answer: 'Tentu! Semua transaksi melalui RumahImpian.id dilindungi dengan perjanjian jual-beli yang sah secara hukum. Kami juga menyediakan garansi uang kembali jika dokumentasi properti bermasalah selama proses due diligence.'
  }
])

// Enhanced Property Data with More Entries
const featuredProperties = ref([
  {
    title: 'Cluster Minimalis Kontemporer Premium',
    location: 'Bintaro, Tangerang Selatan',
    price: 'Rp 1.250.000.000',
    status: 'Dijual',
    beds: 3,
    baths: 2,
    area: 90,
    isNew: true,
    image: '/image/desain-rumah-kecil-sederhana-kontemporer.jpg',
    description: 'Rumah cluster cantik di kawasan premium Bintaro dengan sistem keamanan 24 jam. Desain kontemporer dengan sirkulasi udara optimal dan pencahayaan alami yang melimpah. Sangat dekat dengan stasiun KRL, tol, dan pusat perbelanjaan ternama. Ideal untuk keluarga modern yang menginginkan gaya hidup berkualitas di lokasi strategis.'
  },
  {
    title: 'Rumah Skandinavian Asri',
    location: 'Kota Baru Parahyangan, Bandung',
    price: 'Rp 950.000.000',
    status: 'Dijual',
    beds: 2,
    baths: 1,
    area: 72,
    isNew: false,
    image: '/image/gambar-rumah-sederhana-kecil-skandinavian.jpg',
    description: 'Menikmati udara segar pegunungan dari halaman belakang rumah Anda sendiri. Desain skandinavian yang cozy dilengkapi lantai kayu vinyl berkualitas dan ceiling tinggi membuatnya terasa sangat luas. Lokasi tenang dengan tetangga yang ramah dan akses ke berbagai fasilitas umum.'
  },
  {
    title: 'Hunian Modern Industrial',
    location: 'Canggu, Bali',
    price: 'Rp 85.000.000 / thn',
    status: 'Disewa',
    beds: 3,
    baths: 3,
    area: 120,
    isNew: false,
    image: '/image/gambar-rumah-sederhana-kecil-desain-industrial.jpg',
    description: 'Villa bergaya industrial yang aesthetic. Cocok untuk digital nomad atau keluarga ekspatriat. Memiliki kolam renang pribadi kecil, dinding ekspos batu bata, dan jendela kaca lebar menghadap persawahan. Lokasi strategis di area yang berkembang dengan berbagai amenitas pendukung.'
  },
  {
    title: 'Rumah Mungil Atap Miring Eksklusif',
    location: 'Depok, Jawa Barat',
    price: 'Rp 650.000.000',
    status: 'Dijual',
    beds: 2,
    baths: 1,
    area: 60,
    isNew: true,
    image: '/image/desain-rumah-kecil-atap-miring.jpg',
    description: 'Solusi cerdas hunian modern bagi milenial. Fasad atap miring unik yang sedang trend dengan interior minimalis fungsional. Lokasi bebas banjir dan sangat strategis, hanya 10 menit dari kawasan kampus UI dan pusat perbelanjaan.'
  },
  {
    title: 'Boutique Minimalis House near CBD',
    location: 'BSD City, Tangerang',
    price: 'Rp 1.100.000.000',
    status: 'Dijual',
    beds: 3,
    baths: 2,
    area: 85,
    isNew: true,
    image: '/image/gambar-rumah-sederhana-kecil-modern-minimalis.jpg',
    description: 'Hunian eksklusif 2 lantai di jantung BSD City. Dilengkapi dengan smart home system lengkap, solar water heater, dan material bangunan berstandar internasional. Lokasi premium dekat dengan stasiun, mall, dan berbagai fasilitas bisnis.'
  },
  {
    title: 'Rumah Keluarga Sederhana Nyaman',
    location: 'Bekasi Barat, Jawa Barat',
    price: 'Rp 450.000.000',
    status: 'Dijual',
    beds: 2,
    baths: 1,
    area: 50,
    isNew: false,
    image: '/image/rumah-kecil-sederhana-minimalis.jpg',
    description: 'Pilihan tepat untuk keluarga muda atau pasangan baru. Lingkungan yang sudah terbentuk, ramah anak, dan terdapat fasilitas taman bermain dalam kompleks. Legalitas SHM sudah pecah, sertifikat lengkap dan aman untuk investasi.'
  },
  {
    title: 'Townhouse Modern Bintaro',
    location: 'Bintaro Jaya, Tangerang',
    price: 'Rp 1.850.000.000',
    status: 'Dijual',
    beds: 4,
    baths: 3,
    area: 125,
    isNew: true,
    image: '/image/rumah-kecil-sederhana-e1723023921680.jpg',
    description: 'Properti idaman berukuran luas dengan layout optimal. Master bedroom luas, ruang tamu berkonsep open space, lengkap dengan dapur kotor dan dapur bersih. Free AC di setiap kamar khusus promo bulan ini. Lokasi super strategis dengan akses mudah ke berbagai tempat.'
  },
  {
    title: 'Apartemen Mewah Jakarta Selatan',
    location: 'Kemang, Jakarta Selatan',
    price: 'Rp 2.500.000.000',
    status: 'Dijual',
    beds: 3,
    baths: 2,
    area: 145,
    isNew: true,
    image: '/image/desain-rumah-kecil-sederhana-kontemporer.jpg',
    description: 'Unit apartemen premium dengan pemandangan kota yang menakjubkan. Furnished mewah dengan smart home technology, gym, spa, dan berbagai fasilitas eksklusif. Lokasi prestisius di kawasan bisnis dan lifestyle terbaik Jakarta.'
  }
])

// Functions
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

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>
