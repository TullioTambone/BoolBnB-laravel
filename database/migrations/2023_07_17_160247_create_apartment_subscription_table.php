<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_subscription', function (Blueprint $table) {
           // creazione colonna per gli id della tabella apartments
           $table->unsignedBigInteger('apartment_id');
           $table->foreign('apartment_id')->references('id')->on('apartments')->cascadeOnDelete(); // cascadeOnDelete() elimina automaticamente i record correlati con il record padre

           // creazione colonna per gli id della tabella services
           $table->unsignedBigInteger('subscription_id');
           $table->foreign('subscription_id')->references('id')->on('subscriptions')->cascadeOnDelete();

           $table->dateTime('end_subscription');
           // specificazione di primary key
           $table->primary([
               'apartment_id',
               'subscription_id'
           ]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment_subscription');
    }
};
