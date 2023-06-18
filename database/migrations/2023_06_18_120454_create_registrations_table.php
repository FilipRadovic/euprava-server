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
        Schema::create('registrations', function (Blueprint $table) {
            $table
                ->uuid('id')
                ->primary();

            $table->string('status')->default('PENDING');
            $table->string('firstname', 30);
            $table->string('lastname', 30);
            $table->string('jmbg', 13)->unique();
            $table->string('email', 30)->unique();
            $table->string('username', 30)->unique();
            $table->string('password', 30);

            $table
                ->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->restrictOnDelete();

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
        Schema::dropIfExists('registrations');
    }
};
