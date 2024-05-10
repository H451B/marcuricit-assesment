<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestComponentTitle extends Model
{
    use HasFactory;

    protected $fillable = ['test_id', 'title'];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
