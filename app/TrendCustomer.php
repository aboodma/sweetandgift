<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrendCustomer extends Model
{
  public function user()
  {
      return $this->belongsTo(User::class);
  }
}
