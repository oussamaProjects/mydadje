<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolderDepartementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folder_departement', function (Blueprint $table) {
            $table->unsignedInteger('folder_id');
            $table->unsignedInteger('department_id');
            $table->integer('permission_for');

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('folder_id')->references('id')->on('folders')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->primary(['folder_id', 'department_id']);

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
        Schema::dropIfExists('folder_departement');
    }
}