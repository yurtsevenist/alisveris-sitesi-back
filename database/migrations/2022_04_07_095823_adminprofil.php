<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Adminprofil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adminprofils', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->string('tel')->nullable();
            $table->string('cns')->nullable();
            $table->date('date')->nullable();
            $table->string('departman')->nullable();
            $table->string('adres')->nullable();           
            $table->timestamps();
            $table->foreign('admin_id')
            ->references('id')
            ->on('admins');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adminprofils');
    }
}
