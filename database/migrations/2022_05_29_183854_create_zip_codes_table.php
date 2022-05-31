<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(): void
  {
    Schema::create('zip_codes', function (Blueprint $table) {
      $table->id();
      $table->string('zip_code');
      $table->string('locality');
      $table->integer('federal_entity_key');
      $table->string('federal_entity_name');
      $table->string('federal_entity_code')->nullable();
      $table->text('settlements');
      $table->integer('municipality_key');
      $table->string('municipality_name');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('zip_codes');
  }

};
