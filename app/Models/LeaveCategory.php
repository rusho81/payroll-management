<?php

namespace App\Models;

use App\Models\LeaveRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_name'];

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

   
}
