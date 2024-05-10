<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestComponent extends Model
{
    use HasFactory;

    protected $fillable = ['test_id', 'name', 'unit', 'result', 'reference_range', 'separated', 'price', 'status'];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
