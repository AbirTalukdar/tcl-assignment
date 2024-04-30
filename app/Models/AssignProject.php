<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignProject extends Model
{

    use HasFactory;
    protected $table ='client_assign_project';
    protected $primaryKey='id';
    public $timestamps = true;

    protected $fillable = [
        'projectId',
        'clientId',
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'projectId');
    }
    
    public function client()
    {
        return $this->belongsTo('App\Models\User', 'clientId');
    }
}
