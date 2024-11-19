<?php

if (isset($_GET['slot_reserved']) && $_GET['slot_reserved'] == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Slot Reserved Successfully!',
        });
    </script>";
}