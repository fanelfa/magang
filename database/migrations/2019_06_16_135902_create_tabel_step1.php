<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabelStep1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('user_id');
            $table->string('name');
            $table->date('lahir');
            $table->string('agama');
            $table->text('alamat');
            $table->timestamps();
        });

        Schema::create('guru', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('NIP');
            $table->string('name');
            $table->date('lahir');
            $table->text('alamat');
            $table->string('avatar');
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
        Schema::dropIfExists('siswa');
        Schema::dropIfExists('guru');
    }
}
