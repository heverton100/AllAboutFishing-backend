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
        Schema::table('endpoints', function (Blueprint $table) {
            $table->string('parameters') // Nome da coluna
            ->nullable() // Preenchimento não obrigatório
            ->after('category'); // Ordenado após a coluna "password"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('endpoints', function (Blueprint $table) {
            $table->dropColumn('parameters');
        });
    }
};
