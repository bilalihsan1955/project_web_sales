@extends('Kacab.Usermanagement.Layouts.Header')

@section('title', 'Laporan Salesman')

@section('content')


            <!-- Content Area -->
            <main class="px-4 sm:px-6 pt-4 md:pt-6 max-w-full">

                <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90">User Management</h2>
                    <div>
                        <ol class="flex items-center gap-1.5">
                            <li>
                                <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                    href="{{ route('kacab.dashboard') }}">
                                    Home
                                    <span class="material-symbols-outlined text-base">chevron_right</span>
                                </a>
                            </li>
                            <li class="text-sm text-gray-800 dark:text-white/90">User Management</li>
                        </ol>
                    </div>
                </div>

                <!-- SumberData Table -->
                <div class="bg-white rounded-lg shadow dark:bg-gray-800 overflow-hidden mb-6 dark:text-gray-50">
                    <div class="p-4 sm:p-6 border-gray-200 dark:border-gray-600">
                        <div
                            class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 md:gap-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Account Management</h3>

                            <!-- Search and Filter Row -->
                            <div class="w-full md:w-auto flex flex-col md:flex-row gap-3 items-stretch">
                                <!-- Upload Excel Button -->
                                <button onclick="openModal()"
                                    class="flex items-center justify-center bg-green-500 text-white py-2 px-4 rounded-lg text-sm">
                                    <span class="material-symbols-outlined text-2xl mr-2">arrow_circle_up</span>
                                    Upload Excel
                                </button>

                                <!-- Add Button -->
                                <button onclick="openModalAddUser()"
                                    class="flex items-center justify-center bg-blue-500 text-white py-2 px-4 rounded-lg text-sm">
                                    <span class="material-symbols-outlined text-2xl mr-2">add_circle_outline</span>
                                    Tambah User
                                </button>
                            </div>
                        </div>

                        <!-- Search and Filter Row with flex-wrap -->
                        <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3 items-stretch pt-4">
                            <!-- Search Input (larger) -->
                            <div class="relative flex-grow min-w-[200px]">
                                <input type="text" id="salesmanSearch" placeholder="Search..."
                                    class="pl-10 pr-4 py-2 w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="absolute left-3 top-2.5 text-gray-400 dark:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Compact City Dropdown -->
                            <div class="relative w-full md:w-[160px]">
                                <select id="branchFilter"
                                    class="appearance-none w-full h-full pl-3 pr-7 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">All Branches</option>
                                    <option value="Cabang A">Cabang A</option>
                                    <option value="Cabang B">Cabang B</option>
                                    <option value="Cabang C">Cabang C</option>
                                    <option value="Cabang D">Cabang D</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <span
                                        class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                                </div>
                            </div>

                            <!-- Compact City Dropdown -->
                            <div class="relative w-full md:w-[160px]">
                                <select id="RoleFilter"
                                    class="appearance-none w-full h-full pl-3 pr-7 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">All Roles</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Kepala Cabang">Kepala Cabang</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Salesman">Salesman</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <span
                                        class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                                </div>
                            </div>

                            <!-- Compact Items Per Page Dropdown -->
                            <div class="relative w-full md:w-[160px]">
                                <select id="itemsPerPage"
                                    class="appearance-none w-full h-full pl-3 pr-7 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="5">5 items</option>
                                    <option value="10" selected>10 items</option>
                                    <option value="20">20 items</option>
                                    <option value="50">50 items</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <span
                                        class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto px-4 sm:px-6">
                        <!-- Wrapper with maximum width and overflow scroll for mobile display -->
                        <div class="w-full max-w-full overflow-x-auto">
                            <table id="SalesmanProgressTable"
                                class="w-full text-sm border border-collapse rounded-lg overflow-hidden">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th id="col-no"
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                            No</th>
                                        <th id="col-cabang"
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                            Cabang</th>
                                        <th id="col-username"
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                            UserName</th>
                                        <th id="col-Nama"
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                            Nama</th>
                                        <th id="col-password"
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                            Password</th>
                                        <th id="col-Role"
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                            Role</th>
                                        <th id="col-status"
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                            Status</th>
                                        <th id="col-aksi"
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody id="SalesmanProgressTableBody">
                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">1</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang A
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">RestuNur_
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Restu Nur
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="password123">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Admin</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Active</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">2</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang B
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">JohnDoe
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">John Doe
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="admin123">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            Kepala Cabang
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Inactive</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">3</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang C
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Doe123</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jane Doe
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="securePassword">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Supervisor
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Inactive</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">4</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang D
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">SmithJ</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">John Smith
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="smith2023">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Salesman
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Active</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">5</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang E
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">BrownT</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Thomas
                                            Brown</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="brownie456">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            Kepala Cabang
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Active</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">6</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang F
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">WilsonM
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Mary Wilson
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="wilson789">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Admin</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Inactive</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">7</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang G
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">LeeJ</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Jennifer
                                            Lee</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="jlee1234">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Admin</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Active</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">8</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang H
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">TaylorS
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Sarah
                                            Taylor</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="taylorSwift">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Salesman
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Active</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">9</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang I
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">ClarkK</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Kevin Clark
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="clarkKent1">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Supervisor
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">Inactive</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">10</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang J
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">RodriguezL
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Luis
                                            Rodriguez</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="luis9876">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            Kepala Cabang
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Active</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">11</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Cabang K
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">MartinezA
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Ana
                                            Martinez</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center w-full justify-center">
                                                <span
                                                    class="font-monospace tracking-wider flex-grow mr-2 password-display"
                                                    data-password="anaMartinez">●●●●●●</span>
                                                <span class="cursor-pointer toggle-password-visibility">
                                                    <span
                                                        class="material-symbols-outlined text-gray-500">visibility_off</span>
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">Admin</td>
                                        <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">Active</span>
                                        </td>
                                        <td
                                            class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                <button onclick="openModalTampilUser()"
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">info</span>
                                                </button>
                                                <button
                                                    class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-green-50 hover:bg-green-100 dark:bg-green-900/50 dark:hover:bg-green-900 text-green-600 dark:text-green-300 rounded-md border border-green-200 dark:border-green-700 transition-colors">
                                                    <span class="material-symbols-outlined text-sm">edit</span>
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
                            <div
                                class="flex flex-col sm:flex-row sm:gap-3 gap-2 md:gap-0 w-full sm:justify-end sm:space-x-3 mt-3">
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
                    <div
                        class="relative bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-lg">


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
                            <div id="fileError"
                                class="mt-4 text-red-600 dark:text-red-400 text-sm sm:text-base text-center hidden">
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
                <div id="tampilUserModal"
                    class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden  md:px-32">
                    <!-- Modal Background with Blur effect -->
                    <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm"
                        onclick="closeModalTampilUser()">
                    </div>

                    <!-- Modal Content -->
                    <div
                        class="relative bg-white dark:bg-gray-800 rounded-lg p-4 md:p-8 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-full z-10 max-h-screen overflow-y-auto w-full">
                        <!-- Close Button (X) -->
                        <button type="button" onclick="closeModalTampilUser()"
                            class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                            <span class="material-symbols-outlined">close</span> <!-- Material icon for X -->
                        </button>

                        <!-- Modal Header with Title -->
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Tambah Data</h3>
                        </div>

                        <!-- Form Input Fields -->
                        <form id="tampilUserForm" class="space-y-4">
                            <!-- Use grid layout for better organization -->
                            <div class="flex flex-col gap-4 md:grid md:grid-cols-2 lg:grid-cols-2">
                                <!-- cabang -->

                                <div class="mb-2">
                                    <label for="cabang"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cabang</label>
                                    <input disabled type="text" id="cabang" name="cabang"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                        placeholder="cabang">
                                </div>

                                <div class="mb-2">
                                    <label for="nama"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                                    <input disabled type="text" id="nama" name="nama"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                        placeholder="nama">
                                </div>

                                <div class="mb-2">
                                    <label for="username"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                                    <input disabled type="text" id="username" name="username"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                        placeholder="username">
                                </div>

                                <div class="mb-2">
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                                    <input disabled type="password" id="password" name="password"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                        placeholder="password">
                                </div>

                                <div class="mb-2">
                                    <label for="role"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                                    <input disabled type="role" id="role" name="role"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                        placeholder="role">
                                </div>

                                <div class="mb-2">
                                    <label for="status"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <input disabled type="status" id="status" name="status"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                        placeholder="status">
                                </div>

                            </div>
                            <!-- Submit Button -->
                            <div class="mb-2 col-span-2 sm:col-span-4">
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-blue-500 text-white rounded-md">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Container -->
                <div id="addUserModal"
                    class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden  md:px-32">
                    <!-- Modal Background with Blur effect -->
                    <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm"
                        onclick="closeModalAddUser()">
                    </div>

                    <!-- Modal Content -->
                    <div
                        class="relative bg-white dark:bg-gray-800 rounded-lg p-4 md:p-8 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-full z-10 max-h-screen overflow-y-auto w-full">
                        <!-- Close Button (X) -->
                        <button type="button" onclick="closeModalAddUser()"
                            class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                            <span class="material-symbols-outlined">close</span> <!-- Material icon for X -->
                        </button>

                        <!-- Modal Header with Title -->
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Tambah Data</h3>
                        </div>

                        <!-- Form Input Fields -->
                        <form id="addUserForm" class="space-y-4">
                            <!-- Use grid layout for better organization -->
                            <div class="flex flex-col gap-4 md:grid md:grid-cols-2 lg:grid-cols-2">
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
                                    <label for="nama"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                                    <input type="text" id="nama" name="nama"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                        placeholder="nama">
                                </div>

                                <div class="mb-2">
                                    <label for="username"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
                                    <input type="text" id="username" name="username"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                        placeholder="username">
                                </div>

                                <div class="mb-2">
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                                    <input type="password" id="password" name="password"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                        placeholder="password">
                                </div>

                                <!-- role (Dropdown) -->
                                <div class="mb-2">
                                    <label for="role"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                                    <select id="role" name="role"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="">Pilih Role</option>
                                        <option value="pending">Admin</option>
                                        <option value="in_role">Kepala Cabang</option>
                                        <option value="completed">Supervisor</option>
                                        <option value="completed">Salesman</option>
                                    </select>
                                </div>

                                <!-- status (Dropdown) -->
                                <div class="mb-2">
                                    <label for="status"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                    <select id="status" name="status"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>

                            </div>
                            <!-- Submit Button -->
                            <div class="mb-2 col-span-2 sm:col-span-4">
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-blue-500 text-white rounded-md">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endsection