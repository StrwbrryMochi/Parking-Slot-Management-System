document.addEventListener("DOMContentLoaded", () => {
  const section1 = document.getElementById("section1");
  const section2 = document.getElementById("section2");
  const showSection1Btn = document.getElementById("showSection1Btn");
  const showSection2Btn = document.getElementById("showSection2Btn");

  // Set initial state
  section1.style.opacity = "1";
  section1.style.pointerEvents = "auto";
  section2.style.opacity = "0";
  section2.style.pointerEvents = "none";

  // Show Section 1
  showSection1Btn.addEventListener("click", () => {
    section2.style.opacity = "0";
    section2.style.pointerEvents = "none";
    setTimeout(() => {
      section1.style.opacity = "1";
      section1.style.pointerEvents = "auto";
    }, 300);
  });

  // Show Section 2
  showSection2Btn.addEventListener("click", () => {
    section1.style.opacity = "0";
    section1.style.pointerEvents = "none";
    setTimeout(() => {
      section2.style.opacity = "1";
      section2.style.pointerEvents = "auto";
    }, 300);
  });
});
