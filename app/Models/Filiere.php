<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $table = 'filieres';
    
    protected $fillable = [
        'codeF',
        'nomF',
        'niveau_id'
    ];
    
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
    
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
