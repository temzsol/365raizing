<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsitesettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websitesettings', function (Blueprint $table) {
            $table->id();
            $table->string('web_name')->nullable();
            $table->string('web_url')->nullable();
            $table->string('web_logo')->nullable();
            $table->string('web_mobile_logo')->nullable();
            $table->mediumtext('web_google_map')->nullable();
            $table->mediumtext('web_social_tink_title')->nullable();
            $table->mediumtext('web_social_link')->nullable();
            $table->string('web_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('web_mobile')->nullable();
            $table->string('web_email')->nullable();
            $table->string('subscriber_mail_send')->nullable();
            $table->tinyInteger('deleted_by')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
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
        Schema::dropIfExists('websitesettings');
    }
}
