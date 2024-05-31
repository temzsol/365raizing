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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('bname')->nullable();
            $table->string('bcomp')->nullable();
            $table->string('bdivision')->nullable();
            $table->string('div_mail')->nullable();
            $table->string('div_mob')->nullable();
            $table->string('bemail')->nullable();
            $table->string('bmob')->nullable();
            $table->string('bstreet')->nullable();
            $table->string('bcity')->nullable();
            $table->string('bcode')->nullable();
            $table->string('bcountry')->nullable();
            $table->string('bdetailstatus')->nullable();
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
        Schema::dropIfExists('brands');
    }
};
