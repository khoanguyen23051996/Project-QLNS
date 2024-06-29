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
        Schema::table('staff', function (Blueprint $table) {
            //B1 :
            $table->unsignedBigInteger('position_id');

            //B2: 
            $table->foreign('position_id')->references('id')->on('staff');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropForeign('staff_position_id_foreign');
            $table->dropColumn('position_id');
        });
    }
};
