<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    //contactsテーブルと1:多
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }
}
