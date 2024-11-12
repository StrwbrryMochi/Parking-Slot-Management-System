
<div class="option-overlay" onclick="closeOptionModal()"></div>
<div class="optionModal">
    <div class="optionButtons">
        <button id="view-Profile" 
                data-bs-toggle="modal"
                data-bs-target="#ViewProfile">
                <span><i class='bx bx-user' ></i>View Profile</span>
        </button>
        <button id="delete-User" onclick="confirmDelete(this)">
            <span><i class='bx bx-trash' ></i>Delete User</span><span class="caution">!</span>
        </button>
    </div>
</div>