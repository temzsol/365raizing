<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable=['compname', 'compbrand', 'compemail', 'compmob', 'compstreet', 'compcity', 'compcode', 'compcountry', 'cgst', 'gst_location', 'gst_file', 'cpan', 'tan', 'mca', 'billing_address', 'billing_address_location', 'head_office_address', 'web_link', 'created_at', 'updated_at','status'];
}
