<?php

use Illuminate\Container\Attributes\DB;
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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_item')->constrained('item_masters')->onDelete('cascade');
            $table->foreignId('id_admin')->nullable()->constrained('users')->onDelete('cascade');

            $table->date('date_loan');
            $table->date('date_return');
            $table->date('date_returned')->nullable();
            $table->integer('quantity')->default(1);

            $table->enum('status', ['approve', 'reject', 'waiting for respond'])->default('waiting for respond');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
