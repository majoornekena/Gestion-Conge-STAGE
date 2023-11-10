<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\typedepense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use DateTime;

class TypeDepenseController extends Controller
{
    public function AjoutTypeDepense()
    {
       return view('crud/typedepense/AjoutTypeDepense');
    }
    public function UpdateTypeDepense()
    {
    $typedepense =  collect(\DB::select('select * from typedepenses where idtypedepense=? ', [request('id')]))->first();
       return view("crud/typedepense/UpdateTypeDepense",[
           'typedepense' => $typedepense,
       ]);
    }
    public function ListeTypeDepense()
     {
        $bloc = 999;
        $page = request()->query('page',1); // Valeur par défaut : 1
        $perPage = request()->query('perPage',$bloc); // Valeur par défaut : 10
        $currentPage = 1;

        $listeTypeDepense = typedepense::where('etatsup',0)->orderBy("idtypedepense", "asc")->paginate($perPage, ['*'], 'page', $page);

        $lastPage = $listeTypeDepense->lastPage(); 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('crud/typedepense/ListeTypeDepense',[
            'listeTypeDepense' => $listeTypeDepense,
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'listeNumeroPage' => $listeNumeroPage,
        ]);
     }
     public function Delete_TYPEDEPENSE()
     {
       $id = typedepense::find(request('id'));
       $id->update([
           'etatsup' => 1
       ]);
       return redirect("ListeTypeDepense")->with('suppression', 'Suppression avec succes !');
     }
   

     public function Ajout_TYPEDEPENSE(Request $request)
     {
         $data = $request->all();
         typedepense::create($data);
         return redirect("ListeTypeDepense")->with('success', 'TypeDepense ajoute avec succes !');
     }

     public function Update_TYPEDEPENSE(Request $request)
     {
        $data = $request->all();
        $item = typedepense::find(request('idtypedepense'));
        $item->update($data);
        return redirect("ListeTypeDepense")->with('modification', 'Modification avec succes !');
     }




    public function recherche(Request $request)
    {
    $keyword = $request->input('motcle'); // récupérer le mot clé de la requête
    
    $results = DB::table('typedepenses')->where('etatsup',0)
        ->where(function($query) use ($keyword) {
            $query->where('nom', 'LIKE', '%'.$keyword.'%')
                  ->orWhere('tarif_par_heure', 'LIKE', '%'.$keyword.'%');
        })
        ->get();

        $currentPage = 1;

        $lastPage = 3; 

        $listeNumeroPage = range(1, $lastPage);
       
        return view('crud/typedepense/Liste',[
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

      
       $listeTypeDepense = typedepense::where('etatsup',0)->orderBy("idtypedepense", "asc")->paginate($perPage, ['*'], 'page', $page);

       $lastPage = $listeTypeDepense->lastPage(); 

       $listeNumeroPage = range(1, $lastPage);
      
       return view('crud/typedepense/ListeTypeDepense',[
           'listeTypeDepense' => $listeTypeDepense,
           'currentPage' => request('numero'),
           'lastPage' => $lastPage,
           'listeNumeroPage' => $listeNumeroPage,
       ]);
    }

}