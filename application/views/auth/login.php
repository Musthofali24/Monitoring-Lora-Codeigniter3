<div class="container align-items-center justify-content-center vh-100 d-flex">
    <div class="col-md-5">
        <form class="border border-black p-5 rounded-4" method="post" action="<?= base_url('auth'); ?>">
            <h1 class="fs-3 fw-semibold">Masuk ke AEC Server</h1>
            <h2 class="fs-6 mb-4">Welcome Back to AEC Server 👋</h2>
            <?= $this->session->flashdata('msg') ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>" />
                <?= form_error('email', '<p class="text-danger">', '</p>'); ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
                <?= form_error('password', '<p class="text-danger">', '</p>'); ?>
            </div>
            <button type=" submit" class="btn btn-dark w-100">Masuk</button>
            <p class="mt-3 text-center">
                Belum punya akun?
                <a class="text-primary text-decoration-none fw-semibold" href="<?= base_url('auth/register') ?>">Daftar
                    Sekarang</a>
            </p>
        </form>
    </div>
</div>