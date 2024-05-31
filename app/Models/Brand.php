<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable=['bname', 'bcomp', 'bdivision', 'div_mail', 'div_mob', 'bemail', 'bmob', 'bstreet', 'bcity', 'bcode', 'bcountry', 'bdetailstatus', 'created_at', 'update_at','status'];
}
