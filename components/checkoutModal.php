<!-- Modal -->
<div
    class="modal fade"
    id="checkoutModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="checkoutModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Modal title
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="checkout-slot-data">
                    <input type="text" id="display-floor-checkout" name="floor" readonly>
                    <input type="text" id="display-zone-checkout" name="zone" readonly>
                    <input type="text" id="display-slot-checkout" name="slot_number" readonly>
                    </div>
                    <p id="checkout-license-plate"></p>
                    <p id="checkout-user-type"></p>
                    <p id="checkout-vehicle-type"></p>
                    <p id="checkout-time-in"></p>
                    <p id="checkout-time-out"></p>
                    <p id="checkout-duration"></p>
                    <input type="hidden" id="hidden-license-plate-checkout" name="plate_number">
                    <input type="hidden" id="hidden-user-type" name="user_type">
                    <input type="hidden" id="hidden-vehicle-type" name="vehicle_type">                
                    <input type="hidden" id="hidden-time-out" name="time_out">                    
                    <input type="hidden" id="hidden-duration" name="duration">                    
                    </form>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
