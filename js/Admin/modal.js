const User = document.querySelector(".user-container");
const snippetModal = document.querySelector(".snipModal");
const snippetOverlay = document.querySelector(".snip-overlay");

const editProfileButton = document.querySelector(".editProfile");
const editProfileModal = document.querySelector(".editProfile-Container");
const editProfileOverlay = document.querySelector(".editProfile-Overlay");
const editClose = document.querySelector(".close-btn");
const openviewProfile = document.getElementById("viewProfile");

const profileModalButton = document.querySelector(".viewProfile");
const profileModalOverlay = document.querySelector(".profileModal-Overlay");
const profileModal = document.querySelector(".profileModal-Container");
const openEditProfile = document.getElementById("editProfile");

const passwordButton = document.getElementById("newPass");
const passwordModal = document.querySelector(".new-password-container");
const passwordModalOverlay = document.querySelector(".new-password-overlay");
const passwordBackButton = document.getElementById("editProfileButton");

// Utility function to close a specific modal
function closeModal(modal, overlay) {
  modal.style.transition = "transform 0.3s ease, opacity 0.3s ease";
  modal.style.transform = "translateY(-20px)";
  modal.style.opacity = "0";
  setTimeout(() => {
    overlay.style.display = "none";
    modal.style.display = "none";
  }, 300);
}

// Open modal with transition
function openModal(modal, overlay) {
  // Check if any modal is already open and close it before opening the new one
  if (getComputedStyle(snippetModal).display === "block") {
    closeModal(snippetModal, snippetOverlay);
  }
  if (getComputedStyle(editProfileModal).display === "block") {
    closeModal(editProfileModal, editProfileOverlay);
  }
  if (getComputedStyle(profileModal).display === "block") {
    closeModal(profileModal, profileModalOverlay);
  }
  if (getComputedStyle(passwordModal).display === "block") {
    closeModal(passwordModal, passwordModalOverlay);
  }

  // Open the requested modal
  overlay.style.display = "block";
  modal.style.display = "block";
  setTimeout(() => {
    modal.style.transition = "transform 0.3s ease, opacity 0.3s ease";
    modal.style.transform = "translateY(0)";
    modal.style.opacity = "1";
  }, 10);
}

// Event listener for User profile snippet modal
User.addEventListener("click", function () {
  const isHidden = getComputedStyle(snippetModal).display === "none";
  if (isHidden) {
    openModal(snippetModal, snippetOverlay);
  } else {
    closeModal(snippetModal, snippetOverlay);
  }
});

// Event listener for Edit profile modal
editProfileButton.addEventListener("click", function () {
  const isHidden = getComputedStyle(editProfileModal).display === "none";
  if (isHidden) {
    openModal(editProfileModal, editProfileOverlay);
  } else {
    closeModal(editProfileModal, editProfileOverlay);
  }
});

// Event listener for view profile modal
profileModalButton.addEventListener("click", function () {
  const isHidden = getComputedStyle(profileModal).display === "none";
  if (isHidden) {
    openModal(profileModal, profileModalOverlay);
  } else {
    closeModal(profileModal, profileModalOverlay);
  }
});

openEditProfile.addEventListener("click", function () {
  const isHidden = getComputedStyle(editProfileModal).display === "none";
  if (isHidden) {
    openModal(editProfileModal, editProfileOverlay);
  } else {
    closeModal(editProfileModal, editProfileOverlay);
  }
});

openviewProfile.addEventListener("click", function () {
  const isHidden = getComputedStyle(profileModal).display === "none";
  if (isHidden) {
    openModal(profileModal, profileModalOverlay);
  } else {
    closeModal(profileModal, profileModalOverlay);
  }
});

passwordButton.addEventListener("click", function () {
  const isHidden = getComputedStyle(passwordModal).display === "none";
  if (isHidden) {
    openModal(passwordModal, passwordModalOverlay);
  } else {
    closeModal(passwordModal, passwordModalOverlay);
  }
});

passwordModalOverlay.addEventListener("click", function () {
  const isHidden = getComputedStyle(editProfileModal).display === "none";
  if (isHidden) {
    openModal(editProfileModal, editProfileOverlay);
  } else {
    closeModal(editProfileModal, editProfileOverlay);
  }
});

passwordBackButton.addEventListener("click", function () {
  const isHidden = getComputedStyle(editProfileModal).display === "none";
  if (isHidden) {
    openModal(editProfileModal, editProfileOverlay);
  } else {
    closeModal(editProfileModal, editProfileOverlay);
  }
});

// Overlay click events to close modals
snippetOverlay.addEventListener("click", () =>
  closeModal(snippetModal, snippetOverlay)
);
editProfileOverlay.addEventListener("click", () =>
  closeModal(editProfileModal, editProfileOverlay)
);
editClose.addEventListener("click", () =>
  closeModal(editProfileModal, editProfileOverlay)
);
profileModalOverlay.addEventListener("click", () =>
  closeModal(profileModal, profileModalOverlay)
);

[snippetModal, editProfileModal, profileModal, passwordModal].forEach(
  (modal) => {
    modal.addEventListener("click", (event) => event.stopPropagation());
  }
);

// Close modals on vertical scroll
window.addEventListener("scroll", function () {
  const scrollThreshold = window.innerHeight * 0.2;
  if (window.scrollY > scrollThreshold) {
    closeModal(snippetModal, snippetOverlay);
    closeModal(editProfileModal, editProfileOverlay);
    closeModal(profileModal, profileModalOverlay);
  }
});
