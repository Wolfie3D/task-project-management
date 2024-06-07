<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'assigned_to', 'due_date', 'description', 'title'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
