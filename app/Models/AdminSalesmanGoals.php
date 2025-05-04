<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSalesmanGoals extends Model
{
    use HasFactory;

    protected $table = 'admin_salesman_goals';

    protected $fillable = [
        'id', 'cabang', 'nama', 'follow_up', 'saved'
    ];
}
