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
        <button class="checkout-button">
          <span class="tooltip checkout">Checkout</span>
          <span class="text"><i class="fas fa-check-circle"></i></span>
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

  // Populate edit modal inputs
  document.getElementById("edit-floor").value = floor;
  document.getElementById("edit-zone").value = zone;
  document.getElementById("edit-slot").value = slot;
  document.getElementById("edit-license-plate").value = licensePlate;
  document.getElementById("edit-user-type").value = userType;
  document.getElementById("edit-vehicle-type").value = vehicleType;
});
</script>