<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Employee;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

class EmployeController extends Controller
{
    public function ListeEmploye()
    {
        // Initialize Component
        $componentController = new ComponentController();
        $sidebarView = $componentController->profile();
        $userData = $sidebarView->getData();

        // Récupération de la liste des employés avec leur branche actuelle
        $listeEmploye = DB::table('v_listeemploye')->orderBy('dateaffectation', 'desc')->get();
        return view('admin/List/ListeEmploye', [
            'listeEmploye' => $listeEmploye,
            // Return the component
            'sidebar' => $sidebarView, 'userData' => $userData
        ]);
    }
    public function VueEmploye($id)
    {
        // Initialize Component
        $componentController = new ComponentController();
        $sidebarView = $componentController->profile();
        $userData = $sidebarView->getData();
    
        // Récupération des informations de base de l'employé
        $employee = Employee::find($id);
    
        // Récupération des informations supplémentaires de la vue v_listeemploye
        $additionalInfo = DB::table('v_listeemploye')
            ->where('idemploye', $id)
            ->orderBy('dateaffectation', 'desc')
            ->first();
    
        return view('admin/List/VueEmploye', [
            'employee' => $employee,
            'additionalInfo' => $additionalInfo,
            // Return the component
            'sidebar' => $sidebarView, 'userData' => $userData
        ]);
    }

    public function DeleteEmploye($idemploye)
    {
    $id = request('idemploye'); // Récupérez l'id de l'employé à supprimer depuis la requête

    // Mettez à jour l'état de suppression de l'employé
    $employe = Employee::find($id);
    if ($employe) {
        $employe->update([
            'etatsup' => 1
        ]);
        return redirect("/admin/ListeEmploye")->with('success', 'Suppression réussie !');
    } else {
        return redirect("/admin/ListeEmploye")->with('erreur', 'Erreur lors de la suppression de l\'employé. Veuillez réessayer.');
    }
}



}   