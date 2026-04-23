<?php

return [
    'password' => env('ADMIN_PASSWORD', 'jjb_calais'),

    'tables' => [
        'articles' => [
            'model' => \App\Models\Article::class,
            'label' => 'Articles (actualités)',
            'icon' => 'solar:document-text-linear',
            'columns' => ['titre', 'slug', 'extrait', 'image', 'categorie', 'date_publication', 'publie'],
            'file_columns' => ['image'],
        ],
        'encadrants' => [
            'model' => \App\Models\Encadrant::class,
            'label' => 'Encadrants',
            'icon' => 'solar:users-group-rounded-linear',
            'columns' => ['nom', 'role', 'photo', 'bio'],
            'file_columns' => ['photo'],
        ],
        'horaires' => [
            'model' => \App\Models\Horaire::class,
            'label' => 'Horaires',
            'icon' => 'solar:clock-circle-linear',
            'columns' => ['label', 'jour', 'heure_debut', 'heure_fin'],
        ],
        'lieux' => [
            'model' => \App\Models\Lieu::class,
            'label' => 'Lieux',
            'icon' => 'solar:map-point-linear',
            'columns' => ['nom', 'description', 'jours'],
        ],
        'tarifs' => [
            'model' => \App\Models\Tarif::class,
            'label' => 'Tarifs',
            'icon' => 'solar:tag-price-linear',
            'columns' => ['label', 'cours_essai', 'trimestre', 'annee', 'licence_ffjda'],
        ],
        'site_settings' => [
            'model' => \App\Models\SiteSetting::class,
            'label' => 'Paramètres du site',
            'icon' => 'solar:settings-linear',
            'columns' => ['cle', 'valeur'],
        ],
        'contact_messages' => [
            'model' => \App\Models\ContactMessage::class,
            'label' => 'Messages contact',
            'icon' => 'solar:letter-linear',
            'columns' => ['nom', 'email', 'sujet', 'message', 'lu'],
        ],
        'images' => [
            'model' => \App\Models\Image::class,
            'label' => 'Images',
            'icon' => 'solar:gallery-minimalistic-linear',
            'columns' => ['cle', 'fichier', 'alt', 'taille_recommandee'],
            'file_columns' => ['fichier'],
        ],
        'inscriptions' => [
            'model' => \App\Models\Inscription::class,
            'label' => 'Demandes d\'inscription',
            'icon' => 'solar:user-plus-linear',
            'columns' => ['nom', 'prenom', 'email', 'telephone', 'discipline', 'niveau', 'traitee', 'created_at'],
        ],
    ],

    'pages' => [
        'accueil' => [
            'label' => 'Page d\'accueil',
            'icon' => 'solar:home-2-linear',
            'settings' => [
                'accueil_badge' => ['label' => 'Badge (ex: ACJB ET KJC)', 'type' => 'text'],
                'accueil_hero_titre' => ['label' => 'Titre principal du Hero', 'type' => 'text'],
                'accueil_hero_titre_accent' => ['label' => 'Mot en rouge dans le titre', 'type' => 'text'],
                'accueil_hero_soustitre' => ['label' => 'Sous-titre du Hero', 'type' => 'textarea'],
                'accueil_disciplines' => ['label' => 'Bande disciplines (séparées par ·)', 'type' => 'text'],
                'intro_titre' => ['label' => 'Titre section intro', 'type' => 'text'],
                'intro_texte' => ['label' => 'Texte section intro', 'type' => 'textarea'],
                'accueil_cta_texte' => ['label' => 'Texte bande CTA', 'type' => 'text'],
            ],
            'images' => ['hero_accueil', 'carte_entrainements', 'carte_rejoindre', 'carte_contact', 'cta_bande'],
        ],
        'presentation' => [
            'label' => 'Présentation / L\'Académie',
            'icon' => 'solar:shield-check-linear',
            'settings' => [
                'presentation_jjb_titre' => ['label' => 'Titre section JJB', 'type' => 'text'],
                'presentation_jjb_soustitre' => ['label' => 'Sous-titre section JJB', 'type' => 'text'],
                'presentation_jjb_texte1' => ['label' => 'Texte JJB paragraphe 1', 'type' => 'textarea'],
                'presentation_jjb_texte2' => ['label' => 'Texte JJB paragraphe 2', 'type' => 'textarea'],
                'presentation_essor_titre' => ['label' => 'Titre section Essor', 'type' => 'text'],
                'presentation_essor_texte' => ['label' => 'Texte section Essor', 'type' => 'textarea'],
                'presentation_culture_titre' => ['label' => 'Titre section Culture GO', 'type' => 'text'],
                'presentation_culture_texte1' => ['label' => 'Texte Culture paragraphe 1', 'type' => 'textarea'],
                'presentation_culture_texte2' => ['label' => 'Texte Culture paragraphe 2', 'type' => 'textarea'],
            ],
            'images' => ['hero_presentation', 'jjb_section'],
        ],
        'entrainements' => [
            'label' => 'Entraînements',
            'icon' => 'solar:bolt-linear',
            'settings' => [
                'entrainements_intro' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                'entrainements_programme_titre' => ['label' => 'Titre section programme', 'type' => 'text'],
                'entrainements_programme_texte1' => ['label' => 'Programme paragraphe 1', 'type' => 'textarea'],
                'entrainements_programme_texte2' => ['label' => 'Programme paragraphe 2', 'type' => 'textarea'],
                'entrainements_programme_texte3' => ['label' => 'Programme paragraphe 3', 'type' => 'textarea'],
            ],
            'images' => ['hero_entrainements', 'programme_section'],
        ],
        'rejoindre' => [
            'label' => 'Nous rejoindre',
            'icon' => 'solar:hand-stars-linear',
            'settings' => [
                'rejoindre_inscription_texte1' => ['label' => 'Inscription paragraphe 1', 'type' => 'textarea'],
                'rejoindre_inscription_texte2' => ['label' => 'Inscription paragraphe 2', 'type' => 'textarea'],
                'rejoindre_inscription_texte3' => ['label' => 'Inscription paragraphe 3', 'type' => 'textarea'],
            ],
            'images' => ['hero_rejoindre'],
        ],
        'actualites' => [
            'label' => 'Actualités',
            'icon' => 'solar:document-text-linear',
            'settings' => [],
            'images' => ['hero_actualites'],
        ],
        'contact' => [
            'label' => 'Contact',
            'icon' => 'solar:phone-calling-linear',
            'settings' => [
                'contact_adresse' => ['label' => 'Adresse', 'type' => 'text'],
                'contact_telephone' => ['label' => 'Téléphone', 'type' => 'text'],
                'contact_email' => ['label' => 'Email', 'type' => 'text'],
            ],
            'images' => ['hero_contact'],
        ],
        'global' => [
            'label' => 'Paramètres globaux',
            'icon' => 'solar:settings-linear',
            'settings' => [
                'site_nom' => ['label' => 'Nom du site', 'type' => 'text'],
                'site_slogan' => ['label' => 'Slogan', 'type' => 'text'],
                'footer_description' => ['label' => 'Description footer', 'type' => 'textarea'],
                'footer_adresse' => ['label' => 'Adresse footer', 'type' => 'text'],
                'footer_telephone' => ['label' => 'Téléphone footer', 'type' => 'text'],
                'footer_email' => ['label' => 'Email footer', 'type' => 'text'],
                'instagram_url' => ['label' => 'URL Instagram', 'type' => 'text'],
                'youtube_url' => ['label' => 'URL YouTube', 'type' => 'text'],
            ],
            'images' => ['logo_carre', 'logo_carre_blanc'],
        ],
    ],
];
