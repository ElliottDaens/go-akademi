<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function show()
    {
        return view('inscription');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'              => ['required', 'string', 'max:100'],
            'prenom'           => ['required', 'string', 'max:100'],
            'email'            => ['required', 'email', 'max:255'],
            'telephone'        => ['nullable', 'string', 'max:20'],
            'date_naissance'   => ['nullable', 'date', 'before:today'],
            'discipline'       => ['required', 'in:jjb,kosen_judo,luta_livre,indifferent'],
            'niveau'           => ['required', 'in:debutant,intermediaire,avance'],
            'message'          => ['nullable', 'string', 'max:1000'],
            'accord_reglement' => ['required', 'accepted'],
        ], [
            'nom.required'              => 'Le nom est obligatoire.',
            'prenom.required'           => 'Le prénom est obligatoire.',
            'email.required'            => 'L\'adresse e-mail est obligatoire.',
            'email.email'               => 'L\'adresse e-mail n\'est pas valide.',
            'discipline.required'       => 'Veuillez choisir une discipline.',
            'niveau.required'           => 'Veuillez indiquer votre niveau.',
            'accord_reglement.required' => 'Vous devez accepter le règlement pour continuer.',
            'accord_reglement.accepted' => 'Vous devez accepter le règlement pour continuer.',
        ]);

        Inscription::create($validated);

        return redirect()->route('inscription')
            ->with('success', 'Votre demande d\'inscription a bien été enregistrée ! Nous vous contacterons très prochainement.');
    }
}
