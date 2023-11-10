<?php



use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login',\App\Http\Controllers\LoginController::class . '@showLoginForm');
Route::post('/login',\App\Http\Controllers\LoginController::class . '@login');

Route::get('/showsession',\App\Http\Controllers\LoginController::class . '@showSessionData');
Route::get('/clearSessionToken',\App\Http\Controllers\LoginController::class . '@clearSessionToken');

Route::get('/resetPassword',\App\Http\Controllers\LoginController::class . '@showResetPasswordForm');
Route::get('/Reset_PASSWORD',\App\Http\Controllers\LoginController::class . '@resetPassword');
Route::post('/Reset_PASSWORD',\App\Http\Controllers\LoginController::class . '@resetPassword');

Route::get('/register',\App\Http\Controllers\LoginController::class . '@showRegisterForm');
Route::post('/register',\App\Http\Controllers\LoginController::class . '@register');

Route::get('/logout',\App\Http\Controllers\LoginController::class . '@logout');

Route::get('/error404',\App\Http\Controllers\ErrorController::class . '@error404');

//COMPONENTS ROUTES
Route::get('/profile',\App\Http\Controllers\ComponentController::class . '@profile');


// Routes pour les administrateurs
Route::middleware(['App\Http\Middleware\AuthTokenAdminMiddleware'])->group(function () {
    // Les routes nécessitant une authentification d'administrateur vont ici
    Route::get('/admin/AjoutPatient',\App\Http\Controllers\PatientController::class . '@AjoutPatient');
    Route::get('/admin/ListeEmploye',\App\Http\Controllers\EmployeController::class . '@ListeEmploye');
    Route::get('/admin/VueEmploye/{idemploye}',\App\Http\Controllers\EmployeController::class . '@VueEmploye');

    Route::get('/admin/DeleteEmploye/{idemploye}',\App\Http\Controllers\EmployeController::class . '@DeleteEmploye');

    // ... Autres routes administratives ...
});





Route::middleware(['App\Http\Middleware\AuthTokenEmployeeMiddleware'])->group(function () {
    // Les routes nécessitant une authentification d'administrateur vont ici
    Route::get('user/AjoutActe',\App\Http\Controllers\ActeController::class . '@AjoutActe');
    // ... Autres routes administratives ...
});


// Routes pour les employés

    Route::post('/Ajout_PATIENT',\App\Http\Controllers\PatientController::class . '@Ajout_PATIENT');

    Route::get('/ListePatient',\App\Http\Controllers\PatientController::class . '@ListePatient');   
    Route::get('/paginationpatient/{numero}',\App\Http\Controllers\PatientController::class . '@pagination');
    Route::post('/recherchepatient',\App\Http\Controllers\PatientController::class . '@recherche');

    Route::get('/UpdatePatient/{id}',\App\Http\Controllers\PatientController::class . '@UpdatePatient') ;
    Route::post('/Update_PATIENT',\App\Http\Controllers\PatientController::class . '@Update_PATIENT');
    Route::get('/Delete_PATIENT/{id}',\App\Http\Controllers\PatientController::class . '@Delete_PATIENT');


// Routes pour les administrateurs


// Login 




// crud patient 
Route::get('/AjoutPatient',\App\Http\Controllers\PatientController::class . '@AjoutPatient');
Route::post('/Ajout_PATIENT',\App\Http\Controllers\PatientController::class . '@Ajout_PATIENT');

Route::get('/ListePatient',\App\Http\Controllers\PatientController::class . '@ListePatient');
Route::get('/paginationpatient/{numero}',\App\Http\Controllers\PatientController::class . '@pagination');
Route::post('/recherchepatient',\App\Http\Controllers\PatientController::class . '@recherche');

Route::get('/UpdatePatient/{id}',\App\Http\Controllers\PatientController::class . '@UpdatePatient');
Route::post('/Update_PATIENT',\App\Http\Controllers\PatientController::class . '@Update_PATIENT');
Route::get('/Delete_PATIENT/{id}',\App\Http\Controllers\PatientController::class . '@Delete_PATIENT');


//crud acte
Route::post('/Ajout_ACTE',\App\Http\Controllers\ActeController::class . '@Ajout_ACTE');

Route::get('/ListeActe',\App\Http\Controllers\ActeController::class . '@ListeActe');
Route::get('/paginationacte/{numero}',\App\Http\Controllers\ActeController::class . '@pagination');
Route::post('/rechercheacte',\App\Http\Controllers\ActeController::class . '@recherche');

Route::get('/UpdateActe/{id}',\App\Http\Controllers\ActeController::class . '@UpdateActe');
Route::post('/Update_ACTE',\App\Http\Controllers\ActeController::class . '@Update_ACTE');
Route::get('/Delete_ACTE/{id}',\App\Http\Controllers\ActeController::class . '@Delete_ACTE');


//crud TypeDepense
Route::get('/AjoutTypeDepense',\App\Http\Controllers\TypeDepenseController::class . '@AjoutTypeDepense');
Route::post('/Ajout_TYPEDEPENSE',\App\Http\Controllers\TypeDepenseController::class . '@Ajout_TYPEDEPENSE');

Route::get('/ListeTypeDepense',\App\Http\Controllers\TypeDepenseController::class . '@ListeTypeDepense');
Route::get('/paginationtypedepense/{numero}',\App\Http\Controllers\TypeDepenseController::class . '@pagination');
Route::post('/recherchetypedepense',\App\Http\Controllers\TypeDepenseController::class . '@recherche');

Route::get('/UpdateTypeDepense/{id}',\App\Http\Controllers\TypeDepenseController::class . '@UpdateTypeDepense');
Route::post('/Update_TYPEDEPENSE',\App\Http\Controllers\TypeDepenseController::class . '@Update_TYPEDEPENSE');
Route::get('/Delete_TYPEDEPENSE/{id}',\App\Http\Controllers\TypeDepenseController::class . '@Delete_TYPEDEPENSE');


//crud Depense
Route::get('/AjoutDepense',\App\Http\Controllers\DepenseController::class . '@AjoutDepense');
Route::post('/Ajout_DEPENSE',\App\Http\Controllers\DepenseController::class . '@Ajout_DEPENSE');

Route::get('/ListeDepense',\App\Http\Controllers\DepenseController::class . '@ListeDepense');
Route::get('/paginationdepense/{numero}',\App\Http\Controllers\DepenseController::class . '@pagination');
Route::post('/recherchedepense',\App\Http\Controllers\DepenseController::class . '@recherche');

Route::get('/UpdateDepense/{id}',\App\Http\Controllers\DepenseController::class . '@UpdateDepense');
Route::post('/Update_DEPENSE',\App\Http\Controllers\DepenseController::class . '@Update_DEPENSE');
Route::get('/Delete_DEPENSE/{id}',\App\Http\Controllers\DepenseController::class . '@Delete_DEPENSE');
Route::post('/ImporterDepenses',\App\Http\Controllers\DepenseController::class . '@ImporterDepenses');



//crud Facture
Route::get('/AjoutFacture',\App\Http\Controllers\FactureController::class . '@AjoutFacture');
Route::post('/Ajout_FACTURE',\App\Http\Controllers\FactureController::class . '@Ajout_FACTURE');

Route::get('/AjoutDetailFacture/{idFacture}',\App\Http\Controllers\FactureController::class . '@AjoutDetailFacture');
Route::post('/Ajout_DETAIL_FACTURE',\App\Http\Controllers\FactureController::class . '@Ajout_DETAIL_FACTURE');

Route::get('/DetailsFacture/{id}',\App\Http\Controllers\FactureController::class . '@DetailsFacture');
Route::get('/exportPDF/{idfacture}',\App\Http\Controllers\FactureController::class . '@exportPDF');

Route::get('/ListeFacture',\App\Http\Controllers\FactureController::class . '@ListeFacture');
Route::get('/paginationfacture/{numero}',\App\Http\Controllers\FactureController::class . '@pagination');
Route::post('/recherchefacture',\App\Http\Controllers\FactureController::class . '@recherche');

Route::get('/UpdateFacture/{id}',\App\Http\Controllers\FactureController::class . '@UpdateFacture');
Route::post('/Update_FACTURE',\App\Http\Controllers\FactureController::class . '@Update_FACTURE');
Route::get('/Delete_FACTURE/{id}',\App\Http\Controllers\FactureController::class . '@Delete_FACTURE');
Route::get('/Rembourser_FACTURE/{id}',\App\Http\Controllers\FactureController::class . '@Rembourser_FACTURE');
Route::get('/Annuler_REMBOURSEMENT/{id}',\App\Http\Controllers\FactureController::class . '@Annuler_REMBOURSEMENT');



//crud Statistique
Route::get('/TableauDepense',\App\Http\Controllers\StatistiqueController::class . '@DepenseParMois');
Route::get('/depenseparmois',\App\Http\Controllers\StatistiqueController::class . '@DepenseParMois');

Route::get('/TableauRecette',\App\Http\Controllers\StatistiqueController::class . '@RecetteParMois');
Route::get('/recetteparmois',\App\Http\Controllers\StatistiqueController::class . '@RecetteParMois');

Route::get('/TableauBenefice',\App\Http\Controllers\StatistiqueController::class . '@BeneficeParMois');
Route::get('/TableauBeneficeTout',\App\Http\Controllers\StatistiqueController::class . '@TableauDeBordBenefice');
Route::get('/beneficeparmois',\App\Http\Controllers\StatistiqueController::class . '@beneficeParMois');
Route::get('/TableauDeBord',\App\Http\Controllers\StatistiqueController::class . '@TableauDeBord');
Route::get('/TableauDeBordBenefice',\App\Http\Controllers\StatistiqueController::class . '@TableauDeBordBenefice');
Route::get('/TableauDeBordBenefice2',\App\Http\Controllers\StatistiqueController::class . '@TableauDeBordBenefice2');