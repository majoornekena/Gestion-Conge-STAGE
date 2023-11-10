<?php
use App\FormatNumber;
use App\FormatDate;
use App\FormatMois;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Accueil</title>
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets4/Acc_Admin/css/checkbox.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/33.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('assets4/Login/js/test.css') }}">
</head>
<style>

body {
    background-color: #545454;
    font-family: "Poppins", sans-serif;
    font-weight: 300;
    padding: 30px
}

.div-table {
    display: table;
    width: 100%;
    overflow: scroll;
    background-color: #eee;
    border-spacing: 2px;
    border-radius:4px;
}

.trow {
    display: table-row
}

.tcolumn {
    display: table-cell;
    vertical-align: top;
    background-color: #fff;
    padding: 10px 8px
}

.tcolumn1 {
    width: 240px
}

.tcolumn4,
.tcolumn5,
.tcolumn6 {
    width: 80px
}
</style>
<body id="page-top">
    <div id="wrapper">
        @include('template.SideBar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                @include('template.Header')
                <div class="container-fluid">

                    <br>
                    <form action="{{ url('/TableauDeBordBenefice') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="annee">Année :</label>
                                    <select class="form-control" name="annee" id="annee">
                                        <option value="">Toutes</option>
                                        <?php
    for ($annee = 2019; $annee <= 2023; $annee++) {
        echo '<option value="' . $annee . '">' . $annee . '</option>';
    }
    ?>
                                    </select>

                                    <div class="mb-3">
                            <label for="limit" class="form-label">limit :</label>
                            <input type="number" name="limit" class="form-control" id="limit">
                        </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mois">Mois :</label>
                                    <select class="form-control" name="mois" id="mois">
                                        <option value="">Tous</option>
                                        <option value="1">Janvier</option>
                                        <option value="2">Février</option>
                                        <option value="3">Mars</option>
                                        <option value="4">Avril</option>
                                        <option value="5">Mai</option>
                                        <option value="6">Juin</option>
                                        <option value="7">Juillet</option>
                                        <option value="8">Août</option>
                                        <option value="9">Septembre</option>
                                        <option value="10">Octobre</option>
                                        <option value="11">Novembre</option>
                                        <option value="12">Décembre</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Filtrer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br><br><br>
                    
                    <br><br><br>
                    
                    <br><br><br>
                    <div class="div-table">
                        <h4>Bénéfices</h4>
                        <div class="trow">
                            <div>
                                <div>
                                    <div>Année</div>
                                    <div>Mois</div>
                                    <div>Total Recettes</div>
                                    <div>Total Dépenses</div>
                                    <div>Total Benefice</div>
                                    <div>Budget Mois</div>
                                    <div>% Mois</div>
                                    <div>Total Réalisation Recettes</div>
                                    <div>Total Réalisation Dépenses</div>
                                    <!-- <th>Total Budget Annuel Recettes</th>
                                    <th>Total Budget Annuel Dépenses</th> -->
                                    <div>Total Budget Mensuel Recettes</div>
                                    <div>Total Budget Mensuel Dépenses</div>
                                </div>
                            </div>
                            <div>
                                @foreach($benefices as $benefice)
                                <div>
                                    <div>{{ $benefice->annee }}</td>
                                    <div>{{ FormatMois::formatMois($benefice->mois) }}</div>
                                    <div>{{ FormatNumber::formatter($benefice->total_recettes) }}</div>
                                    <div>{{ FormatNumber::formatter($benefice->total_depenses) }}</div>
                                    <div>{{ FormatNumber::formatter($benefice->benefice) }}</div>
                                    <div>{{ FormatNumber::formatter($benefice->budget_du_mois) }}</div>
                                    <div>{{ FormatNumber::formatter($benefice->pourcentage_mois) }} %</div>

                                    <div>{{ FormatNumber::formatter($benefice->total_realisation_recettes) }} %</div>
                                    <div>{{ FormatNumber::formatter($benefice->total_realisation_depenses) }} %</div>
                                    <!-- <td>{{ $benefice->total_budget_annuel_recettes }}</td>
                                    <td>{{ $benefice->total_budget_annuel_depenses }}</td> -->
                                    <div>{{ FormatNumber::formatter($benefice->total_budget_mensuel_recettes) }}</div>
                                    <div>{{ FormatNumber::formatter($benefice->total_budget_mensuel_depenses) }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>



                    <div class="table-responsive">
                        <h4>Bénéfices 3</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Année</th>
                                    <th>Mois</th>
                                    <th>Total Recettes</th>
                                    <th>Total Dépenses</th>
                                    <th>Total Benefice</th>
                                    <th>Budget Mois</th>
                                    <th>% Mois</th>
                                    <th>Total Réalisation Recettes</th>
                                    <th>Total Réalisation Dépenses</th>
                                    <!-- <th>Total Budget Annuel Recettes</th>
                                    <th>Total Budget Annuel Dépenses</th> -->
                                    <!-- <th>Total Budget Mensuel Recettes</th> -->
                                    <!-- <th>Total Budget Mensuel Dépenses</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($beneficesT3 as $benefice)
                                <tr>
                                    <td>{{ $benefice->annee }}</td>
                                    <td>{{ FormatMois::formatMois($benefice->mois) }}</td>
                                    <!-- <td>{{ FormatNumber::formatter($benefice->total_recettes) }}</td> -->
                                    <!-- <td>{{ FormatNumber::formatter($benefice->total_depenses) }}</td> -->
                                    <td>{{ FormatNumber::formatter($benefice->benefice) }}</td>
                                    <!-- <td>{{ FormatNumber::formatter($benefice->budget_du_mois) }}</td> -->
                                    <!-- <td>{{ FormatNumber::formatter($benefice->pourcentage_mois) }} %</td> -->

                                    <!-- <td>{{ FormatNumber::formatter($benefice->total_realisation_recettes) }} %</td> -->
                                    <!-- <td>{{ FormatNumber::formatter($benefice->total_realisation_depenses) }} %</td> -->
                                    <!-- <td>{{ $benefice->total_budget_annuel_recettes }}</td>
                                    <td>{{ $benefice->total_budget_annuel_depenses }}</td> -->
                                    <!-- <td>{{ FormatNumber::formatter($benefice->total_budget_mensuel_recettes) }}</td> -->
                                    <!-- <td>{{ FormatNumber::formatter($benefice->total_budget_mensuel_depenses) }}</td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
 <button type="button" onclick="tableToCSV()">
            download CSV
        </button>                    </div>

                </div>

            </div>

        </div>
        <script src="{{ asset('assets4/Acc_Admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/bs-init.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/HTML-Table-to-Excel-V2.js') }}"></script>
        <script src="{{ asset('assets4/Acc_Admin/js/theme.js') }}"></script>
        <script type="text/javascript">
        function tableToCSV() {
 
            // Variable to store the final csv data
            var csv_data = [];
 
            // Get each row data
            var rows = document.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
 
                // Get each column data
                var cols = rows[i].querySelectorAll('td,th');
 
                // Stores each csv row data
                var csvrow = [];
                for (var j = 0; j < cols.length; j++) {
 
                    // Get the text data of each cell
                    // of a row and push it to csvrow
                    csvrow.push(cols[j].innerHTML);
                }
 
                // Combine each column value with comma
                csv_data.push(csvrow.join(","));
            }
 
            // Combine each row data with new line character
            csv_data = csv_data.join('\n');
 
            // Call this function to download csv file 
            downloadCSVFile(csv_data);
 
        }
 
        function downloadCSVFile(csv_data) {
 
            // Create CSV file object and feed
            // our csv_data into it
            CSVFile = new Blob([csv_data], {
                type: "text/csv"
            });
 
            // Create to temporary link to initiate
            // download process
            var temp_link = document.createElement('a');
 
            // Download csv file
            temp_link.download = "GfG.csv";
            var url = window.URL.createObjectURL(CSVFile);
            temp_link.href = url;
 
            // This link should not be displayed
            temp_link.style.display = "none";
            document.body.appendChild(temp_link);
 
            // Automatically click the link to
            // trigger download
            temp_link.click();
            document.body.removeChild(temp_link);
        }
    </script>
</body>

</html>