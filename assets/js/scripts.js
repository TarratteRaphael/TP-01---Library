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
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                })
            });
        })
