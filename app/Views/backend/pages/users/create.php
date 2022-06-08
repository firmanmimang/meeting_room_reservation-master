<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Create User
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Create User</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="/internal/users/store" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <a href="/internal/users" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" id="name" value="" placeholder="Name">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('name') ?>
                                </div>
                            </div>
                        </div>
<!-- Email                       -->
                        <div class="form-group row mt-5">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" value="" placeholder="email">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            </div>
                        </div>
<!-- Password                       -->
                        <div class="form-group row mt-5">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" value="" placeholder="password">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('password') ?>
                                </div>
                            </div>
                        </div>
<!-- Phone Number                       -->
                        <div class="form-group row mt-5">
                            <label for="phone_number" class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone_number" class="form-control <?= ($validation->hasError('phone_number')) ? 'is-invalid' : '' ?>" id="phone_number" value="" placeholder="phone_number">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('phone_number') ?>
                                </div>
                            </div>
                        </div>
<!-- Avatar                     -->
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
        showUpload:false,
        showRemove:true,
        allowedFileTypes:'image',
        allowedFileExtensions:['png','jpg','jpeg','jfif','webp'],
    });

</script>

<?= $this->endSection() ?>
