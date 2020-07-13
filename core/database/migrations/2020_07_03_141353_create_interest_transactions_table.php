<?php

use App\InterestTransaction;
use App\Wallet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('CASCADE');
            $table->foreignId('admin_id')
                ->constrained()
                ->onDelete('CASCADE');
            $table->string('trax_id');
            $table->double('interest_rate')->default(InterestTransaction::INTEREST_RATE);
            $table->double('bonus');
            $table->double('amount');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interest_transactions');
    }
}
