<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'created_by', 'due_date', 'description', 'title'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}