<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>&copy; <?= date('Y') ?> AEC22. All rights reserved.</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/dist/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/dist/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/dist/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/dist/js/sb-admin-2.min.js'); ?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/dist/vendor/chart.js/Chart.min.js'); ?>"></script>
<script src="<?= base_url('assets/dist/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/dist/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/dist/js/demo/datatables-demo.js'); ?>"></script>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>

<script>
$(document).ready(function() {
    var devices = <?php echo json_encode($devices); ?>;
    var sensorCharts = {};

    // Initialize charts for each device and sensor
    devices.forEach(function(device) {
        var deviceSensors = device.sensors.split(',');
        deviceSensors.forEach(function(sensor) {
            var trimmedSensor = sensor.trim();
            var ctx = document.getElementById(device.id + '-' + trimmedSensor + 'Chart')
                .getContext('2d');
            var label = trimmedSensor.charAt(0).toUpperCase() + trimmedSensor.slice(
                1); // Capitalize first letter
            sensorCharts[device.id + '-' + trimmedSensor] = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: label, // Use capitalized label
                        data: [],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'minute',
                                parser: 'HH:mm:ss',
                                tooltipFormat: 'HH:mm'
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    });

    function fetchSensorData(device_id) {
        $.ajax({
            url: "<?php echo base_url('MqttController/get_sensor_data'); ?>/" + device_id,
            method: "GET",
            success: function(data) {
                try {
                    var result = JSON.parse(data);
                    var sensorData = {};

                    devices.forEach(function(device) {
                        if (device.id == device_id) {
                            var deviceSensors = device.sensors.split(',');
                            deviceSensors.forEach(function(sensor) {
                                sensorData[device.id + '-' + sensor.trim()] = {
                                    labels: [],
                                    data: []
                                };
                            });
                        }
                    });

                    result.forEach(function(entry) {
                        var sensor_data = entry.data;
                        var timestamp = entry.timestamp.split(' ')[1];
                        var data_parts = sensor_data.split(', ');

                        data_parts.forEach(function(part) {
                            devices.forEach(function(device) {
                                if (device.id == device_id) {
                                    var deviceSensors = device.sensors
                                        .split(',');
                                    deviceSensors.forEach(function(sensor) {
                                        var trimmedSensor = sensor
                                            .trim();
                                        if (part.includes(
                                                trimmedSensor)) {
                                            var value = part.split(
                                                '=')[1].trim();
                                            var key = device.id +
                                                '-' + trimmedSensor;
                                            sensorData[key].labels
                                                .push(timestamp);
                                            sensorData[key].data
                                                .push(value);
                                        }
                                    });
                                }
                            });
                        });
                    });

                    for (var key in sensorData) {
                        if (sensorData[key].labels.length > 10) {
                            sensorData[key].labels = sensorData[key].labels.slice(-10);
                            sensorData[key].data = sensorData[key].data.slice(-10);
                        }

                        if (sensorCharts[key]) {
                            sensorCharts[key].data.labels = sensorData[key].labels;
                            sensorCharts[key].data.datasets[0].data = sensorData[key].data;
                            sensorCharts[key].update();
                        }
                    }
                } catch (error) {
                    console.error("Error parsing data:", error);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", status, error);
            }
        });
    }

    setInterval(function() {
        devices.forEach(function(device) {
            fetchSensorData(device.id);
        });
    }, 1000);

    $('#deviceCarousel').on('slid.bs.carousel', function() {
        for (var key in sensorCharts) {
            sensorCharts[key].update();
        }
    });
});
</script>

<script>
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
</script>

</body>

</html>