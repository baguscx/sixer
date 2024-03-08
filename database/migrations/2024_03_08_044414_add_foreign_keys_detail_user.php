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
        Schema::table('detail_user', function (Blueprint $table) {
            //tabel detail user memiliki foreign key users_id dengan aliases = fk_detail_user_to_users yang merujuk ke id di tabel users yang boleh di update & delete
            $table->foreign('users_id', 'fk_detail_user_to_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_user', function (Blueprint $table) {
            $table->dropForeign('fk_detail_user_to_users');
        });
    }
};
