<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


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

            $table->enum('status', ['approve', 'reject', 'waiting for respond', 'returned'])->default('waiting for respond');
            $table->timestamps();
        });

        DB::unprepared('
        CREATE TRIGGER update_quantity_after_loan_approve
        AFTER UPDATE OF status ON loans
        WHEN NEW.status = "approve" AND OLD.status != "approve"
        BEGIN
            UPDATE item_masters
            SET quantity = quantity - NEW.quantity
            WHERE id = NEW.id_item;
        END;
        ');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_quantity_after_loan_approve');
        Schema::dropIfExists('loans');
    }
};
