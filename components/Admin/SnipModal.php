<div class="snip-overlay">
    <form action="../php/Logout.php" method="POST">
        <div class="snipModal">
            <div class="snip-bg">
                <div class="snip-profile">
                    <img class="profile-pic" src="<?php echo htmlspecialchars($Photo)?>" alt="">
                    <span class="snip-indicator"></span>
                </div>
            </div>
            <div class="snip-content">
                <div class="snip-info">
                    <span class="snip-name"><?php echo htmlspecialchars($FirstName) . ' ' . htmlspecialchars($LastName)?></span>
                    <span class="snip-email"><?php echo htmlspecialchars($Email)?></span>
                </div>
                <div class="snip-buttons">
                    <button type="button" class="viewProfile"><i class="fa-solid fa-user"></i> View Profile</button>
                    <button type="button" class="editProfile"><i class="fa-solid fa-pencil"></i> Edit Profile</button>
                </div>
                <div class="snip-logout">
                    <button type="submit" class="logout-button"><i class='bx bx-log-out'></i>Log Out</button>
                </div> 
            </div>
        </div>
    </form>
</div>
