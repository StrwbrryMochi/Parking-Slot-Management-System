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
      
        </div>
        <img src="../img/intersecting-waves-scattered.svg" alt="">
      </div>
    </div>
  </div>
</div>

