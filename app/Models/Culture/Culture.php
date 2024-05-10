<?php

namespace App\Models\Culture;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'shortcut', 'sample_type', 'price', 'comments'];
}
