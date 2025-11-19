<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('cpf')->nullable();
            $table->string('cnpj')->unique();
            $table->string('cep');
            $table->string('state');
            $table->string('city');
            $table->string('street');
            $table->string('number');
            $table->string('complement')->nullable();

            $table->boolean('agreed')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
