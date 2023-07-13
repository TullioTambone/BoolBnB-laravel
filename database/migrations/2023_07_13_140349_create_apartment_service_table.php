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
        Schema::create('apartment_service', function (Blueprint $table) {
            
            // creazione colonna per gli id della tabella apartments
            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')->references('id')->on('apartments')->cascadeOnDelete(); // cascadeOnDelete() elimina automaticamente i record correlati con il record padre

            // creazione colonna per gli id della tabella services
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->cascadeOnDelete();
            
            // specificazione di primary key
            $table->primary([
                'apartment_id',
                'service_id'
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
        Schema::dropIfExists('apartment_service');
    }
};
