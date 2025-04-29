<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomerExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Return a collection of customers with their branch and salesman relations
     * 
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil semua data customer beserta relasi 'branch' dan 'salesman'
        return Customer::with(['branch', 'salesman'])->get();
    }

    /**
     * Map each customer to their corresponding row data in Excel.
     *
     * @param  Customer $customer
     * @return array
     */
    public function map($customer): array
    {
        return [
            $customer->nama,
            $customer->alamat,
            $customer->nomor_hp_1,
            $customer->nomor_hp_2,
            $customer->kelurahan,
            $customer->kecamatan,
            $customer->kota,
            $customer->tanggal_lahir,
            $customer->jenis_kelamin,
            $customer->tipe_pelanggan,
            $customer->jenis_pelanggan,
            $customer->model_mobil,
            $customer->nomor_rangka,
            $customer->pekerjaan,
            $customer->tenor,
            $customer->tanggal_gatepass,
            $customer->branch?->name ?? '-',  // Menampilkan nama cabang atau '-' jika tidak ada
            $customer->salesman?->name ?? '-',  // Menampilkan nama salesman atau '-' jika tidak ada
            $customer->sumber_data,
            $customer->progress,
            $customer->alasan,
        ];
    }

    /**
     * Define the headings for the export file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nama', 'Alamat', 'Nomor HP 1', 'Nomor HP 2', 'Kelurahan', 'Kecamatan',
            'Kota', 'Tanggal Lahir', 'Jenis Kelamin', 'Tipe Pelanggan', 'Jenis Pelanggan',
            'Model Mobil', 'Nomor Rangka', 'Pekerjaan', 'Tenor', 'Tanggal Gatepass',
            'Cabang', 'Salesman', 'Sumber Data', 'Progress', 'Alasan'
        ];
    }
}
