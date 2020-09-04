<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // membuat table persons
        Schema::create('contacts', function (Blueprint $table) {
            // menambahkan beberapa column pada table
            $table->bigIncrements('id');
            $table->String('email');
            $table->String('name');
            $table->String('phone');
            $table->Text('message');
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
        Schema::dropIfExists('contacts');
    }
}
