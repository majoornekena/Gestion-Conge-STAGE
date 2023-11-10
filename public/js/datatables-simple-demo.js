window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            labels: {
                placeholder: "Rechercher...",
                perPage: " entrées par page",
                noRows: "Aucune entrée trouvée",
                info: "Affichage de {start} à {end} sur {rows} entrées",
            },
        });
    }
});
