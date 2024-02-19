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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->integer('jumlah_hutang')->default(0);
            // $table->integer('jumlah_bayar')->nullable();
            // $table->integer('sisa_hutang')->nullable();
            $table->date('tgl_pinjam')->default(date(now()));
            $table->date('tgl_jatuh_tempo')->nullable();
            $table->string('keterangan', 16)->default('Belum Lunas');
            $table->text('alasan');
            $table->integer('status')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
