<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// models
use App\Models\User;
use App\Models\Company;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
