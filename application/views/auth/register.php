<div class="container align-items-center justify-content-center vh-100 d-flex">
    <div class="col-md-5">
        <form class="border border-black p-5 rounded-4" method="post" action="<?= base_url('auth/register'); ?>">
            <h1 class="fs-3 fw-semibold">Pendaftaran Akun</h1>
            <h2 class="fs-6 mb-4">Yuk, daftarkan akunmu sekarang juga!</h2>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name'); ?>" />
                <?= form_error('name', '<p class="text-danger mt-2 small">', '</p>'); ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email'); ?>" />
                <?= form_error('email', '<p class="text-danger mt-2 small">', '</p>'); ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" />
                <?= form_error('password', '<p class="text-danger mt-2 small">', '</p>'); ?>
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" />
                <?= form_error('cpassword', '<p class="text-danger mt-2 small">', '</p>'); ?>
            </div>
            <button type="submit" class="btn btn-dark w-100">Daftar</button>
            <p class="mt-3 text-center">
                Sudah punya akun?
                <a class="text-primary text-decoration-none fw-semibold" href="<?= base_url('auth') ?>">Masuk
                    Sekarang</a>
            </p>
        </form>
    </div>
</div>