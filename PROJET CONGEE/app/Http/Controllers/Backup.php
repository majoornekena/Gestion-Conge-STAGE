    
    public function Ajout_DEPENSE(Request $request)
    {
        $data = $request->all();
        $moisSelectionnes = $request->input('mois', []);
    
        $datesInvalides = []; // Tableau pour stocker les dates invalides
    
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
            if ($jour > $jourMax) {
                $datesInvalides[] = $annee . '-' . $mois . '-' . $jour;
            }
        }
    
        if (count($datesInvalides) > 0) {
            $datesInvalidesStr = implode(', ', $datesInvalides);
            return redirect("ListeDepense")->with('error', 'Les dates suivantes sont invalides : ' . $datesInvalidesStr);
        }
    
        // Toutes les dépenses sont valides, insérer les dépenses dans la base de données
        foreach ($moisSelectionnes as $mois) {
            $annee = $data['annee'];
            $jour = $data['jour'];
            $datedepense = $annee . '-' . $mois . '-' . $jour;
    
            $depense = new depense([
                'idtypedepense' => $data['idtypedepense'],
                'datedepense' => $datedepense,
                'montant' => $data['montant'],
                'quantite' => $data['quantite'],
            ]);
    
            $depense->save();
        }
    
        return redirect("ListeDepense")->with('success', 'Dépenses ajoutées avec succès !');
    }
    