<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['bill_id', 'email', 'token', 'status'];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
