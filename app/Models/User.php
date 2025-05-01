<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Authenticatable; // Import trait
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable, SoftDeletes;  // Tambahkan Authenticatable trait

    // Tentukan nama tabel yang digunakan
    protected $table = 'user';  // Sesuaikan dengan nama tabel yang benar

    // Definisikan kolom yang bisa diisi
    protected $fillable = ['username', 'password', 'role', 'name', 'email', 'status', 'branch_id'];  // Pastikan kolom yang digunakan benar

    public function getOriginalPassword()
    {
        return $this->getOriginal('password');
    }

    // Relasi dengan FollowUp, Customer, dan History
    public function followUps()
    {
        return $this->hasMany(FollowUp::class, 'salesman_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'salesman_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function supervisedSalesmen()
    {
        return $this->belongsToMany(User::class, 'supervisor_salesman', 'supervisor_id', 'salesman_id')
                    ->withTimestamps();
    }

    public function supervisors()
    {
        return $this->belongsToMany(User::class, 'supervisor_salesman', 'salesman_id', 'supervisor_id')
                    ->withTimestamps();
    }
    
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');  // Pastikan kolom 'branch_id' ada di tabel 'user'
    }

    protected $dates = ['deleted_at'];
}
