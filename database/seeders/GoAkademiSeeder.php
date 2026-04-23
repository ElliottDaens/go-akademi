<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Encadrant;
use App\Models\Horaire;
use App\Models\Image;
use App\Models\Lieu;
use App\Models\SiteSetting;
use App\Models\Tarif;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoAkademiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('articles')->truncate();
        DB::table('encadrants')->truncate();
        DB::table('horaires')->truncate();
        DB::table('lieux')->truncate();
        DB::table('tarifs')->truncate();
        DB::table('images')->truncate();

        // --- Global ---
        SiteSetting::set('site_nom', 'Go Akadémi');
        SiteSetting::set('site_slogan', "L'Union fait la force");
        SiteSetting::set('footer_description', "Le Jiu Jitsu Brésilien (JJB) : art martial, système de défense personnel et sport de combat. L'union par la perfection et la force.");
        SiteSetting::set('footer_adresse', '62100 Calais');
        SiteSetting::set('footer_telephone', '06 27 54 24 16');
        SiteSetting::set('footer_email', 'Acjb62100@gmail.com');
        SiteSetting::set('instagram_url', '#');
        SiteSetting::set('youtube_url', '#');

        // --- Accueil ---
        SiteSetting::set('accueil_badge', 'ACJB · KOSEN JUDO · LUTA LIVRE');
        SiteSetting::set('accueil_hero_titre', "L'Union parfaite par la");
        SiteSetting::set('accueil_hero_titre_accent', 'perfection');
        SiteSetting::set('accueil_hero_soustitre', "Le Jiu Jitsu Brésilien (JJB) est un art martial, un système de défense personnel et un sport de combat. Libre à chacun de choisir son domaine d'expression sportif, mais sur notre tatami, tous les genres se rejoignent.");
        SiteSetting::set('accueil_disciplines', 'JUDO · LUTTE · JIU JITSU BRÉSILIEN · GRAPPLING · MMA');
        SiteSetting::set('intro_titre', 'Bienvenue sur le site de la GoAKADEMI');
        SiteSetting::set('intro_texte', "La GoAkademi vous accueille pour pratiquer les arts du combats au sol où JJB, Kosen-judo et Luta Livre se rejoignent. Il semble que les associer ne soit pas du goût de tout le monde. Nous avons une autre vision qui consiste à nous enrichir de nos différences et à nous retrouver sur ce qui nous rassemble.");
        SiteSetting::set('accueil_cta_texte', 'Sur le tatami, tous les genres se rejoignent');

        // --- Présentation ---
        SiteSetting::set('presentation_jjb_titre', "Le Jiu Jitsu Brésilien, c'est quoi ?");
        SiteSetting::set('presentation_jjb_soustitre', 'et se défendre.');
        SiteSetting::set('presentation_jjb_texte1', "Le jiu jitsu brésilien (JJB) est un art martial, un système de défense personnel et un sport de combat. Il associe le judo et la lutte dans sa phase debout. L'activité principale se concentre au sol où il s'agit de prendre une position dominante pour contrôler, soumettre par clé ou étrangler son adversaire.");
        SiteSetting::set('presentation_jjb_texte2', "C'est en 1904 que MAEDA, disciple de JIGORO KANO, fondateur du Judo, part pour le continent américain. Il finit par poser ses valises au Brésil en 1917 où il se lie à une riche famille : les GRACIE. Ces derniers suivront dès lors l'enseignement de MAEDA jusqu'à ouvrir leur propre école tout en définissant leur propre style.");
        SiteSetting::set('presentation_essor_titre', 'Système de défense');
        SiteSetting::set('presentation_essor_texte', "Le JJB est très populaire au Brésil, aux États-Unis, au Japon et prend de l'ampleur en Europe. L'une des raisons tient au développement du combat libre (Mixed Martial Arts).");
        SiteSetting::set('presentation_culture_titre', 'Pourquoi la Go Akadémi ?');
        SiteSetting::set('presentation_culture_texte1', "Une vitrine très JJB, dont nous reprenons la culture et ses codes. Pourtant, cette académie sent bon le Japon : GO ! Ce chiffre cinq, et sa symbolique bouddhique, a toutes les vertus que nous recherchons. Nombre de la perfection, il est aussi symbole d'union et de force.");
        SiteSetting::set('presentation_culture_texte2', "C'est l'union des trois arts martiaux que nous mettons en avant au sein de nos clubs où sont invités à se côtoyer et s'enrichir de leur spécificité les pratiquants de tout bord. Libre à chacun de choisir son domaine d'expression, mais poursuivre chacun de son côté n'a plus de sens.");

        // --- Entraînements ---
        SiteSetting::set('entrainements_intro', "Tous nos entraînements sont assurés par des professeurs diplômés d'état (DEJEPS Judo-ju-jitsu, CQP, F2 Lutte).");
        SiteSetting::set('entrainements_programme_titre', 'Au programme');
        SiteSetting::set('entrainements_programme_texte1', "Les cours sont adaptés suivant votre niveau et vos objectifs. Néanmoins les bases de chacune des spécialités sont abordées de sorte que nos pratiquants puissent s'exprimer. Projeter, contrôler et soumettre.");
        SiteSetting::set('entrainements_programme_texte2', "La pratique du JJB / Kosen Judo permet de mettre en place une pédagogie où l'on peut très rapidement mettre des débutants dans une situation de combattants. Dès la première séance l'adrénaline du combat s'associe à une activité de stratège.");
        SiteSetting::set('entrainements_programme_texte3', "Nos encadrants : à eux 3 ils cumulent près de 140 années de tatamis dont plus de 100 consacrées à l'enseignement !");

        // --- Rejoindre ---
        SiteSetting::set('rejoindre_inscription_texte1', 'Les cours de JJB débutent à partir de 14 ans.');
        SiteSetting::set('rejoindre_inscription_texte2', "Le coût global de l'inscription à l'année couvre la cotisation club, l'assurance et la prise de licence auprès de la CFJJB. Il est possible de prendre votre licence auprès de la FFJDA pour ceux et celles qui souhaitent participer au circuit Ne Waza et passer leur grade judo.");
        SiteSetting::set('rejoindre_inscription_texte3', "Le rapprochement de la CFJJB et de FRANCE JUDO peut vous amener à prendre 2 licences. Chaque adhérent s'engage à respecter le règlement et engage sa responsabilité vis-à-vis de ses partenaires.");

        // --- Contact ---
        SiteSetting::set('contact_adresse', '62100 Calais');
        SiteSetting::set('contact_telephone', '06 27 54 24 16');
        SiteSetting::set('contact_email', 'Acjb62100@gmail.com');

        Article::insert([
            [
                'titre' => 'Les 13 / 15 ans ont enfin leur créneau',
                'slug' => 'les-13-15-ans-ont-enfin-leur-creneau',
                'extrait' => 'Les 13 / 15 ans peuvent désormais nous rejoindre. Judokas, lutteurs et autres jeunes motivés par les arts martiaux peuvent se rejoindre au sein d\'un même sport de combat qui développera leurs qualités de stratège.',
                'contenu' => null, 'image' => null,
                'categorie' => 'actu', 'date_publication' => '2021-08-31',
                'publie' => true, 'ordre' => 0,
            ],
            [
                'titre' => "Helmut nous gratifie d'une première visite",
                'slug' => 'helmut-nous-gratifie-dune-premiere-visite',
                'extrait' => 'Un mercredi 20 novembre… comme un autre ? Non car ce soir Helmut a pris le cours pour une session grappling accompagné de Fabrice.',
                'contenu' => null, 'image' => null,
                'categorie' => 'actu', 'date_publication' => '2019-11-22',
                'publie' => true, 'ordre' => 1,
            ],
            [
                'titre' => 'La saison démarre !',
                'slug' => 'la-saison-demarre',
                'extrait' => 'Nouvelle saison, nouvelle énergie sur les tatamis.',
                'contenu' => null, 'image' => null,
                'categorie' => 'actu', 'date_publication' => '2019-09-25',
                'publie' => true, 'ordre' => 2,
            ],
        ]);

        Encadrant::insert([
            ['nom' => 'Franck Dumont', 'role' => 'encadrant_permanent', 'photo' => null,
             'bio' => "CN Judo 5ème DAN\nCeinture noire de la Riva (AAM Guy Chautard)\nVice-champion d'Europe\nMembre commission Ne Waza du comité Judo 62\nFormateur HDF\nInstructeur Power Kettlebell\nProfesseur d'EPS", 'ordre' => 0],
            ['nom' => 'Fabrice Carton', 'role' => 'intervenant_ponctuel', 'photo' => null,
             'bio' => "Ceinture noire de Judo 4ème DAN\nVice-champion de France Ne Waza\nGroupe France (Tournoi de Paris, INSEP)\nCeinture noire JJB (en attente validation)", 'ordre' => 1],
            ['nom' => 'Helmut Pfanvelt', 'role' => 'intervenant_ponctuel', 'photo' => null,
             'bio' => "Multi-titré en JJB, Ne Waza et Grappling\nDouble vainqueur Open Lisbonne CN\nChampion d'Europe JJB et Ne Waza 2018\nBF2 Lutte\nPratiquant assidu métropole lilloise et Fusen Ryu (Belgique)", 'ordre' => 2],
        ]);

        Horaire::insert([
            ['label' => 'Ados 13-15 ans', 'jour' => 'Lundi', 'heure_debut' => '18h', 'heure_fin' => '19h30', 'ordre' => 0],
            ['label' => '15 ans et +', 'jour' => 'Lundi', 'heure_debut' => '19h30', 'heure_fin' => '21h', 'ordre' => 1],
            ['label' => 'Adultes', 'jour' => 'Jeudi', 'heure_debut' => '19h30', 'heure_fin' => '21h', 'ordre' => 2],
            ['label' => 'Open Mat', 'jour' => 'Dimanche', 'heure_debut' => '10h', 'heure_fin' => '12h', 'ordre' => 3],
        ]);

        Lieu::insert([
            ['nom' => 'Calais — Complexe Coubertin', 'description' => 'Lundi et jeudi · Salle de combat du complexe sportif de Coubertin à Calais. Notre dojo principal.', 'jours' => 'Lundi et jeudi', 'ordre' => 0],
            ['nom' => 'Oye-Plage — Collège les Argousiers', 'description' => "Dimanche matin · Dojo de Oye-Plage, notre « chez nous » ! Accès libre, matériel haut de gamme (salle de Crossfit), lieu de convivialité.", 'jours' => 'Dimanche', 'ordre' => 1],
        ]);

        Tarif::insert([
            ['categorie' => '19_ans_plus', 'label' => '19 ans et +', 'cours_essai' => 'Gratuit', 'trimestre' => '80€ + 41€ licence CFJJB', 'annee' => '200€ (ou 2 chèques)', 'licence_ffjda' => '+ 41€', 'ordre' => 0],
            ['categorie' => '14_18_etudiants', 'label' => '14-18 ans et étudiants', 'cours_essai' => 'Gratuit', 'trimestre' => '80€ + 41€ licence CFJJB', 'annee' => '180€ (ou 2 chèques)', 'licence_ffjda' => '+ 41€', 'ordre' => 1],
        ]);

        Image::insert([
            ['cle' => 'hero_accueil', 'fichier' => 'Post 15-02.png', 'alt' => 'Go Akademi', 'taille_recommandee' => '1920x1080'],
            ['cle' => 'hero_presentation', 'fichier' => 'cesar-millan-xzDhuWLfOi4-unsplash.jpg', 'alt' => "L'Académie", 'taille_recommandee' => '1920x720'],
            ['cle' => 'hero_entrainements', 'fichier' => 'Post 15-02 (1).png', 'alt' => 'Entraînements', 'taille_recommandee' => '1920x720'],
            ['cle' => 'hero_rejoindre', 'fichier' => 'Post 15-02 (2).png', 'alt' => 'Rejoindre', 'taille_recommandee' => '1920x720'],
            ['cle' => 'hero_actualites', 'fichier' => 'Post 15-02 (3).png', 'alt' => 'Actualités', 'taille_recommandee' => '1920x720'],
            ['cle' => 'hero_contact', 'fichier' => 'jonathan-borba-Yf1SegAI84o-unsplash.jpg', 'alt' => 'Contact', 'taille_recommandee' => '1920x720'],
            ['cle' => 'carte_entrainements', 'fichier' => 'Post 15-02 (1).png', 'alt' => 'Entraînements', 'taille_recommandee' => '800x600'],
            ['cle' => 'carte_rejoindre', 'fichier' => 'Post 15-02 (2).png', 'alt' => 'Rejoindre', 'taille_recommandee' => '800x600'],
            ['cle' => 'carte_contact', 'fichier' => 'cesar-millan-F2PTHpyMGGY-unsplash.jpg', 'alt' => 'Contact', 'taille_recommandee' => '800x600'],
            ['cle' => 'cta_bande', 'fichier' => 'jonathan-borba-Yf1SegAI84o-unsplash.jpg', 'alt' => 'BJJ', 'taille_recommandee' => '1920x600'],
            ['cle' => 'jjb_section', 'fichier' => 'Post 15-02 (3).png', 'alt' => 'JJB', 'taille_recommandee' => '1024x768'],
            ['cle' => 'programme_section', 'fichier' => 'cesar-millan-F2PTHpyMGGY-unsplash.jpg', 'alt' => 'BJJ', 'taille_recommandee' => '800x600'],
            ['cle' => 'logo_carre', 'fichier' => 'Logo carré.png', 'alt' => 'Go Akademi', 'taille_recommandee' => '256x256'],
            ['cle' => 'logo_carre_blanc', 'fichier' => 'Logo carré blanc.png', 'alt' => 'Go Akademi', 'taille_recommandee' => '256x256'],
        ]);
    }
}
