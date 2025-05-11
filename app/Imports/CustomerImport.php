<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Branch;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class CustomersImport implements ToModel, WithHeadings, SkipsEmptyRows
{
    /**
     * Transform each row into a Customer model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Cari cabang berdasarkan nama cabang
        $branch = Branch::where('name', $row[0])->first();
        if (!$branch) {
            // Jika cabang tidak ditemukan, set sebagai null atau beri error
            return null;
        }

        // Cari salesman berdasarkan nama salesman
        $salesman = User::where('name', $row[1])->first();
        if (!$salesman) {
            // Jika salesman tidak ditemukan, set sebagai null
            $salesman = null;
        }

        // Pastikan kolom yang diimpor sesuai dengan urutan dan data yang benar
        return new Customer([
            'branch_id' => $branch->id, // ID cabang yang valid
            'salesman_id' => $salesman ? $salesman->id : null, // ID salesman (null jika tidak valid)
            'nama' => $row[2], // Nama customer
            'alamat' => $row[3], // Alamat customer
            'nomor_hp_1' => $row[4], // Nomor HP pertama
            'nomor_hp_2' => $row[5], // Nomor HP kedua
            'kelurahan' => $row[6], // Kelurahan
            'kecamatan' => $row[7], // Kecamatan
            'kota' => $row[8], // Kota
            'tanggal_lahir' => $row[9] ? \Carbon\Carbon::parse($row[9]) : null, // Tanggal lahir
            'jenis_kelamin' => $row[10], // Jenis kelamin
            'tipe_pelanggan' => $row[11], // Tipe pelanggan
            'jenis_pelanggan' => $row[12], // Jenis pelanggan
            'pekerjaan' => $row[13], // Pekerjaan
            'tenor' => $row[14], // Tenor
            'tanggal_gatepass' => $row[15] ? \Carbon\Carbon::parse($row[15]) : null, // Tanggal gatepass
            'model_mobil' => $row[16], // Model mobil
            'nomor_rangka' => $row[17], // Nomor rangka
            'sumber_data' => $row[18], // Sumber data
            'progress' => $row[19] ?? 'Tidak Ada', // Progress default to "Tidak Ada"
            'saved' => 0, // Saved (default false)
            'alasan' => $row[21], // Alasan
            'old_salesman' => $row[20], // Old Salesman
        ]);
    }

    /**
     * Menambahkan Headings untuk validasi file Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Cabang',      // Ganti dengan nama cabang
            'Old Salesman',    // Ganti dengan nama salesman
            'Nama', 
            'Alamat', 
            'Nomor HP 1', 
            'Nomor HP 2', 
            'Kelurahan', 
            'Kecamatan', 
            'Kota', 
            'Tanggal Lahir', 
            'Jenis Kelamin', 
            'Tipe Pelanggan', 
            'Jenis Pelanggan', 
            'Pekerjaan', 
            'Tenor', 
            'Tanggal Gatepass', 
            'Model Mobil', 
            'Nomor Rangka', 
            'Sumber Data', 
            'Progress', 
            'Saved', 
            'Alasan'
        ];
    }
}
