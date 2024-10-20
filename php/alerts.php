<?php 

// Add
if (isset($_GET['add_slot']) && $_GET['add_slot'] == 'true') {
    echo "<script>
        toastr.success(' ', 'Slot Added');

        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: false,
            progressBar: false,
            positionClass: 'toast-top-right',
            preventDuplicates: true,
            onclick: null,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };
    </script>";
}

// Edit
if (isset($_GET['edit_slot']) && $_GET['edit_slot'] == 'true') {
    echo "<script>
        toastr.success(' ', 'Slot Edited');

        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: false,
            progressBar: false,
            positionClass: 'toast-top-right',
            preventDuplicates: true,
            onclick: null,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };
    </script>";
}

// Checkout
if (isset($_GET['checkout_slot']) && $_GET['checkout_slot'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Checkout Complete!',
        });
    </script>";
}