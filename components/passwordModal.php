<div class="new-password-overlay">
    <div class="new-password-container" id="passwordModal">
        <div class="new-password-header">
        <h6>Update your Password</h6>
        <p>Enter your current password and a new password</p>
        </div>
        <div class="new-password-form">
            <form action="../php/Staffs/changePassword.php" method="POST" id="passwordForm">
            <input type="hidden" id="Name" name="Name" value="<?php echo htmlspecialchars($FirstName) . ' ' .  htmlspecialchars($LastName)?>">
            <input type="hidden" id="assignedPhoto" name="assignedPhoto" value="<?php echo htmlspecialchars($Photo)?>">
            <input type="hidden" id="Gender" name="Gender" value="<?php echo htmlspecialchars($Gender)?>">
            <div class="pass-form-group">
                    <h6>Current Password</h6>
                    <input type="password" id="currentPassword" name="currentPassword" required autocomplete="off" placeholder=" ">
                </div>
                <div class="pass-form-group">
                    <h6>New Password</h6>
                    <input type="password" id="newPassword" name="newPassword" required autocomplete="off" placeholder=" ">
                </div>
                <div class="pass-form-group">
                    <h6>Confirm New Password</h6>
                    <input type="password" id="confirmPassword" name="confirmPassword" required autocomplete="off" placeholder=" ">
                </div>
                <div id="message"></div>
                <input type="hidden" name="current_page" id="current_page" value="<?php echo htmlspecialchars($current_page); ?>">
        </div>
        <div class="new-password-footer">
            <a class="editProfile">Cancel</a>
            <button type="submit">Done</button>
        </div>
        </form>
    </div>
</div>

<script Ajax Password Handling>
  $(document).ready(function () {
        $("#passwordForm").on("submit", function (event) {
            event.preventDefault();

            const currentPassword = $("#currentPassword").val();
            const newPassword = $("#newPassword").val();
            const confirmPassword = $("#confirmPassword").val();
            const messageDiv = $("#message");
            const current_page = $("#current_page").val();
            const Name = $("#Name").val();
            const assignedPhoto = $("#assignedPhoto").val();
            const Gender = $("#Gender").val();

            messageDiv.empty();

            if (newPassword !== confirmPassword) {
                messageDiv.html('<p style="color: red;">New password and confirm password do not match.</p>');
                return;
            }

            const formData = {
                currentPassword: currentPassword,
                newPassword: newPassword,
                confirmPassword: confirmPassword,
                current_page: current_page,
                Name: Name,
                assignedPhoto: assignedPhoto,
                Gender: Gender
            };

            // AJAX request to change the password
            $.ajax({
                url: "../php/Staffs/changePassword.php",
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: response.message,
                        }).then(() => {
                            window.location.href = response.redirect;
                        });
                    } else {
                        messageDiv.html('<p style="color: red;">' + response.message + "</p>");
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Error details:", xhr.responseText); 
                    messageDiv.html('<p style="color: red;">An error occurred while processing the request.</p>');
                },
            });
        });
    });
</script>