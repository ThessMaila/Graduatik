<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profession extends Model
{
    use HasFactory;
    
    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'poste',
        'structure',
        'dateDebut',
        'dateFin',
        'description',
        'diplome_id',
        'etudiant_id',
    ];
    public const TYPES = ['Stage', 'Emploi', 'Alternance', 'Volontariat', 'Autre'];
    
    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dateDebut' => 'date',
        'dateFin' => 'date',
    ];
    
    /**
     * Obtient le diplôme associé à cette profession.
     */
    public function diplome(): BelongsTo
    {
        return $this->belongsTo(Diplome::class);
    }

    /**
     * Obtient l'étudiant associé à cette profession.
     */
    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }
    
    /**
     * Détermine si la profession est en cours.
     *
     * @return bool
     */
    public function isEnCours(): bool
    {
        return is_null($this->dateFin);
    }
}
