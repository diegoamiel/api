<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pedidos extends Migration{
    
    public function up(){
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string("usuario", 250);
            $table->string("fecha", 250);
            $table->string("estado", 250);

            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('pedidos');
    }
}