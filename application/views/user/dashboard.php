<!-- Begin Page Content -->
<div class="container-fluid mb-5">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Devices Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Devices
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $user_devices ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-server fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Devices Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Active Devices
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $user_devices; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="deviceCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($devices as $index => $device) : ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <div class="col-xl-12 col-lg-5 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $device->device_name; ?></h6>
                                </div>
                                <?php $sensors = explode(',', $device->sensors); ?>
                                <?php foreach ($sensors as $sensor) : ?>
                                    <div class="col-xl-10 offset-xl-1 col-lg-10 offset-lg-1 mb-4 mt-5">
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                <h6 class="m-0 font-weight-bold text-primary">
                                                    <?php echo ucfirst(trim($sensor)); ?></h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart-area" style="height: 400px;">
                                                    <canvas id="<?php echo $device->id . '-' . trim($sensor); ?>Chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <a class="carousel-control-prev" href="#deviceCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-text" aria-hidden="true">
                        <i class="fas fa-arrow-circle-left"></i>
                    </span>
                    <span class="sr-only"><i class="fas fa-arrow-circle-left"></i></span>
                </a>
                <a class="carousel-control-next ml-4" href="#deviceCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-text" aria-hidden="true"><i class="fas fa-arrow-circle-right"></i></span>
                    <span class="sr-only"><i class="fas fa-arrow-circle-right"></i></span>
                </a>
            </div>
        </div>
    </div>


    <!-- End of Main Content -->