<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Devices</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#addDeviceModal"><i class="fas fa-sm fa-plus"></i> Add Devices</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Application Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Application Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($devices as $device) : ?>
                        <tr>
                            <td><?php echo $device->device_name; ?></td>
                            <td><?php echo $device->application_name; ?></td>
                            <td><?php echo $device->created_at; ?></td>
                            <td>
                                <a href="<?php echo site_url('device/update/' . $device->id); ?>"
                                    class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editDeviceModal"
                                    data-id="<?php echo $device->id; ?>"
                                    data-device_name="<?php echo $device->device_name; ?>"
                                    data-application_name="<?php echo $device->application_name; ?>">Edit</a>
                                <a href="<?php echo site_url('device/delete/' . $device->id); ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this device?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Device -->
<!-- Modal for Adding Device -->
<div class="modal fade" id="addDeviceModal" tabindex="-1" aria-labelledby="addDeviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDeviceModalLabel">Add Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('device/store'); ?>
                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?= $user['id'] ?>"
                    required>
                <div class="form-group">
                    <label for="device_name">Device Name</label>
                    <input type="text" class="form-control" name="device_name" id="device_name"
                        value="<?php echo set_value('device_name'); ?>" required>
                    <?php echo form_error('device_name', '<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="application_name">Application Name</label>
                    <input type="text" class="form-control" name="application_name" id="application_name"
                        value="<?php echo set_value('application_name'); ?>" required>
                    <?php echo form_error('application_name', '<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="sensors">Sensors</label><br>
                    <input type="checkbox" name="sensors[]" value="Temperature"> Temperature<br>
                    <input type="checkbox" name="sensors[]" value="Humidity"> Humidity<br>
                    <input type="checkbox" name="sensors[]" value="Pressure"> Pressure<br>
                    <input type="checkbox" name="sensors[]" value="Light"> Light
                    <?php echo form_error('sensors', '<div class="text-danger">', '</div>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Add Device</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Editing Device -->
<div class="modal fade" id="editDeviceModal" tabindex="-1" aria-labelledby="editDeviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDeviceModalLabel">Edit Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('device/update'); ?>
                <input type="hidden" name="id" id="edit_device_id">
                <div class="form-group">
                    <label for="edit_device_name">Device Name</label>
                    <input type="text" class="form-control" name="device_name" id="edit_device_name" required>
                    <?php echo form_error('device_name', '<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="edit_application_name">Application Name</label>
                    <input type="text" class="form-control" name="application_name" id="edit_application_name" required>
                    <?php echo form_error('application_name', '<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="sensors">Sensors</label><br>
                    <input type="checkbox" name="sensors[]" value="Temperature" id="edit_sensor_temperature">
                    Temperature<br>
                    <input type="checkbox" name="sensors[]" value="Humidity" id="edit_sensor_humidity"> Humidity<br>
                    <input type="checkbox" name="sensors[]" value="Pressure" id="edit_sensor_pressure"> Pressure<br>
                    <input type="checkbox" name="sensors[]" value="Light" id="edit_sensor_light"> Light
                    <?php echo form_error('sensors', '<div class="text-danger">', '</div>'); ?>
                </div>
                <button type="submit" class="btn btn-primary">Update Device</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>



<script>
$('#editDeviceModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var device_name = button.data('device_name');
    var application_name = button.data('application_name');

    var modal = $(this);
    modal.find('#edit_device_id').val(id);
    modal.find('#edit_device_name').val(device_name);
    modal.find('#edit_application_name').val(application_name);
});
</script>