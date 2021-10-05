<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Transaction extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'transactions';

    protected $guarded = ['id'];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
