<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Edit Room Images
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Edit Images</h1>
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
                                    <?php foreach($rooms as $key => $room_select) : ?>
                                        <option value="<?= $room_select['id'] ?>" <?= $room_select['id'] == $room['id'] ? 'selected' : '' ?> ><?= $room_select['name'] ?></option>
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
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-10">
                                <?= $this->include('backend/includes/alert'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-xs-12 col-sm-6 col-md-2">
                                Current Images
                            </div>
                            <div class="col-10">
                                <div class="row">
                                    <?php if(count($room_images) == 0) { ?>
                                        <center>
                                            <h4>Images not available</h4>
                                        </center>
                                    <?php }else{ ?>
                                        <?php foreach ($room_images as $key => $room_image): ?>
                                            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3" style="margin-bottom:30px;">
                                                <img src="<?= base_url('uploads/room_images/'.$room_image['image_name']) ?>" class="img-fluid" alt="">
                                                <a href="/internal/room_images/deleteImageById/<?= $room_image['id'] ?>" class="btn btn-danger btn-block btn-delete" data-id="<?= $room_image['id'] ?>">Delete</a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-lg-9 col-xs-12 col-sm-6 col-md-9"></div>
                            <div class="col-lg-3 col-xs-12 col-sm-6 col-md-3 d-flex justify-content-end" style="margin-top: 5%;">
                                <button class="btn btn-info btn-lg btn-block">Update</button>
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

<script type="text/javascript">
    $(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = href;
                }
            })
        });
    });
</script>

<script>
    $("#file-demo").fileinput({
        showUpload:false,
        showRemove:true,
        allowedFileTypes:'image',
        allowedFileExtensions:['png','jpg','jpeg','jfif','webp'],
    });

</script>

<?= $this->endSection() ?>
