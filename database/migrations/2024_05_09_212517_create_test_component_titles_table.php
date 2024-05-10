<?php

use App\Models\Test\Test;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_component_titles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Test::class)->constrained()->onDelete('cascade')->onUpdate('cascade');;
            $table->string('title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_component_titles');
    }
};
