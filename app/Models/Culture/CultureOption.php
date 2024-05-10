<?php

namespace App\Models\Culture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultureOption extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'options'];

    protected $casts = [
        'options' => 'array',
    ];
}
