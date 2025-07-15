<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',         // Assignee
        'assigned_by', 
        'title',
        'description',
        'status',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

  
    public function assignee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
