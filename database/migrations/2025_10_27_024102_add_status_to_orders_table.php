<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('orders', function($table){
        $table->string('status')->default('pendiente');
    });
}

public function down()
{
    Schema::table('orders', function($table){
        $table->dropColumn('status');
    });
}

};
