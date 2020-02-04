<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $table ="contacts";
       protected  $fillable=['name','phone','email', 'address', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
