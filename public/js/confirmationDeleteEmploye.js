function showConfirmation(nom, branche, image, url) {
    Swal.fire({
        title: 'Voulez-vous vraiment supprimer cet employé ?',
        html: `<div style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%; margin: 0 auto;">
                   <img src="data:image/png;base64,${image}" alt="Image de l'employé" style="width: 100%; height: 100%; object-fit: cover;">
               </div>
               <br>
               <strong>Nom:</strong> ${nom}<br>
               <strong>Branche:</strong> ${branche}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non'
    }).then((result) => {
        if (result.isConfirmed) {
            // Mettez ici votre logique de suppression
            window.location.href = url; // Redirige vers le lien de suppression
        }
    });
}
