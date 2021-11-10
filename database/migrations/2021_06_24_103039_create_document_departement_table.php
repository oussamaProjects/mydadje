<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentDepartementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_departement', function (Blueprint $table) {
            $table->unsignedInteger('document_id');
            $table->unsignedInteger('department_id');
            $table->integer('permission_for');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->primary(['document_id', 'department_id']);

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
        Schema::dropIfExists('document_departement');
    }
}