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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('compname')->nullable();
            $table->string('compbrand')->nullable();
            $table->string('compemail')->nullable();
            $table->string('compmob')->nullable();
            $table->string('compstreet')->nullable();
            $table->string('compcity')->nullable();
            $table->string('compcode')->nullable();
            $table->string('compcountry')->nullable();
            $table->string('cgst')->nullable();
            $table->string('gst_location')->nullable();
            $table->string('gst_file')->nullable();
            $table->string('cpan')->nullable();
            $table->string('tan')->nullable();
            $table->string('mca')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_address_location')->nullable();
            $table->string('head_office_address')->nullable();
            $table->string('web_link')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('companies');
    }
};
