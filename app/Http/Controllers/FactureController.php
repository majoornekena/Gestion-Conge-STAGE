<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\facture;
use App\patient; // Correction de "patients" à "patient"
use App\actepatient;
use App\acte;
use App\FormatDate;
use App\FormatNumber;
use Dompdf\Dompdf;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Cache;
use DateTime;

class FactureController extends Controller
{
    public function AjoutFacture()
    {
        $patients = patient::all(); // Correction de "patients" à "patient"
        return view('crud/facture/AjoutFacture', [
            'patients' => $patients,
        ]);
    }
    
    public function UpdateFacture()
    {
        $patients = patient::all(); // Correction de "patients" à "patient"
        $facture = DB::table('v_factures')->where('idfacture', request('id'))->first();
        return view("crud/facture/UpdateFacture", [
            'facture' => $facture,
            'patients' => $patients,
        ]);
    }
    
    public function ListeFacture()
    {
        $bloc = 999;
        $page = request()->query('page', 1); // Valeur par défaut : 1
        $perPage = request()->query('perPage', $bloc); // Valeur par défaut : 10

        $listeFacture = DB::table('v_factures')->where('etatsup', 0)->orderBy("idfacture", "asc")->paginate($perPage, ['*'], 'page', $page);

        $currentPage = $listeFacture->currentPage();
        $lastPage = $listeFacture->lastPage();
        $listeNumeroPage = range(1, $lastPage);
       
        return view('crud/facture/ListeFacture', [
            'listeFacture' => $listeFacture,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
    }
    
    public function Delete_FACTURE()
    {
       $id = facture::find(request('id'));
       $id->update([
           'etatsup' => 1
       ]);
       return redirect("ListeFacture")->with('suppression', 'Suppression avec succès !');
    }
   
    public function Rembourser_FACTURE()
    {
        $id = request('id');
        $actepatient = actepatient::where('idfacture', $id)->first();
        
        if ($actepatient) {
            $facture = facture::find($id);
            $idpatient = $facture->idpatient;
            $patient = patient::find($idpatient);
        
            if ($patient->remboursement === 'true') {
                $tarif_total = $actepatient->quantite * $actepatient->tarif;
        
                // Calculer la valeur du remboursement
                $valeur_remboursement = $tarif_total * 0.2;
        
                // Mettre à jour le tarif de remboursement de l'acte patient correspondant
                $actepatient2 = new actepatient([
                    'idfacture' => $actepatient->idfacture,
                    'idacte' => 5,
                    'quantite' => 1,
                    'tarif' => $valeur_remboursement,
                    'etatsup' => 0
                ]);
                $actepatient2->save();
        
                return redirect("ListeFacture")->with('suppression', 'Remboursement effectué avec succès !');
            } else {
                return redirect("ListeFacture")->with('error', 'Impossible de rembourser la facture. Le remboursement du patient est désactivé.');
            }
        } else {
            return redirect("ListeFacture")->with('error', 'Impossible de trouver l\'acte patient correspondant à la facture spécifiée.');
        }
    }
    
    
    
    public function Annuler_REMBOURSEMENT()
    {
        $id = request('id');
        $facture = facture::find($id);
    
        $idpatient = $facture->idpatient;
        $patient = patient::find($idpatient);
    
        if ($patient->remboursement === 'true') {
            // Supprimer l'acte patient correspondant au remboursement
            actepatient::where('idfacture', $facture->idfacture)
                ->where('idacte', 5)
                ->delete();
    
            // Mettre à jour l'état de remboursement de la facture à 0
            $facture->update([
                'etatremboursement' => 0
            ]);
    
            return redirect("ListeFacture")->with('suppression', 'Annulation effectuée avec succès !');
        } else {
            return redirect("ListeFacture")->with('error', 'Impossible de rembourser la facture. Le remboursement du patient est désactivé.');
        }
    }
    
    
    

    


    public function Ajout_FACTURE(Request $request)
    {
        $data = $request->all();
        facture::create($data);
        return redirect("ListeFacture")->with('success', 'Dépense ajoutée avec succès !');
    }

    public function Update_FACTURE(Request $request)
    {
        $data = $request->all();
        $item = facture::find(request('idfacture'));
        $item->update($data);
        return redirect("ListeFacture")->with('modification', 'Modification avec succès !');
    }

    public function recherche(Request $request)
    {
        $keyword = $request->input('motcle');

        $results = DB::table('v_factures')->where('etatsup', 0)
            ->where(function($query) use ($keyword) {
                $query->where('patients', 'LIKE', '%'.$keyword.'%')
                      ->orWhere('datefacture', 'LIKE', '%'.$keyword.'%')
                      ->orWhere('montant', 'LIKE', '%'.$keyword.'%')
                      ->orWhere('quantite', 'LIKE', '%'.$keyword.'%');
            })
            ->get();

        $currentPage = 1;
        $lastPage = 3;
        $listeNumeroPage = range(1, $lastPage);
       
        return view('crud/facture/Liste', [
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
      
        $listeFacture = DB::table('v_factures')->where('etatsup', 0)->orderBy("idfacture", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $listeFacture->lastPage();
        $listeNumeroPage = range(1, $lastPage);
      
        return view('crud/facture/ListeFacture', [
            'listeFacture' => $listeFacture,
            'currentPage' => request('numero'),
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
    }









    public function AjoutDetailFacture($idFacture)
{
    // Récupérez la facture correspondante
    $facture = facture::findOrFail($idFacture);

    // Récupérez les actes disponibles (à partir d'un modèle approprié)
    $actes = acte::all();

    return view('crud/facture/AjoutDetailFacture', [
        'facture' => $facture,
        'actes' => $actes,
    ]);
}
public function Ajout_DETAIL_FACTURE(Request $request)
{
    $data = $request->all();
    actepatient::create($data);

    // Redirigez l'utilisateur vers la page de la facture
    return redirect("ListeFacture")->with('success', 'Details de facture ajoutée avec succès !');
}
public function DetailsFacture($idfacture)
{
    $facture = DB::table('v_factures')->where('idfacture', $idfacture)->first();
    $detailsFacture = DB::table('v_detailfactures')->where('idfacture', $idfacture)->get();
    $tarifTotal = $this->calculerTarifTotal($detailsFacture);

    return view('crud.facture.DetailsFacture', [
        'facture' => $facture,
        'detailsFacture' => $detailsFacture,
        'tarifTotal' => $tarifTotal,
    ]);
}

public function calculerTarifTotal($detailsFacture)
{
    $tarifTotal = 0;

    foreach ($detailsFacture as $detail) {
        $tarifTotal += $detail->tarif_total;
    }

    return $tarifTotal;
}



public function exportPDF($idfacture)
{
    $facture = DB::table('v_factures')->where('idfacture', $idfacture)->first();
    $detailsFacture = DB::table('v_detailfactures')->where('idfacture', $idfacture)->get();
    $tarifTotal = $this->calculerTarifTotal($detailsFacture);

    // Création d'une instance Dompdf
    $dompdf = new Dompdf();

    // Construction du contenu HTML du PDF
    $html = '<h2>Détails de la facture</h2>';
    $html .= '<h4>Facture ID: ' . $facture->idfacture . '</h4>';
    $html .= '<h4>Patient: ' . $facture->patient_nom . '</h4>';
    $html .= '<p>Sexe: ' . $facture->patient_genre . '</p>';
    $html .= '<p>Date Naissance: ' . FormatDate::format($facture->patient_datenaissance) . '</p>';
    $html .= '<p>Date Facture: ' . FormatDate::format($facture->datefacture) . '</p>';

    // Tableau des détails de la facture
    $html .= '<table style="width: 100%; border-collapse: collapse;">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Acte Patient</th>';
    $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Acte</th>';
    $html .= '<th style="border: 1px solid #000; padding: 8px;">Acte</th>';
    $html .= '<th style="border: 1px solid #000; padding: 8px;">Quantité</th>';
    $html .= '<th style="border: 1px solid #000; padding: 8px;">Tarif</th>';
    $html .= '<th style="border: 1px solid #000; padding: 8px;">Tarif Total</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    foreach ($detailsFacture as $detail) {
        $html .= '<tr>';
        $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $detail->idactepatient . '</td>';
        $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $detail->idacte . '</td>';
        $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $detail->acte . '</td>';
        $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $detail->quantite . '</td>';
        $html .= '<td style="border: 1px solid #000; padding: 8px;">' . FormatNumber::formatter($detail->tarif) . '</td>';
        $html .= '<td style="border: 1px solid #000; padding: 8px;">' . FormatNumber::formatter($detail->tarif_total) . '</td>';
        $html .= '</tr>';
    }
    $html .= '<tr>';
    $html .= '<td colspan="5" style="border: 1px solid #000; padding: 8px;"></td>';
    $html .= '<td style="border: 1px solid #000; padding: 8px;">' . FormatNumber::formatter($tarifTotal) . '</td>';
    $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';

    // Charger le contenu HTML dans Dompdf
    $dompdf->loadHtml($html);

    // Rendre le PDF
    $dompdf->render();

    // Générer le nom du fichier PDF
    $fileName = 'details_facture_' . $facture->idfacture . '.pdf';

    // Télécharger le fichier PDF généré
    return $dompdf->stream($fileName);
}



}