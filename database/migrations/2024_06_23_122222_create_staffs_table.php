<?php

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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->nullable()->unique();
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->dateTime('dob')->nullable();
            $table->string('address', 255);
            $table->string('phone', 15);
            $table->string('image', 255)->nullable();
            $table->tinyInteger('status')->default(1);
            // $table->unsignedBigInteger('department_id');
            // $table->foreign('department_id')->references('id')->on('department'); 
            // $table->unsignedBigInteger('position_id');
            // $table->foreign('position_id')->references('id')->on('position'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
