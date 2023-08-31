<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'allowed_leave', 'balance'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
