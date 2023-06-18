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
        Schema::create('identification_documents', function (Blueprint $table) {
            $table->id();
            $table->string('document_number')->unique();

            $table
                ->foreignUuid('registration_id')
                ->references('id')
                ->on('registrations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table
                ->foreignId('type_id')
                ->references('id')
                ->on('identification_document_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identification_documents');
    }
};
