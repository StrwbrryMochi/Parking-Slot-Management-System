<!-- Modal -->
<div
    class="modal fade"
    id="editSlotModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editslotModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Edit Modal
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <input type="text" id="edit-floor" name="floor">
                    <input type="text" id="edit-zone" name="zone">
                    <input type="text" id="edit-slot" name="slot">
                    <input type="text" id="edit-license-plate" name="license_plate">
                    <input type="text" id="edit-user-type" name="user_type">
                    <input type="text" id="edit-vehicle-type" name="vehicle_type">
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
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    var modalId = document.getElementById('modalId');

    modalId.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          let button = event.relatedTarget;
          // Extract info from data-bs-* attributes
          let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });
</script>
