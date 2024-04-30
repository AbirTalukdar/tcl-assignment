<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashInvestment extends Model
{

    use HasFactory;
    protected $table ='cash_investments';
    protected $primaryKey='id';
    public $timestamps = true;

    protected $fillable = [
        'clientId',
        'projectId',
        'amount',
        'invest_date',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class, 'projectId');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'clientId');
    }
}
