<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['bill_id', 'user_id', 'email', 'amount_due', 'status'];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
