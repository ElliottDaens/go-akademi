<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'date_naissance',
        'discipline',
        'niveau',
        'message',
        'accord_reglement',
        'traitee',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'accord_reglement' => 'boolean',
        'traitee' => 'boolean',
    ];

    public function getDisciplineLabelAttribute(): string
    {
        return match ($this->discipline) {
            'jjb'         => 'Jiu-Jitsu Brésilien',
            'kosen_judo'  => 'Kosen Judo',
            'luta_livre'  => 'Luta Livre',
            default       => 'Indifférent',
        };
    }

    public function getNiveauLabelAttribute(): string
    {
        return match ($this->niveau) {
            'debutant'      => 'Débutant',
            'intermediaire' => 'Intermédiaire',
            'avance'        => 'Avancé',
            default         => 'Débutant',
        };
    }
}
