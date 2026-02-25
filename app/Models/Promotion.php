<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    
    protected $fillable = [
        'idPromotion',
        'anneeDebut',
        'anneeFin',
        'filiere_id'
    ];
    
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }
    
    public function integrations()
    {
        return $this->hasMany(Integration::class);
    }
    
    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'integrations', 'promotion_id', 'etudiant_id')
                    ->withPivot('dateIntegration')
                    ->withTimestamps();
    }
}
