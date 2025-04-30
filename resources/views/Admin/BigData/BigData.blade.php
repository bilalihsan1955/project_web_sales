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

                    <script>
                        // Fungsi untuk menampilkan hasil pencarian berdasarkan input
                        document.getElementById('customerSearch').addEventListener('input', function() {
                            let searchValue = this.value.toLowerCase(); // Ambil nilai pencarian dan ubah ke huruf kecil
                    
                            // Ambil semua baris data dari tabel
                            let rows = document.querySelectorAll('#customerTable tbody tr');
                    
                            // Loop untuk setiap baris tabel
                            rows.forEach(function(row) {
                                let cells = row.getElementsByTagName('td');
                                let match = false;
                    
                                // Periksa apakah salah satu cell dalam baris cocok dengan nilai pencarian
                                for (let i = 0; i < cells.length; i++) {
                                    if (cells[i]) {
                                        let cellText = cells[i].textContent || cells[i].innerText;
                                        if (cellText.toLowerCase().includes(searchValue)) {
                                            match = true;
                                            break; // Jika ditemukan, keluar dari loop
                                        }
                                    }
                                }
                    
                                // Menampilkan atau menyembunyikan baris berdasarkan pencocokan
                                if (match) {
                                    row.style.display = ''; // Tampilkan baris
                                } else {
                                    row.style.display = 'none'; // Sembunyikan baris
                                }
                            });
                        });
                    </script>                    

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
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" @if(request()->branch == $branch->id) selected @endif>
                                    {{ $branch->name }}  <!-- Assuming the 'name' column is the name of the branch -->
                                </option>
                            @endforeach
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
                            <option value="">All Cities</option>  <!-- Option for "All Cities" -->
                            <!-- Loop through all cities and display each in the select dropdown -->
                            @foreach($cities as $city)
                                <option value="{{ $city->kota }}" @if(request()->city == $city->kota) selected @endif>
                                    {{ $city->kota }}  <!-- Display city name -->
                                </option>
                            @endforeach
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
                            <option value="SPK" @if(request()->progress == 'SPK') selected @endif>SPK</option>
                            <option value="Pending" @if(request()->progress == 'Pending') selected @endif>Pending</option>
                            <option value="Reject" @if(request()->progress == 'Reject') selected @endif>Reject</option>
                            <option value="DO" @if(request()->progress == 'DO') selected @endif>DO</option>
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
                            <select id="itemsPerPage" name="itemsPerPage" onchange="this.form.submit()"
                            class="appearance-none w-full pl-4 pr-8 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="5" {{ request('itemsPerPage') == '5' ? 'selected' : '' }}>5 items</option>
                                <option value="10" {{ request('itemsPerPage') == '10' ? 'selected' : '' }}>10 items</option>
                                <option value="20" {{ request('itemsPerPage') == '20' ? 'selected' : '' }}>20 items</option>
                                <option value="50" {{ request('itemsPerPage') == '50' ? 'selected' : '' }}>50 items</option>
                            </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                            style="top: 24px;">
                            <span class="material-symbols-outlined text-gray-400 dark:text-gray-500 text-lg">expand_more</span>
                        </div>
                    </div>

                    <script>
                        function updateFilterParam(param, value) {
                            const url = new URL(window.location.href);
                    
                            if (value) {
                                url.searchParams.set(param, value);
                            } else {
                                url.searchParams.delete(param);
                            }
                    
                            // Reset ke halaman pertama agar pagination tidak error saat filter berubah
                            url.searchParams.delete('page');
                    
                            window.location.href = url.toString();
                        }
                    
                        // Filter City
                        document.getElementById('cityFilter').addEventListener('change', function () {
                            updateFilterParam('city', this.value);
                        });
                    
                        // Filter Branch
                        document.getElementById('branchFilter').addEventListener('change', function () {
                            updateFilterParam('branch', this.value);
                        });
                    
                        // Filter Progress
                        document.getElementById('progressFilter').addEventListener('change', function () {
                            updateFilterParam('progress', this.value);
                        });
                    
                        // Filter Items Per Page
                        document.getElementById('itemsPerPage').addEventListener('change', function () {
                            updateFilterParam('itemsPerPage', this.value);
                        });
                    </script>                    
                </div>
            </div>

            <div class="overflow-x-auto px-4 sm:px-6">
                <!-- Wrapper with maximum width and overflow scroll for mobile display -->
                <div class="w-full max-w-full overflow-x-auto">
                    <table id="customerTable" class="w-full text-sm border border-collapse rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th id="col-no" class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">No</th>
                                <th id="col-cabang" class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">Cabang</th>
                                <th id="col-nama" class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">Nama</th>
                                <th id="col-kota" class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">Kota</th>
                                <th id="col-tgllahir" class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">Tgl Lahir</th>
                                <th id="col-kendaraan" class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">Jenis Kendaraan</th>
                                <th id="col-customer" class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">Sales</th>
                                <th id="col-progress" class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">Progress</th>
                                <th id="col-keterangan" class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">Keterangan</th>
                                <th id="col-aksi" class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-500 font-semibold text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through the customers data -->
                            @foreach($customers as $customer)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $loop->iteration }}</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->branch->name }}</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->nama }}</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->kota }}</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->tanggal_lahir }}</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->model_mobil }}</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->salesman ? $customer->salesman->name : 'N/A' }}</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if($customer->progress == 'SPK') 
                                            bg-blue-100 text-blue-800
                                        @elseif($customer->progress == 'DO') 
                                            bg-green-100 text-green-800
                                        @elseif($customer->progress == 'Pending') 
                                            bg-orange-100 text-orange-800
                                        @else 
                                            bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $customer->progress ?: 'No Progress' }}
                                    </span>
                                </td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600">{{ $customer->alasan ?? 'No reason' }}</td>
                                <td class="p-2 sm:p-3 border-b border-gray-200 dark:border-gray-600 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        {{-- show --}}
                                        <button onclick="openCustomerModal({{ $customer->id }})"
                                            class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/50 dark:hover:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md border border-blue-200 dark:border-blue-700 transition-colors">
                                            <span class="material-symbols-outlined text-sm">info</span>
                                        </button>
                                        {{-- delete --}}
                                        <form action="{{ route('admin.customer.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-2 py-1.5 text-xs sm:text-sm flex items-center gap-1 bg-red-50 hover:bg-red-100 dark:bg-red-900/50 dark:hover:bg-red-900 text-red-600 dark:text-red-300 rounded-md border border-red-200 dark:border-red-700 transition-colors">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            

            <!-- Pagination -->
            <div class="px-4 sm:px-6 py-6 border-gray-200 dark:border-gray-600 flex flex-col sm:flex-row justify-between items-center gap-3">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Showing <span id="showingFrom">{{ $customers->firstItem() }}</span> to <span id="showingTo">{{ $customers->lastItem() }}</span> of <span id="totalItems">{{ $customers->total() }}</span> entries
                </div>
                <div class="p-0 border-gray-200 dark:border-gray-600 flex flex-col sm:flex-row justify-between items-center gap-3 w-full sm:w-auto">
                    <div class="flex flex-col sm:flex-row sm:gap-3 gap-2 md:gap-0 w-full sm:justify-end sm:space-x-3 mt-3">
                        <!-- Previous button (Mobile: on top, full width) -->
                        {{ $customers->links() }} <!-- Laravel's pagination links -->
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
            <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm" onclick="closeModalAddData()"></div>
        
            <!-- Modal Content -->
            <div class="relative bg-white dark:bg-gray-800 rounded-lg p-4 md:p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-full z-10 max-h-screen overflow-y-auto w-full">
                <!-- Close Button (X) -->
                <button type="button" onclick="closeModalAddData()" class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                    <span class="material-symbols-outlined">close</span>
                </button>
        
                <!-- Modal Header with Title -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Tambah Data</h3>
                </div>
        
                <!-- Modal Form Input Fields -->
                <form id="addDataForm" action="{{ route('admin.bigdata.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col gap-4 md:grid md:grid-cols-2 lg:grid-cols-4">
                        <!-- Cabang (Dropdown) -->
                        <div class="mb-2">
                            <label for="branch_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cabang</label>
                            <select id="branch_id" name="branch_id"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200">
                                <option value="">Select Branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Salesman -->
                        <div class="mb-2">
                            <label for="salesman_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salesman</label>
                            <input type="text" id="salesman_id" name="salesman_id"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200" placeholder="Salesman">
                        </div>
                
                        <!-- Nama -->
                        <div class="mb-2">
                            <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                            <input type="text" id="nama" name="nama"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Nama" required>
                        </div>
                
                        <!-- Alamat -->
                        <div class="mb-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                            <input type="text" id="alamat" name="alamat"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Alamat">
                        </div>
                
                        <!-- Nomor HP 1 -->
                        <div class="mb-2">
                            <label for="nomor_hp_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor HP 1</label>
                            <input type="text" id="nomor_hp_1" name="nomor_hp_1"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Nomor HP 1" required>
                        </div>
                
                        <!-- Nomor HP 2 -->
                        <div class="mb-2">
                            <label for="nomor_hp_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor HP 2</label>
                            <input type="text" id="nomor_hp_2" name="nomor_hp_2"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Nomor HP 2">
                        </div>
                
                        <!-- Kelurahan -->
                        <div class="mb-2">
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelurahan</label>
                            <input type="text" id="kelurahan" name="kelurahan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Kelurahan">
                        </div>
                
                        <!-- Kecamatan -->
                        <div class="mb-2">
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kecamatan</label>
                            <input type="text" id="kecamatan" name="kecamatan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Kecamatan">
                        </div>
                
                        <!-- Kota -->
                        <div class="mb-2">
                            <label for="kota" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kota</label>
                            <input type="text" id="kota" name="kota"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Kota">
                        </div>
                
                        <!-- Tanggal Lahir -->
                        <div class="mb-2">
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200">
                        </div>
                
                        <!-- Jenis Kelamin -->
                        <div class="mb-2">
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                
                        <!-- Tipe Pelanggan -->
                        <div class="mb-2">
                            <label for="tipe_pelanggan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Pelanggan</label>
                            <select id="tipe_pelanggan" name="tipe_pelanggan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="first buyer">First Buyer</option>
                                <option value="replacement">Replacement</option>
                                <option value="additional">Additional</option>
                            </select>
                        </div>
                
                        <!-- Jenis Pelanggan -->
                        <div class="mb-2">
                            <label for="jenis_pelanggan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Pelanggan</label>
                            <select id="jenis_pelanggan" name="jenis_pelanggan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="Retail">Retail</option>
                                <option value="Fleet">Fleet</option>
                            </select>
                        </div>
                
                        <!-- Pekerjaan -->
                        <div class="mb-2">
                            <label for="pekerjaan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pekerjaan</label>
                            <input type="text" id="pekerjaan" name="pekerjaan"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Pekerjaan">
                        </div>
                
                        <!-- Tenor -->
                        <div class="mb-2">
                            <label for="tenor" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tenor</label>
                            <input type="number" id="tenor" name="tenor"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Tenor">
                        </div>
                
                        <!-- Tanggal Gatepass -->
                        <div class="mb-2">
                            <label for="tanggal_gatepass" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Gatepass</label>
                            <input type="date" id="tanggal_gatepass" name="tanggal_gatepass"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200">
                        </div>
                
                        <!-- Model Mobil -->
                        <div class="mb-2">
                            <label for="model_mobil" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model Mobil</label>
                            <input type="text" id="model_mobil" name="model_mobil"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Model Mobil">
                        </div>
                
                        <!-- Nomor Rangka -->
                        <div class="mb-2">
                            <label for="nomor_rangka" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Rangka</label>
                            <input type="text" id="nomor_rangka" name="nomor_rangka"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Nomor Rangka">
                        </div>
                
                        <!-- Sumber Data -->
                        <div class="mb-2">
                            <label for="sumber_data" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sumber Data</label>
                            <input type="text" id="sumber_data" name="sumber_data"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200"
                                placeholder="Sumber Data">
                        </div>
                    </div>
                
                    <!-- Submit Button -->
                    <div class="mb-2 col-span-2 sm:col-span-4">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md">Submit</button>
                    </div>
                </form>                

        <!-- Modal Tampil Container -->
        <div id="TampilDataModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden">
            <!-- Modal Background with Blur effect -->
            <div class="absolute inset-0 bg-gray-100 bg-opacity-10 backdrop-blur-sm" onclick="closeTampilData()"></div>
        
            <!-- Modal Content -->
            <div class="relative bg-white dark:bg-gray-800 rounded-lg p-4 md:p-6 max-w-md w-full mx-4 my-6 sm:my-8 md:max-w-full z-10 max-h-screen overflow-y-auto w-full">
                <!-- Close Button (X) -->
                <button type="button" onclick="closeTampilData()" class="text-xl text-gray-500 dark:text-gray-300 absolute top-4 right-4">
                    <span class="material-symbols-outlined">close</span>
                </button>
        
                <!-- Modal Header with Title -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 dark:text-white">Info Customer</h3>
                </div>
        
                <!-- Modal Body with Data Display -->
                <div class="space-y-4">
                    <!-- Progress -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Progress</label>
                        <p id="progress" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Progress -->
                        </p>
                    </div>
        
                    <!-- Alasan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alasan</label>
                        <p id="alasan" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Alasan -->
                        </p>
                    </div>
        
                    <!-- Cabang -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cabang</label>
                        <p id="cabang" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Cabang -->
                        </p>
                    </div>
        
                    <!-- Salesman -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Salesman</label>
                        <p id="salesman" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Salesman -->
                        </p>
                    </div>
        
                    <!-- Nama -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                        <p id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Nama -->
                        </p>
                    </div>
        
                    <!-- Alamat -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                        <p id="alamat" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Alamat -->
                        </p>
                    </div>
        
                    <!-- Kelurahan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kelurahan</label>
                        <p id="kelurahan" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Kelurahan -->
                        </p>
                    </div>
        
                    <!-- Kecamatan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kecamatan</label>
                        <p id="kecamatan" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Kecamatan -->
                        </p>
                    </div>
        
                    <!-- Kota -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kota</label>
                        <p id="kota" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Kota -->
                        </p>
                    </div>
        
                    <!-- Tanggal Lahir -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Lahir</label>
                        <p id="tanggal_lahir" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Tanggal Lahir -->
                        </p>
                    </div>
        
                    <!-- Other fields -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kelamin</label>
                        <p id="jenis_kelamin" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Jenis Kelamin -->
                        </p>
                    </div>
        
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Pelanggan</label>
                        <p id="tipe_pelanggan" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Tipe Pelanggan -->
                        </p>
                    </div>
        
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Pelanggan</label>
                        <p id="jenis_pelanggan" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Jenis Pelanggan -->
                        </p>
                    </div>
        
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tenor</label>
                        <p id="tenor" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Tenor -->
                        </p>
                    </div>
        
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Gatepass</label>
                        <p id="tanggal_gatepass" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Tanggal Gatepass -->
                        </p>
                    </div>
        
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model Mobil</label>
                        <p id="model_mobil" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Model Mobil -->
                        </p>
                    </div>
        
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Rangka</label>
                        <p id="nomor_rangka" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for Nomor Rangka -->
                        </p>
                    </div>
        
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Telepon</label>
                        <p id="no_telpon" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for No Telepon -->
                        </p>
                    </div>
        
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No Telepon Update</label>
                        <p id="no_telepon_update" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-800">
                            <!-- Dynamic content for No Telepon Update -->
                        </p>
                    </div>
                </div>
            </div>
        </div>        

        <script>
            // Fungsi untuk membuka modal dan mengisi data customer
            function openCustomerModal(customerId) {
                // Mengambil data customer dari backend menggunakan AJAX (fetch API)
                fetch(`/admin/customer/${customerId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Isi modal dengan data customer yang diterima

                        // Progress
                        document.getElementById('progress').innerText = data.progress || 'No progress';

                        // Alasan
                        document.getElementById('alasan').innerText = data.alasan || 'No reason';

                        // Cabang
                        document.getElementById('cabang').innerText = data.branch ? data.branch.name : 'No branch';

                        // Salesman
                        document.getElementById('salesman').innerText = data.salesman ? data.salesman.name : 'No salesman';

                        // Nama
                        document.getElementById('nama').innerText = data.nama || 'No name';

                        // Alamat
                        document.getElementById('alamat').innerText = data.alamat || 'No address';

                        // Kelurahan
                        document.getElementById('kelurahan').innerText = data.kelurahan || 'No kelurahan';

                        // Kecamatan
                        document.getElementById('kecamatan').innerText = data.kecamatan || 'No kecamatan';

                        // Kota
                        document.getElementById('kota').innerText = data.kota || 'No city';

                        // Tanggal Lahir
                        document.getElementById('tanggal_lahir').innerText = data.tanggal_lahir || 'No birth date';

                        // Jenis Kelamin
                        document.getElementById('jenis_kelamin').innerText = data.jenis_kelamin || 'No gender';

                        // Tipe Pelanggan
                        document.getElementById('tipe_pelanggan').innerText = data.tipe_pelanggan || 'No type';

                        // Jenis Pelanggan
                        document.getElementById('jenis_pelanggan').innerText = data.jenis_pelanggan || 'No type';

                        // Tenor
                        document.getElementById('tenor').innerText = data.tenor || 'No tenor';

                        // Tanggal Gatepass
                        document.getElementById('tanggal_gatepass').innerText = data.tanggal_gatepass || 'No gatepass date';

                        // Model Mobil
                        document.getElementById('model_mobil').innerText = data.model_mobil || 'No vehicle model';

                        // Nomor Rangka
                        document.getElementById('nomor_rangka').innerText = data.nomor_rangka || 'No frame number';

                        // No Telepon
                        document.getElementById('no_telpon').innerText = data.nomor_hp_1 || 'No phone number';

                        // No Telepon Update
                        document.getElementById('no_telepon_update').innerText = data.nomor_hp_2 || 'No updated phone number';

                        // Tampilkan modal
                        document.getElementById('TampilDataModal').classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // Fungsi untuk menutup modal
            function closeTampilData() {
                document.getElementById('TampilDataModal').classList.add('hidden');
            }
        </script>
@endsection