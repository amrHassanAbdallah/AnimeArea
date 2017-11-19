<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    public function order()
    {
        return $this->belongsTo('app\Order');
    }
}
