<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\acte;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use DateTime;

class ActeController extends Controller
{
    public function AjoutActe()
    {
       return view('crud/acte/AjoutActe');
    }
    public function UpdateActe()
    {
    $acte =  collect(\DB::select('select * from actes where idacte=? ', [request('id')]))->first();
       return view("crud/acte/UpdateActe",[
           'acte' => $acte,
       ]);
    }
    public function ListeActe()
     {
        $bloc = 999;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $listeActe = acte::where('etatsup',0)->orderBy("idacte", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $listeActe->lastPage(); 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('crud/acte/ListeActe',[
            'listeActe' => $listeActe,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }
     public function Delete_ACTE()
     {
       $id = acte::find(request('id'));
       $id->update([
           'etatsup' => 1
       ]);
       return redirect("ListeActe")->with('suppression', 'Suppression avec succes !');
     }
   

     public function Ajout_ACTE(Request $request)
     {
         $data = $request->all();
         acte::create($data);
         return redirect("ListeActe")->with('success', 'Acte ajoute avec succes !');
     }

     public function Update_ACTE(Request $request)
     {
        $data = $request->all();
        $item = acte::find(request('idacte'));
        $item->update($data);
        return redirect("ListeActe")->with('modification', 'Modification avec succes !');
     }




    public function recherche(Request $request)
    {
    $keyword = $request->input('motcle'); // récupérer le mot clé de la requête
    
    $results = DB::table('actes')->where('etatsup',0)
        ->where(function($query) use ($keyword) {
            $query->where('nom', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('tarif_par_heure', 'LIKE', '%'.$keyword.'%');
        })
        ->get();

        $currentPage = 1;

        $lastPage = 3; 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('crud/acte/Liste',[
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

      
       $listeActe = acte::where('etatsup',0)->orderBy("idacte", "asc")->paginate($perPage, ['*'], 'page', $page);

       $lastPage = $listeActe->lastPage(); 

       $listeNumeroPage = range(1, $lastPage);
      
       return view('crud/acte/ListeActe',[
           'listeActe' => $listeActe,
           'currentPage' => request('numero'),
           'lastPage' => $lastPage,
           'listeNumeroPage' => $listeNumeroPage,
       ]);
    }

}