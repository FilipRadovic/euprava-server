<?php

use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('identification_document_types')->insert([
            ['type' => 'PASOS'],
            ['type' => 'LICNA_KARTA']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('identification_document_types')
            ->whereIn('type', ['PASOS', 'LICNA_KARTA'])
            ->delete();
    }
};
