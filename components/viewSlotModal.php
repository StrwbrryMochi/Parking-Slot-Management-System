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
        <button
        data-bs-toggle="modal"
        data-bs-target="#checkoutModal"
        id="checkout-button"
        class="checkout-button">
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
  const Status = document.getElementById("modal-status").innerText;

  // Populate Display Tex for Floor, Zone, & Slot
  document.getElementById("display-floor-edit").value = floor;
  document.getElementById("display-zone-edit").value = zone;
  document.getElementById("display-slot-edit").value = slot;

  // Populate edit modal inputs
  document.getElementById("edit-plate-number").value = licensePlate;
  document.getElementById("display-status").innerText = Status;

  const vehicleTypeRadio = document.getElementsByName("vehicle_type");
    vehicleTypeRadio.forEach(radio => {
      if (radio.value === vehicleType) {
        radio.checked = true;
      }
    });

  const userTypeRadio = document.getElementsByName("user_type");
    userTypeRadio.forEach(radio => {
      if (radio.value === userType) {
        radio.checked = true;
      }
    });
});
</script>

<script>
  document.getElementById("checkout-button").addEventListener("click", function() {
    // Get Data from the Modal
    const floor = document.getElementById("modal-floor").innerText;
    const zone = document.getElementById("modal-zone").innerText;
    const slot = document.getElementById("modal-slot").innerText;
    const licensePlate = document.getElementById("modal-license-plate").innerText;
    const userType = document.getElementById("modal-user-type").innerText;
    const vehicleType = document.getElementById("modal-vehicle-type").innerText;
    const timeIn = document.getElementById("hidden-time-in").value;

    // Create a Date object from the timeIn value
    const EntryDate = new Date(timeIn);

    // Check if the date was created successfully
    if (isNaN(EntryDate.getTime())) {
        console.error("Invalid date format:", timeIn);
    } else {
        // Format the timeIn for display
        const timeInFormattedText = EntryDate.toLocaleString('en-US', { 
            year: 'numeric', 
            month: '2-digit', 
            day: '2-digit', 
            hour: '2-digit', 
            minute: '2-digit', 
            hour12: true,
            timeZone: 'Asia/Manila' 
        });

        // Set the formatted timeIn to the display element
        document.getElementById("checkout-time-in").innerText = timeInFormattedText;

        // Debugging line to verify formatted output
        console.log("Formatted Time In:", timeInFormattedText);
    }

    // Display the Corresponding Floor, Zone, and Slot in Text Inputs
    document.getElementById("display-floor-checkout").value = floor;
    document.getElementById("display-zone-checkout").value = zone;
    document.getElementById("display-slot-checkout").value = slot;

    // Hide the Data Inputs
    document.getElementById("hidden-license-plate-checkout").value = licensePlate;
    document.getElementById("hidden-user-type").value = userType;
    document.getElementById("hidden-vehicle-type").value = vehicleType;

    // Display Corresponding Data as Text
    document.getElementById("checkout-license-plate").innerText = licensePlate;
    document.getElementById("checkout-user-type").innerText = userType;
    document.getElementById("checkout-vehicle-type").innerText = vehicleType;
    
    const currentTime = new Date();

    const timeOutFormatted = currentTime.getFullYear() + '-' +
          String(currentTime.getMonth() + 1).padStart(2, '0') + '-' +
          String(currentTime.getDate()).padStart(2, '0') + ' ' +
          String(currentTime.getHours()).padStart(2, '0') + ':' +
          String(currentTime.getMinutes()).padStart(2, '0') + ':' +
          String(currentTime.getSeconds()).padStart(2, '0');

    document.getElementById("hidden-time-out").value = timeOutFormatted;

    // Format the Exit time
    const timeOutFormattedText = currentTime.toLocaleString('en-US', { 
        year: 'numeric', 
        month: '2-digit', 
        day: '2-digit', 
        hour: '2-digit', 
        minute: '2-digit', 
        hour12: true, 
    });

    document.getElementById("checkout-time-out").innerText = timeOutFormattedText;

    const timeInDate = new Date(timeIn);
    if (isNaN(timeInDate.getTime())) {
        console.error('Invalid Time Value: ', timeIn);
    } else {
        // Calculate the duration in Milliseconds
        const durationMs = currentTime - timeInDate;
        
        // Log the time values for debugging
        console.log("Current Time: ", currentTime);
        console.log("Formatted Time Out:", timeOutFormattedText);
        console.log("Time In: ", timeInDate);
        console.log("Duration in Milliseconds: ", durationMs);

        // Convert Milliseconds to Days, Hours, Minutes, and Seconds
        const durationDays = Math.floor(durationMs / (1000 * 60 * 60 * 24));
        const remainingMsAfterDays = durationMs % (1000 * 60 * 60 * 24);
        const durationHrs = Math.floor(remainingMsAfterDays / (1000 * 60 * 60));
        const remainingMsAfterHours = remainingMsAfterDays % (1000 * 60 * 60);
        const durationMins = Math.floor(remainingMsAfterHours / (1000 * 60));
        const durationSecs = Math.floor((remainingMsAfterHours % (1000 * 60)) / 1000);

        // Log the calculated duration components
        console.log("Duration Days: ", durationDays);
        console.log("Duration Hours: ", durationHrs);
        console.log("Duration Minutes: ", durationMins);
        console.log("Duration Seconds: ", durationSecs);

        // Ensure a minimum of 1 hour is charged
        const chargeableDurationHrs = Math.max(1, Math.ceil(durationHrs + (durationMins > 0 ? 1 : 0)));

        // Calculate total hours considering the days
        const totalHours = (durationDays * 24) + durationHrs;

        // Format the actual Duration as 'HH:mm:ss'
        const formattedDuration = String(totalHours).padStart(2, '0') + ':' +
            String(durationMins).padStart(2, '0') + ':' +
            String(durationSecs).padStart(2, '0');

        // Set value to hidden-duration input in 'HH:mm:ss' format
        document.getElementById("hidden-duration").value = formattedDuration;

        // Display Human-readable text including days if applicable
        let formattedDurationText = '';
        const components = [];

        if (durationDays > 0) {
            components.push(durationDays + (durationDays === 1 ? ' day ' : ' days '));
        }
        if (durationHrs > 0) {
            components.push(durationHrs + (durationHrs === 1 ? ' hour ' : ' hours '));
        }
        if (durationMins > 0) {
            components.push(durationMins + (durationMins === 1 ? ' minute ' : ' minutes '));
        }

        // Handle seconds
        if (components.length === 0) {
            components.push(durationSecs + (durationSecs === 1 ? ' second' : ' seconds'));
        }

        // Combine Components
        if (components.length > 1) {
            const lastComponent = components.pop();
            formattedDurationText = components.join(', ') + ' and ' + lastComponent;
        } else if (components.length === 1) {
            formattedDurationText = components[0];
        }

        // Add total hours representation
        formattedDurationText += ` (${totalHours} hour${totalHours === 1 ? '' : 's'})`;

        // Trim Any Extra Spaces
        formattedDurationText = formattedDurationText.trim();

        // Display the Human-readable Duration text in the checkout-duration element
        document.getElementById("checkout-duration").innerText = formattedDurationText;
    }
});

</script>