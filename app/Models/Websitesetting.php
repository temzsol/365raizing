<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Websitesetting extends Model
{
    use HasFactory;
    protected $fillable=[ 'web_name','address','web_url', 'web_logo', 'web_mobile_logo', 'web_google_map', 'web_social_tink_title', 'web_social_link', 'web_phone', 'web_mobile', 'web_email', 'deleted_by', 'is_deleted', 'status', 'created_at', 'updated_at','mail_from_address', 'mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_enctype'];
}
