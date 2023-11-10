<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\depense;
use App\typedepense;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Cache;
use DateTime;

class DepenseController extends Controller
{
    public function AjoutDepense()
    {
        $typedepense = typedepense::all();  
        return view('crud/depense/AjoutDepense', [
            'typedepense' => $typedepense,
        ]);
    }
    
    public function UpdateDepense()
    {
        $typedepense = typedepense::all();
        $depense = DB::table('v_depenses')->where('iddepense', request('id'))->first();
        return view("crud/depense/UpdateDepense", [
            'depense' => $depense,
            'typedepense' => $typedepense,
        ]);
    }
    
    public function ListeDepense()
{
    $listeDepense = DB::table('v_depenses')->where('etatsup', 0)->orderBy("iddepense", "asc")->get();

    // Calcul du montant total de toutes les dépenses
    $montantTotalToutesDepenses = DB::table('v_depenses')->where('etatsup', 0)->sum(DB::raw('quantite * montant'));

    return view('crud/depense/ListeDepense', [
        'listeDepense' => $listeDepense,
        'montantTotalToutesDepenses' => $montantTotalToutesDepenses,
    ]);
}


    
    public function Delete_DEPENSE()
    {
       $id = depense::find(request('id'));
       $id->update([
           'etatsup' => 1
       ]);
       return redirect("ListeDepense")->with('suppression', 'Suppression avec succès !');
    }
   
    
    public function Ajout_DEPENSE(Request $request)
{
    $data = $request->all();
    $moisSelectionnes = $request->input('mois', []);

    $listeerreur = []; // Tableau pour stocker les dates invalides

    foreach ($moisSelectionnes as $mois) {
        $annee = $data['annee'];
        $jour = $data['jour'];

        // Vérifier si le mois est février
        if ($mois == 2) {
            // Vérifier si l'année est bissextile
            if (($annee % 4 == 0 && $annee % 100 != 0) || $annee % 400 == 0) {
                // L'année est bissextile, le jour maximum est 29
                $jourMax = 29;
            } else {
                // L'année n'est pas bissextile, le jour maximum est 28
                $jourMax = 28;
            }
        } else {
            // Vérifier si le mois a 31 jours
            if (in_array($mois, [1, 3, 5, 7, 8, 10, 12])) {
                $jourMax = 31;
            } else {
                $jourMax = 30;
            }
        }

        // Vérifier si le jour est invalide
        if ($jour > $jourMax || $jour < 1) {
            $listeerreur[] = $annee . '-' . $mois . '-' . $jour;
        }
    }

    // Vérifier si le code est valide et trouver l'idtypedepense correspondant
    $code = $data['code'];
    $typedepense = Typedepense::where('code', $code)->first();

    if (!$typedepense) {
        $listeerreur[] = 'code invalide';
    } else {
        $idtypedepense = $typedepense->idtypedepense;
    }

    // Vérifier si le montant est invalide
    $montant = $data['montant'];
    if (!is_numeric($montant) || $montant < 0) {
        $listeerreur[] = 'montant invalide';
    } else {
        $montant = number_format((float)$montant, 2, '.', ''); // Formatage du montant en décimal (10,2)
    }

    if (count($listeerreur) > 0) {
        $listeerreurStr = implode(', ', $listeerreur);
        $errorMessage = 'Les données suivantes sont invalides : ' . $listeerreurStr;
        return redirect("ListeDepense")->with('error', $errorMessage);
    }

    // Toutes les dépenses sont valides, insérer les dépenses dans la base de données
    foreach ($moisSelectionnes as $mois) {
        $annee = $data['annee'];
        $jour = $data['jour'];
        $datedepense = $annee . '-' . $mois . '-' . $jour;

        $depense = new depense([
            'idtypedepense' => $idtypedepense,
            'datedepense' => $datedepense,
            'montant' => $montant,
            'quantite' => $data['quantite'],
        ]);

        $depense->save();
    }

    return redirect("ListeDepense")->with('success', 'Dépenses ajoutées avec succès !');
}


public function ImporterDepenses(Request $request)
{
    // Vérifiez si un fichier a été téléchargé
    if ($request->hasFile('fichier_csv')) {
        $file = $request->file('fichier_csv');

        // Vérifiez si le fichier est valide
        if ($file->isValid()) {
            // Obtenez le chemin du fichier temporaire
            $filePath = $file->path();

            // Ouvrez le fichier en lecture
            $handle = fopen($filePath, 'r');

            if ($handle) {
                // Parcourez chaque ligne du fichier CSV
                while (($line = fgetcsv($handle, 0, ';')) !== false) {
                    // Récupérez les données de chaque colonne
                    $datedepense = DateTime::createFromFormat('d/m/Y', $line[0])->format('Y/m/d');
                    $typedepense_code = $line[1];
                    $montant = $line[2];

                    // Recherchez le type de dépense par code
                    $typedepense = typedepense::where('code', $typedepense_code)->first();

                    // Vérifiez si le type de dépense existe
                    if ($typedepense) {
                        // Créez une nouvelle instance de dépense
                        $depense = new depense([
                            'idtypedepense' => $typedepense->idtypedepense,
                            'datedepense' => $datedepense,
                            'montant' => $montant,
                            'quantite' => 1,

                            // Ajoutez d'autres colonnes si nécessaire
                        ]);

                        // Enregistrez la dépense dans la base de données
                        $depense->save();
                    }
                }

                // Fermez le fichier
                fclose($handle);

                return redirect("ListeDepense")->with('success', 'Dépenses importées avec succès !');
            }
        }
    }

    return redirect("ListeDepense")->with('error', 'Erreur lors de l\'importation des dépenses. Veuillez vérifier le fichier CSV.');
}



    public function Update_DEPENSE(Request $request)
    {
        $data = $request->all();
        $item = depense::find(request('iddepense'));

        $item->update($data);
        return redirect("ListeDepense")->with('modification', 'Modification avec succès !');
    }

    public function recherche(Request $request)
    {
        $keyword = $request->input('motcle');

        $results = DB::table('v_depenses')->where('etatsup', 0)
            ->where(function($query) use ($keyword) {
                $query->where('typedepense', 'LIKE', '%'.$keyword.'%')
                      ->orWhere('datedepense', 'LIKE', '%'.$keyword.'%')
                      ->orWhere('montant', 'LIKE', '%'.$keyword.'%')
                      ->orWhere('quantite', 'LIKE', '%'.$keyword.'%');
            })
            ->get();

        $currentPage = 1;
        $lastPage = 3;
        $listeNumeroPage = range(1, $lastPage);
       
        return view('crud/depense/Liste', [
            'liste' => $results,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
    }
    
    public function pagination(Request $request)
    {
        $bloc = 999;
        $page = request()->query('page', request('numero')); // Valeur par défaut : 1
        $perPage = request()->query('perPage', $bloc); // Valeur par défaut : 10
        $currentPage = request('numero');
      
        $listeDepense = DB::table('v_depenses')->where('etatsup', 0)->orderBy("iddepense", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $listeDepense->lastPage();
        $listeNumeroPage = range(1, $lastPage);
      
        return view('crud/depense/ListeDepense', [
            'listeDepense' => $listeDepense,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
    }


    
}