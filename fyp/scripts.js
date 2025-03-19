// window.addEventListener('DOMContentLoaded', event => {

//     // Toggle the side navigation
//     const sidebarToggle = document.body.querySelector('#sidebarToggle');
//     if (sidebarToggle) {
//         // Uncomment Below to persist sidebar toggle between refreshes
//         // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
//         //     document.body.classList.toggle('sb-sidenav-toggled');
//         // }
//         sidebarToggle.addEventListener('click', event => {
//             event.preventDefault();
//             document.body.classList.toggle('sb-sidenav-toggled');
//             localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
//         });
//     }

// });

$(document).ready(function ($) {
    $('#addNewUser').click(function () {
        // $('#userInserUpdateForm').trigger("reset");
        // $('#userModel').html("Add New User");
        // $('#user-model').modal('show');
        alert('wawawa');
    });
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
        // ajax
        $.ajax({
            type: "POST",
            url: "edit.php",
            data: { id: id },
            dataType: 'json',
            success: function (res) {
                $('#userModel').html("Edit User");
                $('#user-model').modal('show');
                $('#id').val(res.id);
                $('#name').val(res.name);
                $('#age').val(res.age);
                $('#email').val(res.email);
            }
        });
    });
    $('body').on('click', '.delete', function () {
        if (confirm("Delete Record?") == true) {
            var id = $(this).data('id');
            // ajax
            $.ajax({
                type: "POST",
                url: "delete.php",
                data: { id: id },
                dataType: 'json',
                success: function (res) {
                    $('#name').html(res.name);
                    $('#age').html(res.age);
                    $('#email').html(res.email);
                    window.location.reload();
                }
            });
        }
    });
    $('#userInserUpdateForm').submit(function () {
        // ajax
        $.ajax({
            type: "POST",
            url: "insert-update.php",
            data: $(this).serialize(), // get all form field value in 
            dataType: 'json',
            success: function (res) {
                window.location.reload();
            }
        });
    });
});
