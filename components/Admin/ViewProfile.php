
<!-- Modal -->
<div
    class="modal fade"
    id="ViewProfile"
    tabindex="-1"
    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div class="modal-dialog profile" role="document">
        <div class="modal-content profile">
            <div class="modal-body admin">
                <div class="profile-bg">
                    <div class="photo-container">
                        <img class="UserImage" id="user-photo" alt="User Photo"/>
                        <div class="image-indicator">
                            <div class="indicator-lg"></div>
                        </div>
                    </div>
                </div>
                <div class="user-details">
                    <div class="user-profile">
                        <div class="user-name">
                            <span id="span-firstname"></span>
                            <span id="span-lastname"></span>
                        </div>
                        <div class="user-email">
                            <span id="span-email"></span>
                        </div>
                    </div>

                    <div class="profile-row" id="first-row">
                        <div class="profile-title">Gender</div>
                        <div class="profile-data">
                            <span id="span-gender">
                                <i id="genderIcon"></i>
                                <span id="genderText"></span>
                            </span>
                        </div>
                    </div>

                    <div class="active-wrapper">
                        <span>Last Active: &nbsp</span>
                        <span id="span-lastactive" class="Last-active"></span>
                    </div>

                    <div class="profile-row">
                        <div class="profile-title">Birth Date</div>
                        <div class="profile-data">
                            <span id="span-birthdate"></span>
                        </div>
                    </div>
                    
                    <div class="profile-row">
                        <div class="profile-title">Address</div>
                        <div class="profile-data">
                            <span id="span-address"></span>
                        </div>
                    </div>

                    <div class="profile-row">
                        <div class="profile-title">Phone Number</div>
                        <div class="profile-data">
                            <span id="span-phonenumber"></span>
                        </div>
                    </div>

                    <div class="profile-row">
                        <div class="profile-title">Permissions</div>
                        <div class="profile-data">
                            <span id="span-accounttype"></span>
                        </div>
                    </div>
                    
                    <div class="profile-row" id="last-row">
                        <div class="profile-title">Joined</div>
                        <div class="profile-data">
                            <span id="span-joined"></span>
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
    </div>
</div>
