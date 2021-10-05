<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Customer extends Eloquent
{
    use HasFactory;

   protected $connection = 'mongodb';
   protected $collection = 'customers';
   protected $guarded = [];
   protected $primaryKey = '_id';
   protected $dates = ['created_at'];

   public function transactions()
   {
       return $this->hasMany(Transaction::class);
   }
}
