<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Create Room Images
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Create Images</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="/internal/room_images/store" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <a href="/internal/room_images" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="room_id" class="col-sm-2 col-form-label">For Room?</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="room_id" id="room_id" required>
                                    <option value="" selected disabled>-- Choose Category --</option>
                                    <?php foreach($rooms as $key => $room) : ?>
                                        <option value="<?= $room['id'] ?>"><?= $room['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">Images</label>
                            <div class="col-sm-10">
                                <input id="file-demo" type="file" name="images[]" class="file" multiple=true data-preview-file-type="any" required>
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
