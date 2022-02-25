<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArchiveOfColumnToDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document', function (Blueprint $table) {
            $table->string('archive_of')->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document', function (Blueprint $table) {
            
            $table->dropColumn('archive_of');
        });
    }
}
