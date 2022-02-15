<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->uuid('track_id');
            $table->foreignId('user_id')->constrained();
            $table->string('deposit', 26);
            $table->unsignedBigInteger('amount');
            $table->string('description', 30);
            $table->string('destination_first_name', 33);
            $table->string('destination_last_name', 33);
            $table->string('destination_number', 26);
            $table->string('payment_number', 30)->nullable();
            $table->foreignId('reason_description_id')->nullable()->constrained();
            $table->string('status', 20)->default('unknown');
            $table->string('inquiry_date')->nullable();
            $table->string('inquiry_sequence')->nullable();
            $table->string('inquiry_time')->nullable();
            $table->string('ref_code')->nullable();
            $table->string('type')->nullable();
            $table->string('error_code')->nullable();
            $table->string('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
