<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\patient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use DateTime;
use App\Http\Controllers\ComponentController;

class PatientController extends Controller
{
    public function AjoutPatient()
    {
        $componentController = new ComponentController();

        // Appel de la méthode imgprofileadmin pour obtenir la vue Sidebar
        $sidebarView = $componentController->profile();
    
        // Récupérer les données de l'utilisateur depuis la vue renvoyée par imgprofileadmin()
        $userData = $sidebarView->getData();
    
        // Retourner la vue principale avec Sidebar et les données de l'utilisateur
        return view('crud/patient/AjoutPatient', ['sidebar' => $sidebarView, 'userData' => $userData]);
    }
    public function UpdatePatient()
    {
    $patient =  collect(\DB::select('select * from patients where idpatient=? ', [request('id')]))->first();
       return view("crud/patient/UpdatePatient",[
           'patient' => $patient,
       ]);
    }
    public function ListePatient()
     {
        $bloc = 999;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $listePatient = patient::where('etatsup',0)->orderBy("idpatient", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $listePatient->lastPage(); 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('crud/patient/ListePatient',[
            'listePatient' => $listePatient,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }
     public function Delete_PATIENT()
     {
       $id = patient::find(request('id'));
       $id->update([
           'etatsup' => 1
       ]);
       return redirect("ListePatient")->with('suppression', 'Suppression avec succes !');
     }
   

     public function Ajout_PATIENT(Request $request)
     {
         $data = $request->all();
         patient::create($data);
         return redirect("ListePatient")->with('success', 'Patient ajoute avec succes !');
     }

     public function Update_PATIENT(Request $request)
     {
        $data = $request->all();
        $item = patient::find(request('idpatient'));
        $item->update($data);
        return redirect("ListePatient")->with('modification', 'Modification avec succes !');
     }




    public function recherche(Request $request)
    {
    $keyword = $request->input('motcle'); // récupérer le mot clé de la requête
    
    $results = DB::table('patients')->where('etatsup',0)
        ->where(function($query) use ($keyword) {
            $query->where('nom', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('tarif_par_heure', 'LIKE', '%'.$keyword.'%');
        })
        ->get();

        $currentPage = 1;

        $lastPage = 3; 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('crud/patient/Liste',[
            'liste' => $results,
            'currentPage' => 1,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
    }
    public function pagination(Request $request)
    {
       $bloc = 5;
       $page = request()->query('page',request('numero')); // Valeur par défaut : 1
       $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
       $currentPage = request('numero');

      
       $listePatient = patient::where('etatsup',0)->orderBy("idpatient", "asc")->paginate($perPage, ['*'], 'page', $page);

       $lastPage = $listePatient->lastPage(); 

       $listeNumeroPage = range(1, $lastPage);
      
       return view('crud/patient/ListePatient',[
           'listePatient' => $listePatient,
           'currentPage' => request('numero'),
           'lastPage' => $lastPage,
           'listeNumeroPage' => $listeNumeroPage,
       ]);
    }

}