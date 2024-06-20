<div class="container-fluid">
    <h2 class="fs-2"><?= $title ?></h2>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('msg') ?>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row d-flex align-items-center">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/') . $user['image'] ?>" class="img-fluid rounded-start" alt="" width="200px">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name'] ?></h5>
                    <p class="card-text"><?= $user['email'] ?></p>
                    <p class="card-text"><small class="text-body-secondary">Member since
                            <?= date('d F Y', $user['date_created']) ?></small></p>
                    <a href="<?= base_url('admin/edit') ?>" class="btn btn-primary"><i class="far fa-edit"></i>
                        Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>