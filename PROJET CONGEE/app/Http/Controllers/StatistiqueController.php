<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistiqueController extends Controller
{
    public function getListeAnnees()
    {
        $annees = DB::table('v_depenses')
            ->selectRaw('EXTRACT(YEAR FROM datedepense) AS annee')
            ->where('etatsup', 0)
            ->groupBy('annee')
            ->orderBy('annee', 'asc')
            ->pluck('annee');

        return $annees;
    }

    public function DepenseParMois(Request $request)
    {
        // Récupérer les années distinctes des dépenses
        $annees = $this->getListeAnnees();

        // Récupérer l'année sélectionnée dans le formulaire de filtrage
        $anneeFiltre = $request->input('annee');

        // Récupérer les dépenses par mois et par année filtrée
        $query = DB::table('v_depenses')
            ->selectRaw('EXTRACT(MONTH FROM datedepense) AS mois, EXTRACT(YEAR FROM datedepense) AS annee, SUM(montant_total) AS montant_total')
            ->where('etatsup', 0)
            ->groupBy('mois', 'annee')
            ->orderBy('annee', 'asc')
            ->orderBy('mois', 'asc');

        // Appliquer le filtre par année si une année est sélectionnée
        if ($anneeFiltre) {
            $query->whereYear('datedepense', $anneeFiltre);
        }

        // Exécuter la requête pour récupérer les dépenses
        $depensesParMois = $query->get();

        // Formatage des données pour le tableau de bord
        $data = [];
        foreach ($depensesParMois as $depense) {
            $mois = $depense->mois;
            $annee = $depense->annee;
            $montantTotal = $depense->montant_total;

            // Créer une clé unique pour le mois et l'année
            $key = $annee . '-' . $mois;

            // Stocker les données dans un tableau associatif
            $data[$key] = [
                'mois' => $mois,
                'annee' => $annee,
                'montant_total' => $montantTotal,
            ];
        }

        // Récupérer les dépenses totales
        $depensesTotales = $this->getDepensesTotales($anneeFiltre);

        return view('crud.statistique.TableauDepense', [
            'data' => $data,
            'annees' => $annees,
            'depensesTotales' => $depensesTotales,
            'anneeFiltre' => $anneeFiltre,
        ]);
    }

    public function getDepensesTotales($annee = null)
    {
        $query = DB::table('v_depenses')
            ->selectRaw('SUM(montant_total) AS montant_total')
            ->where('etatsup', 0);

        if ($annee) {
            $query->whereYear('datedepense', $annee);
        }

        $result = $query->first();

        return $result ? $result->montant_total : 0;
    }

    public function RecetteParMois(Request $request)
    {
        // Récupérer les années distinctes des dépenses
        $annees = $this->getListeAnnees();

        // Récupérer l'année sélectionnée dans le formulaire de filtrage
        $anneeFiltre = $request->input('annee');

        // Récupérer les recettes par mois et par année filtrée
        $query = DB::table('v_detailfactures')
            ->selectRaw('EXTRACT(MONTH FROM datefacture) AS mois, EXTRACT(YEAR FROM datefacture) AS annee, SUM(tarif_total) AS recette_totale')
            ->groupBy('mois', 'annee')
            ->orderBy('annee', 'asc')
            ->orderBy('mois', 'asc');

        // Appliquer le filtre par année si une année est sélectionnée
        if ($anneeFiltre) {
            $query->whereYear('datefacture', $anneeFiltre);
        }

        // Exécuter la requête pour récupérer les recettes
        $recettesParMois = $query->get();

        // Formatage des données pour le tableau de bord
        $data = [];
        foreach ($recettesParMois as $recette) {
            $mois = $recette->mois;
            $annee = $recette->annee;
            $recetteTotale = $recette->recette_totale;

            // Créer une clé unique pour le mois et l'année
            $key = $annee . '-' . $mois;

            // Stocker les données dans un tableau associatif
            $data[$key] = [
                'mois' => $mois,
                'annee' => $annee,
                'recette_totale' => $recetteTotale,
            ];
        }

        // Récupérer les recettes totales
        $recettesTotales = $this->getRecettesTotales($anneeFiltre);

        return view('crud.statistique.TableauRecette', [
            'data' => $data,
            'annees' => $annees,
            'depensesTotales' => $this->getDepensesTotales($anneeFiltre),
            'recettesTotales' => $recettesTotales,
            'anneeFiltre' => $anneeFiltre,
        ]);
    }

    public function getRecettesTotales($annee = null)
    {
        $query = DB::table('v_detailfactures')
            ->selectRaw('SUM(tarif_total) AS recette_totale');

        if ($annee) {
            $query->whereYear('datefacture', $annee);
        }

        $result = $query->first();

        return $result ? $result->recette_totale : 0;
    }

    public function BeneficeParMois(Request $request)
{
    // Récupérer les années distinctes des dépenses
    $annees = $this->getListeAnnees();

    // Récupérer l'année sélectionnée dans le formulaire de filtrage
    $anneeFiltre = $request->input('annee');

    // Récupérer les dépenses par mois et par année filtrée
    $depensesQuery = DB::table('v_depenses')
        ->selectRaw('EXTRACT(MONTH FROM datedepense) AS mois, EXTRACT(YEAR FROM datedepense) AS annee, SUM(montant_total) AS montant_total')
        ->where('etatsup', 0)
        ->groupBy('mois', 'annee');

    // Appliquer le filtre par année si une année est sélectionnée
    if ($anneeFiltre) {
        $depensesQuery->whereYear('datedepense', $anneeFiltre);
    }

    // Exécuter la requête pour récupérer les dépenses
    $depensesParMois = $depensesQuery->get();

    // Récupérer les recettes par mois et par année filtrée
    $recettesQuery = DB::table('v_detailfactures')
        ->selectRaw('EXTRACT(MONTH FROM datefacture) AS mois, EXTRACT(YEAR FROM datefacture) AS annee, SUM(tarif_total) AS recette_totale')
        ->groupBy('mois', 'annee');

    // Appliquer le filtre par année si une année est sélectionnée
    if ($anneeFiltre) {
        $recettesQuery->whereYear('datefacture', $anneeFiltre);
    }

    // Exécuter la requête pour récupérer les recettes
    $recettesParMois = $recettesQuery->get();

    // Créer un tableau associatif pour les dépenses par mois
    $depensesData = [];
    foreach ($depensesParMois as $depense) {
        $mois = $depense->mois;
        $annee = $depense->annee;
        $montantTotal = $depense->montant_total;

        // Créer une clé unique pour le mois et l'année
        $key = $annee . '-' . $mois;

        // Stocker les données dans le tableau associatif
        $depensesData[$key] = $montantTotal;
    }

    // Créer un tableau associatif pour les recettes par mois
    $recettesData = [];
    foreach ($recettesParMois as $recette) {
        $mois = $recette->mois;
        $annee = $recette->annee;
        $recetteTotale = $recette->recette_totale;

        // Créer une clé unique pour le mois et l'année
        $key = $annee . '-' . $mois;

        // Stocker les données dans le tableau associatif
        $recettesData[$key] = $recetteTotale;
    }

    // Créer un tableau pour les bénéfices par mois
    $beneficesData = [];

    // Parcourir tous les mois et calculer les bénéfices
    foreach ($annees as $annee) {
        for ($mois = 1; $mois <= 12; $mois++) {
            // Créer une clé unique pour le mois et l'année
            $key = $annee . '-' . $mois;

            // Initialiser les valeurs de dépenses et de recettes à 0 si elles n'existent pas
            $depense = isset($depensesData[$key]) ? $depensesData[$key] : 0;
            $recette = isset($recettesData[$key]) ? $recettesData[$key] : 0;

            // Calculer le bénéfice
            $benefice = $recette - $depense;

            // Stocker les données dans le tableau des bénéfices par mois
            $beneficesData[$key] = $benefice;
        }
    }

    return view('crud.statistique.TableauBenefice', [
        'annees' => $annees,
        'depensesData' => $depensesData,
        'recettesData' => $recettesData,
        'beneficesData' => $beneficesData,
        'anneeFiltre' => $anneeFiltre,
    ]);
}


public function TableauDeBord(Request $request)
{
    $annee = $request->input('annee');
    $mois = $request->input('mois');

    // Obtenez les données filtrées pour les recettes, les dépenses et les bénéfices
    $recettes = DB::table('v_recettes')
        ->select('*')
        ->when($annee, function ($query) use ($annee) {
            return $query->where('annee', $annee);
        })
        ->when($mois, function ($query) use ($mois) {
            return $query->where('mois', $mois);
        })
        ->orderBy('annee', 'asc')
        ->orderBy('mois', 'asc')
        ->get();

    $depenses = DB::table('v_pertes')
        ->select('*')
        ->when($annee, function ($query) use ($annee) {
            return $query->where('annee', $annee);
        })
        ->when($mois, function ($query) use ($mois) {
            return $query->where('mois', $mois);
        })
        ->orderBy('annee', 'asc')
        ->orderBy('mois', 'asc')
        ->get();

    $benefices = DB::table('v_benefices')
        ->select('*')
        ->when($annee, function ($query) use ($annee) {
            return $query->where('annee', $annee);
        })
        ->when($mois, function ($query) use ($mois) {
            return $query->where('mois', $mois);
        })
        ->orderBy('annee', 'asc')
        ->orderBy('mois', 'asc')
        ->get();

    return view('crud.statistique.TableauDeBord', [
        'recettes' => $recettes,
        'depenses' => $depenses,
        'benefices' => $benefices,
    ]);
}








public function TableauDeBordBenefice(Request $request)
{
    $annee = $request->input('annee');
    $mois = $request->input('mois');
    $limit = $request->input('limit');

    // Obtenez les données filtrées pour les recettes, les dépenses et les bénéfices
   

    $benefices = DB::table('v_benefices')
        ->select('*')
        ->when($annee, function ($query) use ($annee) {
            return $query->where('annee', $annee);
        })
        ->when($mois, function ($query) use ($mois) {
            return $query->where('mois', $mois);
        })
        ->orderBy('annee', 'asc')
        ->orderBy('mois', 'asc')
        ->get();



        $beneficesT3 = DB::table('v_benefices')
        ->select('*')
        ->when($annee, function ($query) use ($annee) {
            return $query->where('annee', $annee);
        })
        ->when($mois, function ($query) use ($mois) {
            return $query->where('mois', $mois);
        })
        ->orderBy('annee', 'asc')
        ->orderBy('benefice', 'desc')
        ->limit($limit)

        ->get();

    return view('crud.statistique.TableauBeneficeTout', [
        'benefices' => $benefices,
        'beneficesT3' => $beneficesT3,
    ]);
}


}