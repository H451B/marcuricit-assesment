<?php

namespace App\Models\Test;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'shortcut', 'sample_type', 'price', 'precautions'];

    public function testComponents()
    {
        return $this->hasMany(TestComponent::class);
    }

    public function testComponentTitles()
    {
        return $this->hasMany(TestComponentTitle::class);
    }
}
