        window.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('form');
            forms.forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    let form = e.currentTarget;
                    Swal.fire({
                        title: 'Suppression d\'un livre',
                        text: 'Voulez vous supprimer définitivement le livre ?',
                        icon: 'warning',
                        confirmButtonText: 'Supprimer'
                    }).then(function (isConfirm) {
                        if (isConfirm) {
                            console.log('suppression confirmée', form);
                            // soumission du formulaire par le code
                            form.submit();
                        }
                    });
                })
            });
        })
