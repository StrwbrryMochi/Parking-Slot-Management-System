let currentFloor = 1;
const totalFloors = 5;

const updateFloor = () => {
  // Hide all floors
  document.querySelectorAll(".floor").forEach((floor) => {
    floor.classList.remove("active");
  });

  // Show the current floor
  document.getElementById(`floor-${currentFloor}`).classList.add("active");

  // Update floor indicator
  document.querySelector(
    ".floor-indicator"
  ).textContent = `Floor ${currentFloor}`;
};

// Handle previous floor button
document.querySelector(".prev-floor").addEventListener("click", () => {
  if (currentFloor > 1) {
    currentFloor--;
    updateFloor();
  }
});

// Handle next floor button
document.querySelector(".next-floor").addEventListener("click", () => {
  if (currentFloor < totalFloors) {
    currentFloor++;
    updateFloor();
  }
});

updateFloor();
