<?= $this->extend('frontend/main') ?>

<?= $this->section('title') ?>
    Rooms Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<style>
    .active{
        color:white;
        background:#4a90e2;
    }
</style>

<section class="wrapper bg-gray">
    <div class="container pt-10 pb-12 pt-md-14 pb-md-16 text-center">
        <div class="row">
            <div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
                <h1 class="display-1 mb-3">Our Meeting Rooms</h1>
                <p class="lead px-lg-5 px-xxl-8">Welcome to Rooms Page. Here you can find the available rooms for meeting.</p>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->

<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12">
            <div class="col-lg-9 order-lg-2">
                <!-- /.blog -->
                <div class="blog grid grid-view">
                    <div class="row isotope gx-md-8 gy-8 mb-8">
                        <?php if(count($rooms) == 0) { ?>
                            <center>
                                <h4>Room not found.</h4>
                            </center>
                        <?php }else{ ?>
                            <?php foreach($rooms as $rkey => $room) : ?>
                                <article class="item post col-md-4">
                                    <div class="card">
                                        <figure class="card-img-top overlay overlay1 hover-scale"><a href="/rooms/detail/<?= $room['slug']; ?>"> <img src="<?= base_url('uploads/room_images/'.$image_array['img'][$rkey]) ?>" alt="" /></a>
                                            <figcaption>
                                                <h5 class="from-top mb-0">Read More</h5>
                                            </figcaption>
                                        </figure>
                                        <div class="card-body">
                                            <div class="post-header">
                                                <div class="post-category text-line">
                                                    <a href="#" class="hover" rel="category"><?= $room['category'] ?></a>
                                                </div>
                                                <br>
                                                <div class="post-category text-line">
                                                    <a href="#" class="hover" rel="category"><?= $room['num_person'] ?> people</a>
                                                </div>
                                                <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="/rooms/detail/<?= $room['slug']; ?>"><?= $room['name']; ?></a></h2>
                                            </div>
                                            <!-- /.post-header -->
                                        </div>
                                        <!--/.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </article>
                                <!-- /.post -->
                            <?php endforeach; ?>
                        <?php } ?>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.blog -->
            </div>
            <!-- /column -->
            <aside class="col-lg-3 sidebar mt-8 mt-lg-6">
                <div class="widget">
                    <h4 class="widget-title mb-3">Categories</h4>
                    <ul class="unordered-list bullet-primary text-reset">
                        <?php foreach($categories as $key => $data_category) : ?>
                            <li class="<?= $category && $category['id'] == $data_category['id'] ? 'active' : '' ?>"><a href="/rooms/category/<?= $data_category['id'] ?>"><?= $data_category['name']; ?> Rooms</a></li>
                        <?php endforeach; ?>
                        <li><a href="/rooms">All Size</a></li>
                    </ul>
                </div>
                <!-- /.widget -->
            </aside>
            <!-- /column .sidebar -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->

<?= $this->endSection() ?>
