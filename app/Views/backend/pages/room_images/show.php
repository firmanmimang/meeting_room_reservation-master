<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Show Room Images
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <section class="section">
        <div class="section-header">
            <h1>Show Images <?= $room['name'] ?></h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-12">
                                <a href="/internal/room_images" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                        <?php if(count($images) == 0) { ?>
                            <center>
                                <h4>Images not available</h4>
                            </center>
                        <?php }else{ ?>
                            <center>
                                <h4>Click image to enlarge</h4>
                            </center>
                            <div class="row" style="margin-bottom:30px;margin-top:30px;">
                                <?php foreach($images as $key => $image): ?>
                                    <div class="col-lg-3 col-xs-12 col-sm-6 col-md-6" style="margin-bottom:30px;">
                                        <a href="<?= base_url('uploads/room_images/'.$image['image_name']) ?>" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                                            <img src="<?= base_url('uploads/room_images/'.$image['image_name']) ?>" class="img-fluid rounded">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script>
    $(document).on("click", '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>

<?= $this->endSection() ?>