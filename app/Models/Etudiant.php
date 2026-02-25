<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Authenticatable
{
    use Notifiable;
    protected $table = 'etudiants';
    
    protected $fillable = [
        'nom',
        'prenom',
        'ine',
        'email',
        'dateNaissance',
        'lieuNaissance',
        'telephone',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
    
    public function diplomes()
    {
        return $this->hasMany(Diplome::class);
    }

    public function professions()
    {
        return $this->hasMany(Profession::class);
    }
    
    public function integrations()
    {
        return $this->hasMany(Integration::class);
    }
    
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'integrations', 'etudiant_id', 'promotion_id')
                    ->withPivot('dateIntegration')
                    ->withTimestamps();
    }
    
    // La relation avec les matériels a été supprimée conformément au MCD
    
    public function concerners()
    {
        return $this->hasMany(Concerner::class);
    }
}
