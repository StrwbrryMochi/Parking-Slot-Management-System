<div class="col-lg-2">
    <div class="sidebar-right">
        <div class="img">
            <div class="image-wrapper">
                <img src="./img/sp.jpg" alt="User Image">
            </div>
            <div class="text-wrapper">
                <h5>Ms. Crystal</h5>
                <p>Cashier</p>
            </div>
        </div>

        <div class="container">
            <!-- Main Buttons -->
            <div id="mainButtonsSidebar" class="list-group">
                <button id="paymentButtonSidebar" class="btn btn-custom">Payment (F1)</button>
                <button id="addButtonSidebar" class="btn btn-custom">Add (F2)</button>
                <button id="voidButtonSidebar" class="btn btn-custom">Void (F3)</button>
                <button id="rewardCardButtonSidebar" class="btn btn-custom">Reward Card (F4)</button>
                <button id="concernButtonSidebar" class="btn btn-custom">Concern (F5)</button>
            </div>

            <!-- Nested Content Section -->
            <div id="nestedContentSidebar" style="display: none;">
                <!-- Payment Section -->
                <div id="paymentSectionSidebar" style="display: none;">
                    <button class="btn btn-custom" id="cashPaymentButtonSidebar">Cash</button>
                        <!-- Payment Modal -->
                        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true"> 
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModalLabel">Process Payment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="paymentForm" method="POST" action="process_payment.php">
                                            <div class="mb-3">
                                                <label for="searchCardNumber" class="form-label">Search Card Number</label>
                                                <input type="text" class="form-control" id="searchCardNumber" name="searchCardNumber" autocomplete="Card-Number" />
                                                <button type="button" class="btn btn-primary mt-2" id="searchButton">Search</button>
                                            </div>
                                            <div id="recordDetails" style="display: none;">
                                                <div class="mb-3">
                                                    <label for="cardNumber" class="form-label">Card Number</label>
                                                    <input type="text" class="form-control" id="cardNumber" name="cardNumber" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="charge" class="form-label">Charge</label>
                                                    <input type="text" class="form-control" id="charge" name="charge" readonly>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Process Payment</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    <button class="btn btn-custom" id="debitButtonSidebar">Debit Card</button>
                    <button class="btn btn-custom" id="creditButtonSidebar">Credit Card</button>
                    <button class="btn btn-custom" id="paymentBackButtonSidebar">Back</button>
                </div>

                <!-- Add Section -->
                <div id="addSectionSidebar" style="display: none;">
                    <button class="btn btn-custom" id="addButtonSidebar" data-bs-toggle="modal" data-bs-target="#addRecordModal">New</button>

                        <!-- Add Record Modal -->
                        <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addRecordModalLabel">Add New Parking Record</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form id="addRecordForm" method="POST" action="add_record.php">
                                        <div class="mb-3">
                                            <label for="cardNumber" class="form-label">Card Number</label>
                                            <input type="number" class="form-control" id="cardNumber" name="cardNumber" required autocomplete="cc-number">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required autocomplete="name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="plateNumber" class="form-label">Plate Number</label>
                                            <input type="text" class="form-control" id="plateNumber" name="plateNumber" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label for="contactNumber" class="form-label">Contact Number</label>
                                            <input type="tel" class="form-control" id="contactNumber" name="contactNumber" required autocomplete="tel">
                                        </div>
                                        <div class="mb-3">
                                            <label for="duration" class="form-label">Duration (Minutes)</label>
                                            <input type="number" class="form-control" id="duration" name="duration" required autocomplete="off">
                                        </div>
                                        <div class="mb-3">
                                            <label for="vehicleType" class="form-label">Type</label>
                                            <select class="form-select" id="vehicleType" name="vehicleType" required autocomplete="off">
                                                <option value="CAR">CAR</option>
                                                <option value="VAN">VAN</option>
                                                <option value="SUV">SUV</option>
                                                <option value="TRUCK">TRUCK</option>
                                                <option value="MOTORCYCLE">MOTORCYCLE</option>
                                                <option value="ELECTRIC VEHICLE">ELECTRIC VEHICLE</option>
                                            </select>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" form="addRecordForm">Save Record</button>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    <button class="btn btn-custom" id="existingButtonSidebar">Existing</button>
                    <button class="btn btn-custom" id="addBackButtonSidebar">Back</button>
                </div>


                <!-- Void Section -->
                <div id="voidSectionSidebar" style="display: none;">
                    <p>Void an item.</p>
                    <button class="btn btn-custom" id="voidBackButtonSidebar">Back</button>
                </div>

                <!-- Reward Card Section -->
                <div id="rewardCardSectionSidebar" style="display: none;">
                    <p>Use a Reward Card.</p>
                    <button class="btn btn-custom" id="rewardBackButtonSidebar">Back</button>
                </div>

                <!-- Concern Section -->
                <div id="concernSectionSidebar" style="display: none;">
                    <p>Raise a Concern.</p>
                    <button class="btn btn-custom" id="concernBackButtonSidebar">Back</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

