@extends('Admin.BigData.Layouts.Header')

@section('title', 'Big Data')

@section('content')


    <!-- Content Area -->
    <main class="px-4 sm:px-6 pt-4 md:pt-6 max-w-full">

        <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">Big Data</h2>
            <div>
                <ol class="flex items-center gap-1.5">
                    <li>
                        <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                            href="{{ route('admin.dashboard') }}">
                            Home
                            <span class="material-symbols-outlined text-base">chevron_right</span>
                        </a>
                    </li>
                    <li class="text-sm text-gray-800 dark:text-white/90">Big Data</li>
                </ol>
            </div>
        </div>

        <!-- customer Table -->
        <div class="bg-white rounded-lg shadow dark:bg-gray-800 overflow-hidden mb-6 dark:text-gray-50">
            <div class="p-4 sm:p-6 border-gray-200 dark:border-gray-600">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Data Customer</h3>

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
                        <input type="text" id="customerSearch" placeholder="Search..."
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
                        <label for="progressFilter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Progress</label>
                        <select id="progressFilter"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Status</option>
                            <option value="SPK">SPK</option>
                            <option value="Pending">Pending</option>
                            <option value="Reject">Reject</option>
                            <option value="DO">DO</option>
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
                    <table id="customerTable" class="w-full text-sm border border-collapse rounded-lg overflow-hidden">
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
                                <th id="col-tgllahir"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Tgl Lahir</th>
                                <th id="col-kendaraan"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Jenis Kendaraan</th>
                                <th id="col-customer"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Customer</th>
                                <th id="col-progress"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Progress</th>
                                <th id="col-keterangan"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Keterangan</th>
                                <th id="col-aksi"
                                    class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="customerTableBody">
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1990-05-15
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Aji
                                    Prasetya</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">On Track
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Budi
                                    Santoso</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bandung
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1988-11-22
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Mobil</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">Pending</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Waiting
                                    Approval</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">3</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang C
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ani Wijaya
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Surabaya
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1992-03-10
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Fajri Tri
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Reject</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Document
                                    Incomplete</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr
                                class="bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">4</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Dewi
                                    Lestari</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jakarta
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1991-07-18
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Mobil</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Sarah</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">DO</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Delivery
                                    Order</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        <button
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Eko
                                    Prasetyo</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Medan</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1989-09-05
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Motor</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Bilal</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">SPK</span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Completed
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <button onclick="openTampilData()"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
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

        <!-- Modal Upload File -->
        <div id="uploadFileModal"
            class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden">
            <!-- Modal Background with Blur effect -->
            <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm" onclick="closeModal()">
            </div>
            <div class="relative bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-lg">


                <!-- Close Button (X) using Google Material Icon -->
                <button type="button" onclick="closeModal()"
                    class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                    <span class="material-symbols-outlined">close</span> <!-- Material icon for X -->
                </button>

                <!-- Modal Header with Title -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Upload Your Excel
                        File</h3>
                </div>

                <!-- Custom File Input (Flowbite Style) -->
                <div class="mb-2">
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 sm:h-72 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class=" p-2 flex flex-col items-center justify-center pt-5 pb-6">
                                <span id="fileIcon"
                                    class="material-symbols-outlined mb-4 text-7xl text-gray-500 dark:text-gray-400">
                                    cloud_upload
                                </span>
                                <p id="fileUploadText"
                                    class="mb-2 text-sm sm:text-base text-gray-500 dark:text-gray-400 text-center">
                                    <span class="font-semibold" id="fileNameText">Click to upload</span> or drag
                                    and drop
                                </p>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 text-center">Only
                                    Excel files
                                    are allowed (xlsx, xls, csv)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>

                    <!-- Error Message Display -->
                    <div id="fileError" class="mt-4 text-red-600 dark:text-red-400 text-sm sm:text-base text-center hidden">
                        Invalid file format. Please upload a valid Excel file.
                    </div>

                </div>

                <!-- Modal Footer with Full-width Upload Button -->
                <div class="flex gap-2 mt-4">
                    <button type="button" onclick="closeModal()"
                        class="w-full px-4 py-2 text-sm sm:text-base bg-gray-500 text-white rounded-md">Cancel</button>
                    <button id="uploadButton" type="button" onclick="uploadFile()"
                        class="w-full px-4 py-2 text-sm sm:text-base bg-blue-500 text-white rounded-md">Upload</button>
                </div>
            </div>
        </div>

        <!-- Modal Container -->
        <div id="addDataModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden">
            <!-- Modal Background with Blur effect -->
            <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm" onclick="closeModalAddData()">
            </div>

            <!-- Modal Content -->
            <div
                class="relative bg-white dark:bg-gray-800 rounded-lg p-4 md:p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-full z-10 max-h-screen overflow-y-auto w-full">
                <!-- Close Button (X) -->
                <button type="button" onclick="closeModalAddData()"
                    class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                    <span class="material-symbols-outlined">close</span> <!-- Material icon for X -->
                </button>

                <!-- Modal Header with Title -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Tambah Data</h3>
                </div>

                <!-- Form Input Fields -->
                <form id="addDataForm" class="space-y-4">
                    <!-- Use grid layout for better organization -->
                    <div class="flex flex-col gap-4 md:grid md:grid-cols-2 lg:grid-cols-4">
                        <!-- Progress (Dropdown) -->
                        <div class="mb-2">
                            <label for="progress"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Progress</label>
                            <select id="progress" name="progress"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Progress</option>
                                <option value="pending">DO</option>
                                <option value="in_progress">SPK</option>
                                <option value="completed">Pending</option>
                                <option value="completed">Reject</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="alasan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alasan</label>
                            <input type="text" id="alasan" name="alasan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Alasan">
                        </div>
                        <!-- cabang -->
                        <div class="mb-2" x-data="dropdownCabang()">
                            <label for="cabang"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cabang</label>
                            <div class="relative">
                                <input type="text" x-model="search" placeholder="Cari Cabang..."
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500"
                                    @focus="open = true" @click.away="open = false">
                                <ul x-show="open"
                                    class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none">
                                    <template x-if="filteredOptions().length">
                                        <template x-for="option in filteredOptions()" :key="option">
                                            <li @click="selectOption(option)"
                                                class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-indigo-600 hover:text-white">
                                                <span x-text="option"></span>
                                            </li>
                                        </template>
                                    </template>
                                    <template x-if="!filteredOptions().length">
                                        <li
                                            class="text-gray-500 dark:text-gray-400 cursor-default select-none relative py-2 pl-3 pr-9">
                                            Tidak ditemukan
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="salesman"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salesman</label>
                            <input type="text" id="salesman" name="salesman"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Salesman">
                        </div>
                        <div class="mb-2">
                            <label for="sumber_data"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sumber
                                Data</label>
                            <input type="text" id="sumber_data" name="sumber_data"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Sumber Data">
                        </div>
                        <div class="mb-2">
                            <label for="nama"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                            <input type="text" id="nama" name="nama"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Nama">
                        </div>
                        <div class="mb-2">
                            <label for="alamat"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                            <input type="text" id="alamat" name="alamat"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Alamat">
                        </div>
                        <div class="mb-2">
                            <label for="kelurahan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelurahan</label>
                            <input type="text" id="kelurahan" name="kelurahan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Kelurahan">
                        </div>
                        <div class="mb-2">
                            <label for="kecamatan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kecamatan</label>
                            <input type="text" id="kecamatan" name="kecamatan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Kecamatan">
                        </div>
                        <div class="mb-2">
                            <label for="kota"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kota</label>
                            <input type="text" id="kota" name="kota"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Kota">
                        </div>
                        <div class="mb-2">
                            <label for="tgl_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl
                                Lahir</label>
                            <input type="date" id="tgl_lahir" name="tgl_lahir"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Tgl Lahir">
                        </div>
                        <!-- Gender (Dropdown) -->
                        <div class="mb-2">
                            <label for="gender"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                            <select id="gender" name="gender"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Gender</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="tipe_pelanggan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe
                                Pelanggan</label>
                            <input type="text" id="tipe_pelanggan" name="tipe_pelanggan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Tipe Pelanggan">
                        </div>
                        <div class="mb-2">
                            <label for="jenis_pelanggan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                Pelanggan</label>
                            <input type="text" id="jenis_pelanggan" name="jenis_pelanggan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Jenis Pelanggan">
                        </div>
                        <div class="mb-2">
                            <label for="tenor"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tenor</label>
                            <input type="text" id="tenor" name="tenor"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Tenor">
                        </div>
                        <div class="mb-2">
                            <label for="tgl_gatepass" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl
                                Gatepass</label>
                            <input type="date" id="tgl_gatepass" name="tgl_gatepass"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Tgl Gatepass">
                        </div>
                        <div class="mb-2">
                            <label for="jenis_kendaraan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                Kendaraan</label>
                            <input type="text" id="jenis_kendaraan" name="jenis_kendaraan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Jenis Kendaraan">
                        </div>
                        <div class="mb-2">
                            <label for="no_rangka" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No
                                Rangka</label>
                            <input type="text" id="no_rangka" name="no_rangka"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="No Rangka">
                        </div>
                        <div class="mb-2">
                            <label for="no_telpon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                                Telpon</label>
                            <input type="number" id="no_telpon" name="no_telpon"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="No. Telpon">
                        </div>
                        <div class="mb-2">
                            <label for="no_telepon_update"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. Telepon
                                Update</label>
                            <input type="number" id="no_telepon_update" name="no_telepon_update"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="No. Telepon Update">
                        </div>

                    </div>
                    <!-- Submit Button -->
                    <div class="mb-2 col-span-2 sm:col-span-4">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Container -->
        <div id="TampilDataModal"
            class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden">
            <!-- Modal Background with Blur effect -->
            <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm" onclick="closeTampilData()">
            </div>

            <!-- Modal Content -->
            <div
                class="relative bg-white dark:bg-gray-800 rounded-lg p-4 md:p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-full z-10 max-h-screen overflow-y-auto w-full">
                <!-- Close Button (X) -->
                <button type="button" onclick="closeTampilData()"
                    class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                    <span class="material-symbols-outlined">close</span> <!-- Material icon for X -->
                </button>

                <!-- Modal Header with Title -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Tambah Data</h3>
                </div>

                <!-- Form Input Fields -->
                <form id="addDataForm" class="space-y-4">
                    <!-- Use grid layout for better organization -->
                    <div class="flex flex-col gap-6 md:grid md:grid-cols-2 lg:grid-cols-4">
                        <!-- Progress -->
                        <div class="mb-4">
                            <label for="progress"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Progress</label>
                            <input disabled type="text" id="progress" name="progress"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="progress">
                        </div>
                        <div class="mb-4">
                            <label for="alasan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alasan</label>
                            <input disabled type="text" id="alasan" name="alasan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Alasan">
                        </div>
                        <!-- cabang -->
                        <div class="mb-4">
                            <label for="cabang"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cabang</label>
                            <input disabled type="text" id="cabang" name="cabang"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Salesman">
                        </div>
                        <div class="mb-4">
                            <label for="salesman"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salesman</label>
                            <input disabled type="text" id="salesman" name="salesman"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Salesman">
                        </div>
                        <div class="mb-4">
                            <label for="sumber_data"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sumber
                                Data</label>
                            <input disabled type="text" id="sumber_data" name="sumber_data"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Sumber Data">
                        </div>
                        <div class="mb-4">
                            <label for="nama"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                            <input disabled type="text" id="nama" name="nama"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Nama">
                        </div>
                        <div class="mb-4">
                            <label for="alamat"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                            <input disabled type="text" id="alamat" name="alamat"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Alamat">
                        </div>
                        <div class="mb-4">
                            <label for="kelurahan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelurahan</label>
                            <input disabled type="text" id="kelurahan" name="kelurahan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Kelurahan">
                        </div>
                        <div class="mb-4">
                            <label for="kecamatan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kecamatan</label>
                            <input disabled type="text" id="kecamatan" name="kecamatan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Kecamatan">
                        </div>
                        <div class="mb-4">
                            <label for="kota"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kota</label>
                            <input disabled type="text" id="kota" name="kota"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Kota">
                        </div>
                        <div class="mb-4">
                            <label for="tgl_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl
                                Lahir</label>
                            <input disabled type="date" id="tgl_lahir" name="tgl_lahir"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Tgl Lahir">
                        </div>
                        <!-- Gender (Dropdown) -->
                        <div class="mb-4">
                            <label for="gender"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                            <input disabled type="text" id="gender" name="gender"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Tipe Pelanggan">
                        </div>
                        <div class="mb-4">
                            <label for="tipe_pelanggan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe
                                Pelanggan</label>
                            <input disabled type="text" id="tipe_pelanggan" name="tipe_pelanggan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Tipe Pelanggan">
                        </div>
                        <div class="mb-4">
                            <label for="jenis_pelanggan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                Pelanggan</label>
                            <input disabled type="text" id="jenis_pelanggan" name="jenis_pelanggan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Jenis Pelanggan">
                        </div>
                        <div class="mb-4">
                            <label for="tenor"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tenor</label>
                            <input disabled type="text" id="tenor" name="tenor"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Tenor">
                        </div>
                        <div class="mb-4">
                            <label for="tgl_gatepass" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tgl
                                Gatepass</label>
                            <input disabled type="date" id="tgl_gatepass" name="tgl_gatepass"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Tgl Gatepass">
                        </div>
                        <div class="mb-4">
                            <label for="jenis_kendaraan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                Kendaraan</label>
                            <input disabled type="text" id="jenis_kendaraan" name="jenis_kendaraan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="Jenis Kendaraan">
                        </div>
                        <div class="mb-4">
                            <label for="no_rangka" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No
                                Rangka</label>
                            <input disabled type="text" id="no_rangka" name="no_rangka"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="No Rangka">
                        </div>
                        <div class="mb-4">
                            <label for="no_telpon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">No.
                                Telpon</label>
                            <input disabled type="number" id="no_telpon" name="no_telpon"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="No. Telpon">
                        </div>
                        <div class="mb-4">
                            <label for="no_telepon_update"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">No. Telepon
                                Update</label>
                            <input disabled type="number" id="no_telepon_update" name="no_telepon_update"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="No. Telepon Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection