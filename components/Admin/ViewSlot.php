<div class="modal fade" id="slotModal" tabindex="-1" aria-labelledby="slotModalLabel" aria-hidden="true">
  <div class="modal-dialog view">
    <div class="modal-content view">
      <div class="view-modal-header">
        <button
          type="button"
          class="btn-close custom-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        >
        <i class="fa-solid fa-circle-dot"></i>
      </button>
      </div>
      <div class="modal-body view">
        <div class="modal-contents view">
            <div class="view-slot-container">
                <div class="view-slot-header">Slot Details</div>
                <div class="slot-details">
                  <ul>
                    <li>
                      <div class="slot-icon"><i class="fa-solid fa-hashtag"></i></div>
                      <div class="slot-title">Slot</div>
                      <div class="slot-data">
                      <span id="modal-floor"></span>
                      <span id="modal-zone"></span>
                      <span id="modal-slot"></span>
                      </div>
                    </li>

                    <li>
                      <div class="slot-icon"><i class="fa-solid fa-id-card"></i></div>
                      <div class="slot-title">Plate No.</div>
                      <div class="slot-data">
                      <span id="modal-license-plate"></span>
                      </div>
                    </li>

                    <li>
                      <div class="slot-icon"><i class="fa-solid fa-user"></i></div>
                      <div class="slot-title">User</div>
                      <div class="slot-data">
                      <span id="modal-user-type"></span>
                      </div>
                    </li>

                    <li>
                      <div class="slot-icon"><i class="fa-solid fa-car"></i></div>
                      <div class="slot-title">Vehicle</div>
                      <div class="slot-data">
                      <span id="modal-vehicle-type"></span>
                      </div>
                    </li>

                    <li>
                      <div class="slot-icon"><i class="fa-solid fa-lock"></i></div>
                      <div class="slot-title">Status</div>
                      <div class="slot-data">
                      <span id="modal-status"></span>
                      </div>
                    </li>

                    <li>
                      <div class="slot-icon"><i class="fa-solid fa-clock"></i></div>
                      <div class="slot-title">Entry</div>
                      <div class="slot-data">
                      <span id="modal-time-in-field" style="display:none;"><span id="modal-time-in"></span></span>
                      </div>
                    </li>
                  </ul>
                  <input type="hidden" id="hidden-time-in" name="time-in">
                  <input type="hidden" id="hidden-page" name="current_page" value="<?php echo htmlspecialchars($current_page); ?>">
                </div>
            </div>
        </div>
        <div class="view-vehicle-type">

        </div>
      </div>
      <div class="modal-footer view">
        <div class="modal-footer-button view">
        <button 
        data-bs-toggle="modal"
        data-bs-target="#editSlotModal"
        id="edit-button"
        class="edit-button">
          <span class="tooltip edit">Edit</span>
          <span class="text"><i class="fas fa-edit"></i></span>
        </button>
        </div>
        <img src="../img/intersecting-waves-scattered.svg" alt="">
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("edit-button").addEventListener("click", function() {
  // Get data from view modal spans
  const floor = document.getElementById("modal-floor").innerText;
  const zone = document.getElementById("modal-zone").innerText;
  const slot = document.getElementById("modal-slot").innerText;
  const licensePlate = document.getElementById("modal-license-plate").innerText;
  const userType = document.getElementById("modal-user-type").innerText;
  const vehicleType = document.getElementById("modal-vehicle-type").innerText;
  const Status = document.getElementById("modal-status").innerText;

  const editButton = document.getElementById('edit-button');

  // Populate Display Tex for Floor, Zone, & Slot
  document.getElementById("display-floor-edit").value = floor;
  document.getElementById("display-zone-edit").value = zone;
  document.getElementById("display-slot-edit").value = slot;

  // Populate edit modal inputs
  document.getElementById("edit-plate-number").value = licensePlate;

  const occupiedInput = document.getElementById("OccupiedInput");
  const availableInput = document.getElementById("AvailableInput");
  const outOfServiceInput = document.getElementById("OutofServiceInput");

    // Check the respective radio button based on the status
    if (Status === "Occupied") {
        occupiedInput.removeAttribute('disabled', 'disabled');
        occupiedInput.checked = true;
    } else if (Status === "Available") {
        availableInput.checked = true;
        occupiedInput.setAttribute('disabled', 'disabled');
    } else if (Status === "Unavailable") {
        outOfServiceInput.checked = true;
        occupiedInput.setAttribute('disabled', 'disabled');
    }

// Function to manage vehicle type selection
function manageVehicleTypeSelection() {
    const carInput = document.getElementById("CarInputId");
    const motorcycleInput = document.getElementById("MotorcycleInputId");
    const bikeInput = document.getElementById("BikeInputId");

    // Reset all vehicle type inputs to enabled
    carInput.removeAttribute('disabled');
    motorcycleInput.removeAttribute('disabled');
    bikeInput.removeAttribute('disabled');

    // Disable inputs based on the detected vehicle type
    if (vehicleType === "Car") {
        motorcycleInput.setAttribute('disabled', 'disabled');
        bikeInput.setAttribute('disabled', 'disabled');
        carInput.checked = true; 
    } else if (vehicleType === "Motorcycle") {
        carInput.setAttribute('disabled', 'disabled'); 
        bikeInput.setAttribute('disabled', 'disabled');
        motorcycleInput.checked = true; 
    } else if (vehicleType === "Bicycle") {
        carInput.setAttribute('disabled', 'disabled'); 
        motorcycleInput.setAttribute('disabled', 'disabled');
        bikeInput.checked = true; 
    }
}

// Call the function to initialize the input states based on the current vehicle type
manageVehicleTypeSelection();

  const userTypeRadio = document.getElementsByName("user_type");
    userTypeRadio.forEach(radio => {
      if (radio.value === userType) {
        radio.checked = true;
      }
    });
});
</script>

