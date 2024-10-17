<!-- Modal -->
<div
    class="modal fade"
    id="checkoutModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="checkoutModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog checkout" role="document">
        <div class="modal-content checkout">
            <div class="checkout-modal-header">
                <button
                type="button"
                class="btn-close custom-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                >
                <i class="fa-solid fa-circle-dot"></i>
                </button>
            </div>
            <div class="modal-body checkout">
                <div class="slot-barcode-container">
                </div>
                <div class="checkout-data-container">
                <form action="../php/parkingExecute.php" method="POST">
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
                    <p id="checkout-fee"></p>
                    <input type="hidden" id="hidden-license-plate-checkout" name="plate_number">
                    <input type="hidden" id="hidden-user-type" name="user_type">
                    <input type="hidden" id="hidden-vehicle-type" name="vehicle_type">        
                    <input type="hidden" id="hidden-status" name="status">        
                    <input type="hidden" id="form-time-in" name="time_in">             
                    <input type="hidden" id="hidden-time-out" name="time_out">                    
                    <input type="hidden" id="hidden-duration" name="duration">               
                    <input type="hidden" id="hidden-fee" name="fee">               
                </div>  
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Close
                </button>
                <button type="submit" class="btn btn-primary" name="checkoutSlot">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>
