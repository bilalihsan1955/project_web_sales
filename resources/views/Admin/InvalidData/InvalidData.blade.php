@extends('Admin.InvalidData.Layouts.Header')

@section('title', 'Invalid Customer')

@section('content')


    <!-- Content Area -->
    <main class="px-4 sm:px-6 pt-4 md:pt-6 max-w-full">

        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Invalid Data</h2>
            <div>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                            href="{{ route('admin.dashboard') }}">
                            Home
                            <span class="material-symbols-outlined text-base">chevron_right</span>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">Invalid Data</li>
                </ol>
            </div>
        </div>

        <!-- SumberData Table -->
        <div class="bg-white rounded-lg shadow dark:bg-gray-800 overflow-hidden mb-6 dark:text-gray-50">
            <div class="p-4 sm:p-6 border-gray-200 dark:border-gray-600">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Data Invalid Customers</h3>

                    <!-- Search and Filter Row -->
                    <div class="w-full md:w-auto flex flex-col md:flex-row gap-3 items-stretch">
                        <!-- Upload Excel Button -->
                        <button onclick="openModal()"
                            class="flex items-center justify-center bg-green-500 text-white py-2 px-4 rounded-lg text-sm">
                            <span class="material-symbols-outlined text-2xl mr-2">arrow_circle_up</span>
                            Upload Excel
                        </button>

                        <!-- Add Button -->
                        <button onclick="openModalAddData()"
                            class="flex items-center justify-center bg-blue-500 text-white py-2 px-4 rounded-lg text-sm">
                            <span class="material-symbols-outlined text-2xl mr-2">add_circle_outline</span>
                            Tambah Data
                        </button>
                    </div>
                </div>

                <!-- Search and Filter Row with flex-wrap -->
                <div class="w-full md:w-auto flex flex-col md:flex-row gap-3 items-stretch mt-4 flex-wrap">
                    <!-- Search Input -->
                    <div class="relative flex-grow min-w-[200px] flex-1">
                        <input type="text" id="SumberDataSearch" placeholder="Search..."
                            class="min-w-full pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div class="absolute left-3 top-2.5 text-gray-400 dark:text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Filter Button -->
                    <button id="toggleFiltersBtn"
                        class="flex items-center justify-center border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800  py-1 px-4 rounded-lg text-sm max-h-full">
                        <span class="material-symbols-outlined text-lg">filter_alt</span> Filters
                    </button>
                </div>

                <!-- Advanced Filters (Toggling Visibility on Mobile) -->
                <div id="filterContainer" class="mt-4 grid sm:grid-cols-4 gap-3 hidden">
                    <div class="relative filter-container">
                        <label for="branchFilter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Branch</label>
                        <select id="branchFilter"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Branches</option>
                            <option value="Cabang A">Cabang A</option>
                            <option value="Cabang B">Cabang B</option>
                            <option value="Cabang C">Cabang C</option>
                            <option value="Cabang D">Cabang D</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                            style="top: 24px;">
                            <span
                                class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                        </div>
                    </div>

                    <div class="relative filter-container">
                        <label for="cityFilter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                        <select id="cityFilter"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Cities</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Surabaya">Surabaya</option>
                            <option value="Medan">Medan</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                            style="top: 24px;">
                            <span
                                class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                        </div>
                    </div>

                    <div class="relative filter-container">
                        <label for="JenisPelangganFilter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis
                            Pelanggan</label>
                        <select id="JenisPelangganFilter"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Jenis Pelanggan</option>
                            <option value="Retail">Retail</option>
                            <option value="Fleet">Fleet</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                            style="top: 24px;">
                            <span
                                class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                        </div>
                    </div>

                    <!-- Items Per Page -->
                    <div class="relative filter-container">
                        <label for="itemsPerPage"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Show</label>
                        <select id="itemsPerPage"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="5">5 items</option>
                            <option value="10" selected>10 items</option>
                            <option value="20">20 items</option>
                            <option value="50">50 items</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                            style="top: 24px;">
                            <span
                                class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto px-4 sm:px-6">
                <!-- Wrapper with maximum width and overflow scroll for mobile display -->
                <div class="w-full max-w-full overflow-x-auto">
                    <table id="InavlidTable" class="w-full text-sm border border-collapse rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th id="col-no"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    No</th>
                                <th id="col-cabang"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Cabang</th>
                                <th id="col-nama"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Nama</th>
                                <th id="col-kota"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Kota</th>
                                <th id="col-NoHp1"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Tgl Lahir</th>
                                <th id="col-NoHp2"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    NoHp2</th>
                                <th id="col-SumberData"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Sumber Data</th>
                                <th id="col-ModelKendaraan"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Model Kendaraan</th>
                                <th id="col-JenisPelanggan"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Jenis Pelanggan</th>
                                <th id="col-aksi"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="InavlidTableBody">
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    086234825325</td> <!-- NoHp1 -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    340324293740</td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kijang
                                    Innova</td>

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fleet
                                </td>

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <!-- Kolom 1: No -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <!-- No -->

                                <!-- Kolom 2: Cabang -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td> <!-- Cabang -->

                                <!-- Kolom 3: Nama -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ali Hasan
                                </td> <!-- Nama -->

                                <!-- Kolom 4: Kota -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td> <!-- Kota -->

                                <!-- Kolom 5: Tgl Lahir -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    087234567890</td> <!-- Tgl Lahir -->

                                <!-- Kolom 6: Jenis NoHp2 -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">09123456789
                                </td> <!-- NoHp2 -->

                                <!-- Kolom 7: Sumber Data -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td> <!-- Sumber Data -->

                                <!-- Kolom 8: Model Kendaraan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Honda CRV
                                </td> <!-- Model Kendaraan -->

                                <!-- Kolom 9: Jenis Pelanggan -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Retail
                                </td> <!-- Jenis Pelanggan -->

                                <!-- Kolom 10: Aksi -->
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <!-- Tombol Info -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>

                                        <!-- Tombol Delete -->
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div
                class="px-4 sm:px-6 py-6 border-gray-200 dark:border-gray-600 flex flex-col sm:flex-row justify-between items-center gap-3">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Showing <span id="showingFrom">1</span> to <span id="showingTo">10</span> of <span
                        id="totalItems">0</span> entries
                </div>
                <!-- Pagination -->
                <div
                    class="p-0 border-gray-200 dark:border-gray-600 flex flex-col sm:flex-row justify-between items-center gap-3 w-full sm:w-auto">

                    <!-- Pagination controls -->
                    <div class="flex flex-col sm:flex-row sm:gap-3 gap-2 md:gap-0 w-full sm:justify-end sm:space-x-3 mt-3">
                        <!-- Previous button (Mobile: on top, full width) -->
                        <button id="prevPage" disabled
                            class="w-full sm:w-auto px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 disabled:opacity-50">
                            Previous
                        </button>

                        <!-- Page Numbers -->
                        <div id="pageNumbers" class="flex gap-1 w-full justify-center sm:justify-start">
                            <!-- Page numbers will be inserted here -->
                        </div>

                        <!-- Next button (Mobile: on bottom, full width) -->
                        <button id="nextPage" disabled
                            class="w-full sm:w-auto px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 disabled:opacity-50">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
@endsection