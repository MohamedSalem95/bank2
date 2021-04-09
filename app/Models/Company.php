<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// models
use App\Models\User;
use App\Models\Group;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact_person', 'contact_name', 'address'];

    // belongs to user
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function groups() {
        return $this->hasMany(Group::class);
    }
}
