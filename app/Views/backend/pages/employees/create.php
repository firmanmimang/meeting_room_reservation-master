<?= $this->extend('backend/main') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Create Employee</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="/internal/employees/store" method="post">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <a href="/internal/employees " class="btn btn-danger">Back</a>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" id="name" value="" placeholder="Employee Name">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="Jobdesk" class="col-sm-2 col-form-label">Jobdesk</label>
                            <div class="col-sm-10">
                                <input type="text" name="Jobdesk" class="form-control <?= ($validation->hasError('Jobdesk')) ? 'is-invalid' : '' ?>" id="Jobdesk" value="" placeholder="Jobdesk">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('Jobdesk') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" value="" placeholder="Email">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" value="" placeholder="password">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">phone_number</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone_number" class="form-control <?= ($validation->hasError('phone_number')) ? 'is-invalid' : '' ?>" id="phone_number" value="" placeholder="Nomor Handphone">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('phone_number') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">Avatar</label>
                            <div class="col-sm-10">
                                <input id="file-demo" type="file" name="avatar" class="file" data-preview-file-type="any" required>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-9"></div>
                            <div class="col-3 d-flex justify-content-end">
                                <button class="btn btn-info btn-lg">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    $("#file-demo").fileinput({
        showUpload: false,
        showRemove: true,
        allowedFileTypes: 'image',
        allowedFileExtensions: ['png', 'jpg', 'jpeg', 'jfif', 'webp'],
    });
</script>

<?= $this->endSection() ?>