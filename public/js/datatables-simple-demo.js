document.addEventListener('DOMContentLoaded', function () {
    // Initialisation de Simple-DataTables
    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        const dataTable = new simpleDatatables.DataTable(datatablesSimple, {
            labels: {
                placeholder: "Rechercher...",
                perPage: " entrées par page",
                noRows: "Aucune entrée trouvée",
                info: "Affichage de {start} à {end} sur {rows} entrées",
            },
            perPage: this.all(), // Valeur par défaut
            // ... Autres options de configuration ...
        });

        // Menu déroulant pour choisir le nombre d'entrées par page
        const perPageSelect = document.getElementById('per-page-select');
        if (perPageSelect) {
            perPageSelect.addEventListener('change', function () {
                const selectedValue = parseInt(this.value, 10);
                // Mettre à jour la valeur de perPage dynamiquement
                dataTable.updatePerPage(selectedValue);
            });
        }

        // Ajout du gestionnaire d'événements pour le bouton d'export
        const exportButtonExcel = document.getElementById('export-excel');
        const exportButtonPDF = document.getElementById('export-pdf');
        if (exportButtonExcel && exportButtonPDF) {
            exportButtonExcel.addEventListener('click', function () {
                // Récupérer la valeur de l'attribut data-columns-to-export du bouton Excel
                const columnsToExportExcel = this.getAttribute('data-columns-to-export');
                // Utiliser cette valeur pour l'exportation Excel
                exportToCSV(columnsToExportExcel);
            });

            exportButtonPDF.addEventListener('click', function () {
                // Récupérer la valeur de l'attribut data-columns-to-export du bouton PDF
                const columnsToExportPDF = this.getAttribute('data-columns-to-export');
                // Utiliser cette valeur pour l'exportation PDF
                exportToPDF(columnsToExportPDF);
            });
        }
    }
});


document.addEventListener('DOMContentLoaded', function () {
    // Initialisation de Simple-DataTables
    const datatablesSimple = document.getElementById('tablesimple');
    if (datatablesSimple) {
        const dataTable = new simpleDatatables.DataTable(datatablesSimple, {
            labels: {
                placeholder: "Rechercher...",
                perPage: "",
                noRows: "Aucune entrée trouvée",
                info: "Affichage de {start} à {end} sur {rows} entrées",
            },
        });

        // Ajout du gestionnaire d'événements pour le bouton d'export
        const exportButtonExcel = document.getElementById('export-excel');
        const exportButtonPDF = document.getElementById('export-pdf');
        if (exportButtonExcel && exportButtonPDF) {
            exportButtonExcel.addEventListener('click', function () {
                // Récupérer la valeur de l'attribut data-columns-to-export du bouton Excel
                const columnsToExportExcel = this.getAttribute('data-columns-to-export');
                // Utiliser cette valeur pour l'exportation Excel
                exportToCSV(columnsToExportExcel);
            });

            exportButtonPDF.addEventListener('click', function () {
                // Récupérer la valeur de l'attribut data-columns-to-export du bouton PDF
                const columnsToExportPDF = this.getAttribute('data-columns-to-export');
                // Utiliser cette valeur pour l'exportation PDF
                exportToPDF(columnsToExportPDF);
            });
        }
    }
});

// Reste du code...

function exportToCSV(columnsToExport) {
    // Variable to store the final csv data
    var csv_data = [];

    // Get the table element
    var table = document.getElementById('datatablesSimple');

    // Get each row data
    var rows = table.getElementsByTagName('tr');
    for (var i = 0; i < rows.length; i++) {
        // Get each column data based on the specified indices
        var cols = rows[i].querySelectorAll('td,th');
        var csvrow = [];

        // Iterate through the specified columns
        for (var j = 0; j < columnsToExport.length; j++) {
            var columnIndex = columnsToExport[j];

            // Add this check to ensure that cols[columnIndex] is defined
            if (cols[columnIndex]) {
                // Get the text data of the specified column of a row
                csvrow.push(cols[columnIndex].textContent.trim());
            } else {
                // If the column is not defined, add an empty string
                csvrow.push("");
            }
        }

        // Combine each column value with a comma
        csv_data.push(csvrow.join(","));
    }

    // Combine each row data with a new line character
    csv_data = csv_data.join('\n');

    // Call this function to download CSV file
    downloadCSVFile(csv_data);
}


function downloadCSVFile(csv_data) {
    // Create CSV file object and feed our csv_data into it
    var CSVFile = new Blob([new Uint8Array([0xEF, 0xBB, 0xBF]), csv_data], {
    type: "text/csv;charset=utf-8"
});

    // Create a temporary link to initiate the download process
    var temp_link = document.createElement('a');

    // Download CSV file
    temp_link.download = "exported-table.csv";
    var url = window.URL.createObjectURL(CSVFile);
    temp_link.href = url;

    // This link should not be displayed
    temp_link.style.display = "none";
    document.body.appendChild(temp_link);

    // Automatically click the link to trigger download
    temp_link.click();
    document.body.removeChild(temp_link);
}
function exportToPDF(button) {
    // Récupérer la valeur de l'attribut data-columns-to-export du bouton
    const columnsToExport = button.getAttribute('data-columns-to-export');

    // Créer une nouvelle instance jsPDF
    var pdf = new window.jspdf.jsPDF();

    // Get the table element
    var table = document.getElementById('datatablesSimple');

    // Ensure that the table exists
    if (table) {
        // Get each row data
        var rows = table.getElementsByTagName('tr');

        // Use autoTable to generate the table in PDF
        pdf.autoTable({
            head: [Array.from(rows[0].cells).map(cell => cell.textContent.trim())],
            body: Array.from(rows).slice(1).map(row =>
                Array.from(row.cells).map(cell => cell.textContent.trim())
            ),
            startY: 10,
            theme: 'grid', // You can change the theme to 'striped', 'grid', etc.
            styles: {
                fontSize: 8,
                cellPadding: 2,
                overflow: 'linebreak'
            },
            columnStyles: {
                0: {
                    cellWidth: 50
                } // You can set specific styles for each column
                // Add more column styles if needed
            },
            columns: JSON.parse(columnsToExport).map(column => ({
                dataKey: column
            }))
        });

        // Save the PDF with a specific name
        pdf.save("exported-table.pdf");
    } else {
        console.error('Table not found');
    }
}

// Ajoutez un gestionnaire d'événements au bouton d'exportation PDF
document.getElementById('export-pdf').addEventListener('click', function() {
    exportToPDF(this);
});