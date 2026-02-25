<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $table = 'niveaux';
    
    protected $fillable = [
        'type',
        'description'
    ];
    
    // Alias pour la compatibilité avec le code existant
    public function getCodeNAttribute()
    {
        return $this->type;
    }
    
    public function setCodeNAttribute($value)
    {
        $this->attributes['type'] = $value;
    }
    
    public function getLibelleNAttribute()
    {
        return $this->description;
    }
    
    public function setLibelleNAttribute($value)
    {
        $this->attributes['description'] = $value;
    }
    
    public function filieres()
    {
        return $this->hasMany(Filiere::class, 'niveau_id');
    }
    
    public function diplomes()
    {
        return $this->hasMany(Diplome::class);
    }
}
