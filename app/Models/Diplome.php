<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diplome extends Model
{
    protected $table = 'diplomes';
    
    protected $fillable = [
        'type',
        'dateObtention',
        'dateRemise',
        'mention',
        'reference',
        'specialite',
        'sujetMemoire',
        'encadreur',
        'sujetThese',
        'directeurThese',
        'laboratoire',
        'mentionSpeciale',
        'etudiant_id',
        'niveau_id'
    ];
    
    // Constantes pour les types de diplômes
    const TYPE_LICENCE = 'Licence';
    const TYPE_MASTER = 'Master';
    const TYPE_DOCTORAT = 'Doctorat';
    
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
    
    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
    
    /**
     * Obtient les professions associées à ce diplôme.
     */
    public function professions(): HasMany
    {
        return $this->hasMany(Profession::class);
    }
    
    /**
     * Détermine si le diplôme est de type Licence
     *
     * @return bool
     */
    public function isLicence()
    {
        return $this->type === self::TYPE_LICENCE;
    }
    
    /**
     * Détermine si le diplôme est de type Master
     *
     * @return bool
     */
    public function isMaster()
    {
        return $this->type === self::TYPE_MASTER;
    }
    
    /**
     * Détermine si le diplôme est de type Doctorat
     *
     * @return bool
     */
    public function isDoctorat()
    {
        return $this->type === self::TYPE_DOCTORAT;
    }
    
    /**
     * Retourne les champs spécifiques selon le type de diplôme
     *
     * @return array
     */
    public function getSpecificFields()
    {
        $fields = [
            'reference' => $this->reference,
            'specialite' => $this->specialite,
            'dateObtention' => $this->dateObtention,
            'dateRemise' => $this->dateRemise,
            'mention' => $this->mention,
        ];
        
        if ($this->isLicence()) {
            $fields['sujetMemoire'] = $this->sujetMemoire;
            $fields['encadreur'] = $this->encadreur;
        } elseif ($this->isMaster()) {
            $fields['sujetMemoire'] = $this->sujetMemoire;
            $fields['encadreur'] = $this->encadreur;
            $fields['mentionSpeciale'] = $this->mentionSpeciale;
        } elseif ($this->isDoctorat()) {
            $fields['sujetThese'] = $this->sujetThese;
            $fields['directeurThese'] = $this->directeurThese;
            $fields['laboratoire'] = $this->laboratoire;
            $fields['mentionSpeciale'] = $this->mentionSpeciale;
        }
        
        return $fields;
    }
}
