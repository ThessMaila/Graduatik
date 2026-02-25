<?php

namespace App\Policies;

use App\Models\Etudiant;
use App\Models\Profession;

class ProfessionPolicy
{
    /**
     * Determine if the given profession can be updated by the etudiant.
     */
    public function update(Etudiant $etudiant, Profession $profession)
    {
        return $profession->etudiant_id === $etudiant->id;
    }
}
