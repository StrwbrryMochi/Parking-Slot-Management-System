<div class="reserved-list-container">
  <div class="reserved-contents">
    <div class="list-header">Reserved Slots</div>
    <div class="list-group">
      <?php
      $fetchParking = fetchParking();

      foreach ($fetchParking as $reservedSlot):
        if ($reservedSlot['status'] == 'Reserved'):
      ?>
      <button
        class="view-list"
        data-slot-id="<?php echo htmlspecialchars($reservedSlot['slot_id']); ?>" 
        data-floor="<?php echo htmlspecialchars($reservedSlot['floor']); ?>" 
        data-zone="<?php echo htmlspecialchars($reservedSlot['zone']); ?>" 
        data-slot-number="<?php echo htmlspecialchars($reservedSlot['slot_number']); ?>" 
        data-plate-number="<?php echo htmlspecialchars($reservedSlot['plate_number']); ?>"
        data-user-type="<?php echo htmlspecialchars($reservedSlot['user_type']); ?>" 
        data-vehicle-type="<?php echo htmlspecialchars($reservedSlot['vehicle_type']); ?>"
        data-status="<?php echo htmlspecialchars($reservedSlot['status']); ?>"
        data-time-in="<?php echo htmlspecialchars($reservedSlot['time_in']); ?>"
        data-toggle="modal"
        data-target="#slotModal"
      >   
          #<?php echo htmlspecialchars($reservedSlot['zone']) . '' . htmlspecialchars($reservedSlot['slot_number'])?>
          -
          LVL
          <?php echo htmlspecialchars($reservedSlot['floor'])?>
      </button>
      <?php
      endif; 
      endforeach;
      ?>
    </div>
  </div>
</div>

<script>

</script>