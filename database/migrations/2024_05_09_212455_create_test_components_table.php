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
        Schema::create('test_components', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Test::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('unit')->nullable();
            $table->enum('result', ['text', 'select']);
            $table->text('reference_range')->nullable();
            $table->boolean('separated')->default(false);
            $table->decimal('price', 8, 2)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_components');
    }
};
