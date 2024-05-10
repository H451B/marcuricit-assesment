<?php

namespace App\Models;

use App\Models\Test\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'patient_id',
        'doctor_id',
        'subtotal',
        'discount',
        'total',
        'paid',
        'due',
        'barcode',
        'reference',
        'date',
        'status',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class,'invoice_tests');
    }
}
