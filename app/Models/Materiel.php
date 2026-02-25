<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    protected $table = 'materiels';
    
    protected $fillable = [
        'matricule',
        'piece',
        'structure',
        'etudiant_id'
    ];
    
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
    
    public function concerners()
    {
        return $this->hasMany(Concerner::class);
    }
    
    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'concerner', 'materiel_id', 'etudiant_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }
}
