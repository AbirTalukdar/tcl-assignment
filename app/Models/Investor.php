<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'address',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
    
}
