<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model{
    use HasFactory;

    protected $primaryKey='income_id';

    public function categoryInfo(){
        return $this->belongsTo('App\Models\IncomeCategory','incate_id','incate_id');
    }
}
