document.addEventListener("DOMContentLoaded", function () {
  const snippetOverlay = document.querySelector(".snippet-overlay");
  const snippetContainer = document.querySelector(".snippet-container");
  const snippetButton = document.getElementById("snippetButton");

  // Check if the elements exist
  if (snippetButton && snippetContainer && snippetOverlay) {
    snippetButton.addEventListener("click", function () {
      if (
        snippetContainer.style.display === "none" ||
        snippetContainer.style.display === ""
      ) {
        snippetOverlay.style.display = "block";
        snippetContainer.style.display = "block";

        setTimeout(() => {
          snippetOverlay.style.opacity = "1";
          snippetContainer.style.opacity = "1";
        }, 10);
      }
    });

    // Add a click event listener to the snippetOverlay to close both elements
    snippetOverlay.addEventListener("click", function () {
      snippetOverlay.style.opacity = "0";
      snippetContainer.style.opacity = "0";

      setTimeout(() => {
        snippetOverlay.style.display = "none";
        snippetContainer.style.display = "none";
      }, 300);
    });

    // Add a click event listener to the snippetContainer to stop propagation
    snippetContainer.addEventListener("click", function (event) {
      event.stopPropagation();
    });
  }
});
