<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Encadrant;
use App\Models\Horaire;
use App\Models\Image;
use App\Models\Lieu;
use App\Models\SiteSetting;
use App\Models\Tarif;

class PageController extends Controller
{
    private function s(string $key, string $default = ''): string
    {
        return SiteSetting::get($key, $default);
    }

    private function img(string $key, string $fallback): string
    {
        return Image::getPath($key) ?? asset($fallback);
    }

    public function accueil()
    {
        return view('accueil', [
            'badge' => $this->s('accueil_badge', 'ACJB ET KJC'),
            'heroTitre' => $this->s('accueil_hero_titre', "L'Union parfaite par la"),
            'heroTitreAccent' => $this->s('accueil_hero_titre_accent', 'perfection'),
            'heroSoustitre' => $this->s('accueil_hero_soustitre', 'Le Jiu Jitsu Brésilien (JJB) est un art martial, un système de défense personnel et un sport de combat. Libre à chacun de choisir son domaine d\'expression sportif, mais sur notre tatami, tous les genres se rejoignent.'),
            'disciplines' => $this->s('accueil_disciplines', 'JUDO · LUTTE · JIU JITSU BRÉSILIEN · GRAPPLING · MMA'),
            'introTitre' => $this->s('intro_titre', 'Bienvenue sur le site de la GoAKADEMI'),
            'introTexte' => $this->s('intro_texte'),
            'ctaTexte' => $this->s('accueil_cta_texte', 'Sur le tatami, tous les genres se rejoignent'),
            'heroImage' => $this->img('hero_accueil', 'images/Post 15-02.png'),
            'ctaImage' => $this->img('cta_bande', 'images/jonathan-borba-Yf1SegAI84o-unsplash.jpg'),
            'encadrants' => Encadrant::orderBy('ordre')->get(),
            'siteName' => $this->s('site_nom', 'Go Akadémi'),
        ]);
    }

    public function presentation()
    {
        return view('presentation', [
            'encadrants' => Encadrant::orderBy('ordre')->get(),
            'heroImage' => $this->img('hero_presentation', 'images/cesar-millan-xzDhuWLfOi4-unsplash.jpg'),
            'jjbImage' => $this->img('jjb_section', 'images/Post 15-02 (3).png'),
            'jjbTitre' => $this->s('presentation_jjb_titre', 'Le Jiu Jitsu Brésilien, c\'est quoi ?'),
            'jjbSoustitre' => $this->s('presentation_jjb_soustitre', 'et se défendre.'),
            'jjbTexte1' => $this->s('presentation_jjb_texte1', 'Le jiu jitsu brésilien (JJB) associe le judo et la lutte dans sa phase debout. L\'activité principale se concentre au sol où il s\'agit de prendre une position dominante pour contrôler, soumettre par clé ou étrangler son adversaire.'),
            'jjbTexte2' => $this->s('presentation_jjb_texte2', 'C\'est en 1904 que MAEDA, disciple de JIGORO KANO, part pour le continent américain. Il finit par poser ses valises au Brésil en 1917 où il se lie à une riche famille : les GRACIE. Ces derniers suivront dès lors l\'enseignement de MAEDA jusqu\'à ouvrir leur propre école tout en définissant leur propre style.'),
            'essorTitre' => $this->s('presentation_essor_titre', 'Système de défense'),
            'essorTexte' => $this->s('presentation_essor_texte', 'Le JJB est très populaire au Brésil, aux États-Unis, au Japon et prend de l\'ampleur en Europe. L\'une des raisons tient au développement du combat libre (Mixed Martial Arts).'),
            'cultureTitre' => $this->s('presentation_culture_titre', 'Pourquoi la Go Akadémi ?'),
            'cultureTexte1' => $this->s('presentation_culture_texte1', 'Une vitrine très JJB, dont nous reprenons la culture et ses codes. Pourtant, cette académie sent bon le Japon : GO ! Ce chiffre cinq, et sa symbolique bouddhique, a toutes les vertus que nous recherchons. Nombre de la perfection, il est aussi symbole d\'union et de force.'),
            'cultureTexte2' => $this->s('presentation_culture_texte2', 'C\'est l\'union des trois arts martiaux que nous mettons en avant au sein de nos clubs, l\'ACJB et le KJC, où sont invités à se côtoyer et s\'enrichir de leur spécificité les pratiquants de tout bord.'),
        ]);
    }

    public function entrainements()
    {
        return view('entrainements', [
            'horaires' => Horaire::orderBy('ordre')->get(),
            'lieux' => Lieu::orderBy('ordre')->get(),
            'heroImage' => $this->img('hero_entrainements', 'images/Post 15-02 (1).png'),
            'programmeImage' => $this->img('programme_section', 'images/cesar-millan-F2PTHpyMGGY-unsplash.jpg'),
            'intro' => $this->s('entrainements_intro', 'Tous nos entraînements sont assurés par des professeurs diplômés d\'état (DEJEPS Judo-ju-jitsu, CQP, F2 Lutte).'),
            'programmeTitre' => $this->s('entrainements_programme_titre', 'Au programme'),
            'programmeTexte1' => $this->s('entrainements_programme_texte1', 'Les cours sont adaptés suivant votre niveau et vos objectifs. Projeter, contrôler et soumettre.'),
            'programmeTexte2' => $this->s('entrainements_programme_texte2', 'Dès la première séance, l\'adrénaline du combat s\'associe à une activité de stratège.'),
            'programmeTexte3' => $this->s('entrainements_programme_texte3', 'Nos encadrants cumulent à eux 3 près de 140 années de tatamis !'),
        ]);
    }

    public function rejoindre()
    {
        return view('rejoindre', [
            'tarifs' => Tarif::orderBy('ordre')->get(),
            'heroImage' => $this->img('hero_rejoindre', 'images/Post 15-02 (2).png'),
            'inscriptionTexte1' => $this->s('rejoindre_inscription_texte1', 'Les cours de JJB débutent à partir de 14 ans.'),
            'inscriptionTexte2' => $this->s('rejoindre_inscription_texte2', 'Le coût global couvre la cotisation club, l\'assurance et la licence CFJJB. Possibilité de licence FFJDA pour le circuit Ne Waza et le passage de grades judo.'),
            'inscriptionTexte3' => $this->s('rejoindre_inscription_texte3', 'Chaque adhérent s\'engage à respecter le règlement et engage sa responsabilité vis-à-vis de ses partenaires.'),
        ]);
    }

    public function actualites()
    {
        return view('actualites', [
            'articles' => Article::where('publie', true)->orderBy('date_publication', 'desc')->get(),
            'heroImage' => $this->img('hero_actualites', 'images/Post 15-02 (3).png'),
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'heroImage' => $this->img('hero_contact', 'images/jonathan-borba-Yf1SegAI84o-unsplash.jpg'),
            'adresse' => $this->s('contact_adresse', '62100 Calais'),
            'telephone' => $this->s('contact_telephone', '06 27 54 24 16'),
            'email' => $this->s('contact_email', 'Acjb62100@gmail.com'),
        ]);
    }
}
