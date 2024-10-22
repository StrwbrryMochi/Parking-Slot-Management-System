document.addEventListener("DOMContentLoaded", function () {
  const snippetOverlay = document.querySelector(".snippet-overlay");
  const snippetContainer = document.querySelector(".snippet-container");
  const snippetButton = document.getElementById("snippetButton");

  // Check if the elements exist
  if (snippetButton && snippetContainer && snippetOverlay) {
    // Add a click event listener to the snippetButton
    snippetButton.addEventListener("click", function () {
      if (
        snippetContainer.style.display === "none" ||
        snippetContainer.style.display === ""
      ) {
        snippetOverlay.style.display = "block";
        snippetContainer.style.display = "block";

        setTimeout(() => {
          snippetOverlay.style.opacity = "1"; // Fade in overlay
          snippetContainer.style.opacity = "1"; // Fade in snippet container
        }, 10);
      }
    });

    // Add a click event listener to the snippetOverlay to close both elements
    snippetOverlay.addEventListener("click", function () {
      snippetOverlay.style.opacity = "0"; // Fade out overlay
      snippetContainer.style.opacity = "0"; // Fade out snippet container

      setTimeout(() => {
        snippetOverlay.style.display = "none"; // Hide overlay
        snippetContainer.style.display = "none"; // Hide snippet container
      }, 300); // Match with the CSS transition duration
    });

    // Add a click event listener to the snippetContainer to stop propagation
    snippetContainer.addEventListener("click", function (event) {
      event.stopPropagation(); // Prevent click from closing the overlay
    });
  }
});
