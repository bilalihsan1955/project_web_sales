<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;

class SavedDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan ID salesman yang login
        $salesmanId = auth()->user()->id;

        // Ambil customer yang sudah disimpan oleh salesman
        $savedCustomers = Customer::where('salesman_id', $salesmanId)
            ->where('saved', 1) // Status saved = 1
            ->with(['branch', 'salesman'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Salesman.SavedData.SavedData', compact('savedCustomers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|string|max:255',
            'salesman_id' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_hp_1' => 'required|string|max:255',
            'nomor_hp_2' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:L,P',
            'tipe_pelanggan' => 'required|string|max:255',
            'jenis_pelanggan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'tenor' => 'required|integer',
            'tanggal_gatepass' => 'required|date',
            'model_mobil' => 'required|string|max:255',
            'nomor_rangka' => 'required|string|max:255',
            'sumber_data' => 'required|string|max:255',
            'progress' => 'required|string|max:255',
            'alasan' => 'required|string|max:255',
        ]);

        $customers = Customer::create([
            'branch_id' => $validated['branch_id'],
            'salesman_id' => $validated['salesman_id'],
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'nomor_hp_1' => $validated['nomor_hp_1'],
            'nomor_hp_2' => $validated['nomor_hp_2'],
            'kelurahan' => $validated['kelurahan'],
            'kecamatan' => $validated['kecamatan'],
            'kota' => $validated['kota'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tipe_pelanggan' => $validated['tipe_pelanggan'],
            'jenis_pelanggan' => $validated['jenis_pelanggan'],
            'pekerjaan' => $validated['pekerjaan'],
            'tenor' => $validated['tenor'],
            'tanggal_gatepass' => $validated['tanggal_gatepass'],
            'model_mobil' => $validated['model_mobil'],
            'nomor_rangka' => $validated['nomor_rangka'],
            'sumber_data' => $validated['sumber_data'],
            'progress' => $validated['progress'],
            'alasan' => $validated['alasan'],
        ]);

        return redirect()->route('salesman.saved-customer')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'progress' => 'nullable|string',
            'alasan' => 'nullable|string',
            'branch' => 'nullable|string',
            'salesman' => 'nullable|string',
            'sumber_data' => 'nullable|string',
            'nama' => 'required|string',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kota' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string',
            'tipe_pelanggan' => 'nullable|string',
            'jenis_pelanggan' => 'nullable|string',
            'tanggal_gatepass' => 'nullable|date',
            'pekerjaan' => 'nullable|string',
            'model_mobil' => 'nullable|string',
            'nomor_rangka' => 'nullable|string',
            'nomor_hp_1' => 'nullable|string',
            'nomor_hp_2' => 'nullable|string',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->progress = $request->progress;
        $customer->alasan = $request->alasan;
        $customer->branch_id = Branch::where('name', $request->branch)->value('id'); // atau sesuai struktur relasi
        $customer->salesman_id = Customer::where('name', $request->salesman)->value('id'); // jika relasi by name
        $customer->sumber_data = $request->sumber_data;
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->kelurahan = $request->kelurahan;
        $customer->kecamatan = $request->kecamatan;
        $customer->kota = $request->kota;
        $customer->tanggal_lahir = $request->tanggal_lahir;
        $customer->jenis_kelamin = $request->jenis_kelamin;
        $customer->tipe_pelanggan = $request->tipe_pelanggan;
        $customer->jenis_pelanggan = $request->jenis_pelanggan;
        $customer->tanggal_gatepass = $request->tanggal_gatepass;
        $customer->pekerjaan = $request->pekerjaan;
        $customer->model_mobil = $request->model_mobil;
        $customer->nomor_rangka = $request->nomor_rangka;
        $customer->nomor_hp_1 = $request->nomor_hp_1;
        $customer->nomor_hp_2 = $request->nomor_hp_2;
        $customer->save();

        return redirect()->route('salesman.saved-customer')->with('updated', 'Data customer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
