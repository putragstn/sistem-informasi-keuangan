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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('user_id')->constrained('users');
            $table->foreignId('salary_id')->constrained('salaries');    // untuk jabatan dan gaji
            $table->string('nama', 64);
            $table->string('gambar', 128)->default('photo.jpg');
            $table->string('nip', 16)->unique();
            $table->string('jenis_kelamin', 1);
            $table->string('tempat_lahir', 64);
            $table->date('tgl_lahir');       // sebelumnya "umur"
            $table->text('alamat');
            $table->string('no_telp', 32);
            $table->string('no_rek', 32);
            $table->string('bank', 32);
            $table->date('tgl_masuk');
            $table->integer('status')->default(1);      // default = karyawan kontrak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
