<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('return_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_loan');
            $table->foreign('id_loan')->references('id')->on('loans')->onDelete('cascade');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_item');
            $table->foreign('id_item')->references('id')->on('item_masters')->onDelete('cascade');
            $table->date('return_date');
            $table->date('date_returned')->nullable();
            $table->text('notes')->nullable();
            $table->integer('quantity');
            $table->string('condition');
            $table->timestamps();
        });

        DB::unprepared('
            CREATE TRIGGER update_quantity_after_return
            AFTER INSERT ON return_items
            FOR EACH ROW
            BEGIN
                UPDATE item_masters
                SET quantity = quantity + NEW.quantity
                WHERE id = NEW.id_item;

                UPDATE loans
                SET status = "returned" 
                WHERE id = NEW.id_loan;
            END;
        ');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_quantity_after_return');
        Schema::dropIfExists('return_items');
    }
};
