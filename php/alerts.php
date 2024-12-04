<?php 

//* Login & Register
// Welcome Staff
if (isset($_GET['welcome_user']) && $_GET['welcome_user'] == 'true') {
    $profilePhoto = $Photo;  
    
    echo "<script>
            setTimeout(function() {
            var username = '" . $FirstName . "';
            var profilePhoto = '" . $Photo . "'; 

            Swal.fire({
                position: 'top',
                title: '<span style=\"color: white;\">Welcome, </span><span style=\"color: #53539b; margin: 0 5px;\">' + username + '</span><span style=\"color: white;\">!</span>',
                showConfirmButton: false,
                timer: 2000,
                html: '<img src=\"' + profilePhoto + '\" style=\"width: 100px; height: 100px; border-radius: 50%; object-fit: cover;\">',
                background: 'rgb(18,21,31,255)',
            });
        }, 5000); 
    </script>";
}

if (isset($_GET['register_success']) && $_GET['register_success'] == 'true') {
    echo "<script>
            setTimeout(function() {
            var username = '" . $FirstName . "';

            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Account successfully created,' + username + '!',
                timer: 2000
            });
        }, 5000);      
    </script>";
}

if (isset($_GET['email_error']) && $_GET['email_error'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Account does not Exist!',
            timer: 2000
        });
    </script>";
}

if (isset($_GET['password_error']) && $_GET['password_error'] == 'true') {
    $attemptsLeft = isset($_GET['attempts_left']) ? intval($_GET['attempts_left']) : 0;

    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Password Incorrect! You have " . $attemptsLeft . " attempts remaining.',
            timer: 2000
        });
    </script>";
} elseif (isset($_GET['account_blocked']) && $_GET['account_blocked'] == 'true') {
    $lockoutDuration = isset($_GET['lockout_duration']) ? intval($_GET['lockout_duration']) / 60 : 15;

    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Account Blocked!',
            text: 'You have exceeded the maximum number of login attempts. Your account is temporarily locked. Try again in " . $lockoutDuration . " minutes.'
        });
    </script>";
}

//* Parking Slot Management
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