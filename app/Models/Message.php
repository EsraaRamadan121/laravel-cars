<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
   use HasFactory ;
    protected $fillable = [
        'Firstname',
        'Lastname',
        'Emailaddress',
        'content',
    ];
     public function isRead()
    {
        return $this->read;
    }
    
}



