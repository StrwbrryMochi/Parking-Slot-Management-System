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
            <div class="modal-body checkout">
                <form action="../php/parkingExecute.php" method="POST">
                    <div class="checkout-data">
                       
                            <div class="qr-code-container">
                                <div class="qr-overlay">
                                <canvas id="qrcode"></canvas>
                                </div>
                            </div>
                     
                            <div class="checkout-slot-data">
                            <input type="text" id="display-floor-checkout" name="floor" readonly>
                            <input type="text" id="display-zone-checkout" name="zone" readonly>
                            <input type="text" id="display-slot-checkout" name="slot_number" readonly>
                            </div>
                        
                            <div class="slot-data-checkout">
                            <div class="slot-identifier">Plate No.</div>
                            <div class="slot-text"><p id="checkout-license-plate"></p></div>
                            </div>

                            <div class="slot-data-checkout">
                            <div class="slot-identifier">Vehicle</div>
                            <div class="slot-text"><p id="checkout-vehicle-type"></p></div>
                            </div>

                            <div class="slot-data-checkout">
                            <div class="slot-identifier">Entry</div>
                            <div class="slot-text"><p id="checkout-time-in"></p></div>
                            </div>

                            <div class="slot-data-checkout">
                            <div class="slot-identifier">Exit</div>
                            <div class="slot-text"><p id="checkout-time-out"></p></div>
                            </div>

                            <div class="slot-data-checkout">
                            <div class="slot-identifier">Duration</div>
                            <div class="slot-text"><p id="checkout-duration"></p></div>
                            </div>
                            
                            <div class="total-header">Total:</div>
                            <div class="slot-total">
                                <div class="total-fee">
                                <i class="fa-solid fa-peso-sign"></i><span id="checkout-fee"></span>
                                </div>
                            </div>

                            <div class="checkout-footer">
                                <button type="submit" name="checkoutSlot"><i class="fa-solid fa-check"></i></button>
                            </div>
                    </div>
                    <input type="hidden" name="current_page" value="<?php echo htmlspecialchars($current_page); ?>">
                    <input type="hidden" id="hidden-license-plate-checkout" name="plate_number">
                    <input type="hidden" id="hidden-user-type" name="user_type">
                    <input type="hidden" id="hidden-vehicle-type" name="vehicle_type">        
                    <input type="hidden" id="hidden-status" name="status">        
                    <input type="hidden" id="form-time-in" name="time_in">             
                    <input type="hidden" id="hidden-time-out" name="time_out">                    
                    <input type="hidden" id="hidden-duration" name="duration">               
                    <input type="hidden" id="hidden-fee" name="fee">               
            </div>
            <div class="divider"></div>
        </div>
        </form>
        <div class="container-footer">
             <img src="../img/triangle-rounded-divider.svg" alt="">
        </div>
    </div>
</div>

<script>
 function generateQRCode() {
    // Fetch the values of the populated inputs
    const floor = document.getElementById("display-floor-checkout").value;
    const zone = document.getElementById("display-zone-checkout").value;
    const slot = document.getElementById("display-slot-checkout").value;
    const plateNumber = document.getElementById("hidden-license-plate-checkout").value;
    const userType = document.getElementById("hidden-user-type").value;
    const vehicleType = document.getElementById("hidden-vehicle-type").value;
    const status = document.getElementById("hidden-status").value;
    const timeIn = document.getElementById("form-time-in").value;
    const timeOut = document.getElementById("hidden-time-out").value;
    const duration = document.getElementById("hidden-duration").value;
    const fee = document.getElementById("hidden-fee").value;

    // Prepare data for QR code
    const qrData = {
        floor,
        zone,
        slot,
        plateNumber,
        userType,
        vehicleType,
        status,
        timeIn,
        timeOut,
        duration,
        fee
    };

    const qrString = JSON.stringify(qrData);

    // Generate the QR code using QRious
    const qrCodeElement = document.getElementById('qrcode');
    const qr = new QRious({
        element: qrCodeElement,
        value: qrString,
        size: 172,
    });


    // Attach the click event listener to the QR code canvas
    qrCodeElement.addEventListener('click', function() {
        
        // Create a new image element from the canvas
        const qrImage = qrCodeElement.toDataURL("image/png");

        // Create anew window for printing with a specific size
        const printWindow = window.open('', '', 'width=1200, height=800');

        printWindow.document.write('<html><head><title>Print QR Code</title>');
        printWindow.document.write('<style>body { text-align: center; }</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<h1>Parking Receipt</h1>');
        printWindow.document.write('<img src="' + qrImage + '" style="max-width: 100%; height: auto;"/>'); 
        printWindow.document.write('<h3>Hi</h3>')
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Wait for the new window to load before printing
        printWindow.onload = function() {
            printWindow.print();
            printWindow.close(); 
        };
    });

    // Attach the click event listener to the wrapper
    const qrWrapper = document.querySelector('.qr-code-container');
    qrWrapper.addEventListener('click', function() {
        // Trigger the click event on the QR code canvas
        qrCodeElement.click();
    });
}
</script>