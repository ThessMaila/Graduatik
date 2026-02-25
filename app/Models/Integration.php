<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    protected $table = 'integrations';
    
    protected $fillable = [
        'etudiant_id',
        'promotion_id',
        'dateIntegration'
    ];
    
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
    
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
