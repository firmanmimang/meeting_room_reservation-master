<?= $this->extend('frontend/main') ?>

<?= $this->section('title') ?>
    Home Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <section class="wrapper bg-light position-relative min-vh-70 d-lg-flex align-items-center mb-15">
        <div class="rounded-4-lg-start col-lg-6 order-lg-2 position-lg-absolute top-0 end-0 image-wrapper bg-image bg-cover h-100 min-vh-50" data-image-src="<?= base_url('frontend/assets/img/photos/about16.jpg') ?>">
        </div>
        <!--/column -->
        
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mt-10 mt-md-11 mt-lg-n10 px-10 px-md-11 ps-lg-0 pe-lg-13 text-center text-lg-start" data-cues="slideInDown" data-group="page-title" data-delay="600">
                        <h1 class="display-1 mb-5">Just sit & relax while you have a meeting</h1>
                        <div class="d-flex justify-content-center justify-content-lg-start" data-cues="slideInDown" data-group="page-title-buttons" data-delay="900">
                            <span><a href="#hr-categories" class="btn btn-lg btn-primary rounded-pill me-2">Explore Now</a></span>
                            <span><a href="#contact-us-footer" class="btn btn-lg btn-outline-primary rounded-pill">Contact Us</a></span>
                        </div>
                    </div>
                    <!--/div -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
        <div class="container">
            <div class="row gx-lg-8 gx-xl-12 gy-12 align-items-center mb-10 mb-md-13">
                <div class="col-lg-6 position-relative">
                    <div class="row gx-md-5 gy-5 align-items-center">
                        <div class="col-md-6">
                            <div class="row gx-md-5 gy-5">
                                <div class="col-md-10 offset-md-2">
                                    <figure class="rounded"><img src="<?= base_url('frontend/assets/img/photos/ab1.jpg') ?> " srcset="<?= base_url('frontend/assets/img/photos/ab1@2x.jpg') ?>" alt=""></figure>
                                </div>
                                <!--/column -->
                                <div class="col-md-12">
                                    <figure class="rounded"><img src="<?= base_url('frontend/assets/img/photos/ab2.jpg') ?> " srcset="<?= base_url('frontend/assets/img/photos/ab2@2x.jpg') ?>" alt=""></figure>
                                </div>
                                <!--/column -->
                            </div>
                            <!--/.row -->
                        </div>
                        <!--/column -->
                        <div class="col-md-6">
                            <figure class="rounded"><img src="<?= base_url('frontend/assets/img/photos/ab3.jpg') ?> " srcset="<?= base_url('frontend/assets/img/photos/ab3@2x.jpg') ?> " alt=""></figure>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
                <div class="col-lg-6">
                    <h3 class="display-4 mb-5">We bring solutions to make you more comfortable when you're in a meeting.</h3>
                    <p class="mb-7">
                        Some of the benefits of a special room for meetings
                    </p>
                    <div class="row gy-3">
                        <div class="col-xl-6">
                            <ul class="icon-list bullet-bg bullet-soft-primary mb-0">
                                <li><span><i class="uil uil-check"></i></span><span>More Focus</span></li>
                                <li class="mt-3"><span><i class="uil uil-check"></i></span><span>Won't be disturbed from outside</span></li>
                            </ul>
                        </div>
                        <!--/column -->
                        <div class="col-xl-6">
                            <ul class="icon-list bullet-bg bullet-soft-primary mb-0">
                                <li><span><i class="uil uil-check"></i></span><span>There are meeting support items</span></li>
                                <li class="mt-3"><span><i class="uil uil-check"></i></span><span>Have more capacity</span></li>
                            </ul>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <hr class="my-10" id="hr-categories"/>
            <div class="row g-6 mt-3 mb-10 light-gallery-wrapper" id="categories">
                <div class="col-12">
                    <center>
                        <h2>Room Category</h2>
                    </center>
                </div>
                <?php foreach($categories as $key => $category) : ?>
                <div class="col-md-4">
                    <figure class="card-img-top overlay overlay1 hover-scale" style="border-radius: 10px;"><a href="/rooms/category/<?= $category['id'] ?>"> <img src="<?= base_url('uploads/category_images/'.$category['images']) ?>" alt="" /></a>
                        <figcaption>
                            <h5 class="from-top mb-0">See More</h5>
                        </figcaption>
                    </figure>
                    <center>
                        <br>
                        <h4><?= $category['name']; ?></h4>
                    </center>
                </div>
                <?php endforeach; ?>
            </div>
            <hr class="mb-15" />
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper image-wrapper bg-primary">
        <div class="container py-18 light-gallery-wrapper text-center">
            <div class="row">
                <div class="col-lg-10 col-xl-10 col-xxl-8 mx-auto">
                    <a href="https://www.youtube.com/embed/gXFATcwrO-U" class="btn btn-circle btn-white btn-play ripple mx-auto mb-5 lightbox"><i class="icn-caret-right"></i></a>
                    <h2 class="display-4 px-lg-10 px-xl-13 px-xxl-10 text-white">You will be able to focus more when the meeting is in the meeting room.</h2>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
            <h3 class="display-4 mb-3 text-center">What People Say About Meeting Room</h3>
            <div class="row gx-lg-8 gx-xl-12 gy-6 mb-14 mt-5 align-items-center">
                <div class="col-lg-7">
                    <div class="row gx-md-5 gy-5">
                        <div class="col-md-6">
                            <figure class="rounded mt-md-10 position-relative"><img src="<?= base_url('frontend/assets/img/photos/g5.jpg') ?> " srcset="<?= base_url('frontend/assets/img/photos/g5@2x.jpg') ?> " alt=""></figure>
                        </div>
                        <!--/column -->
                        <div class="col-md-6">
                            <div class="row gx-md-5 gy-5">
                                <div class="col-md-12 order-md-2">
                                    <figure class="rounded"><img src="<?= base_url('frontend/assets/img/photos/g6.jpg') ?> " srcset="<?= base_url('frontend/assets/img/photos/g6@2x.jpg') ?> " alt=""></figure>
                                </div>
                                <!--/column -->
                            </div>
                            <!--/.row -->
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
                <div class="col-lg-5 mt-5">
                    <div class="basic-slider owl-carousel gap-small" data-margin="30">
                        <div class="item">
                            <blockquote class="icon icon-top fs-lg text-center">
                                <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum ligula porta felis euismod semper. Cras justo odio consectetur.”</p>
                                <div class="blockquote-details justify-content-center text-center">
                                    <div class="info ps-0">
                                        <h5 class="mb-1">Coriss Ambady</h5>
                                        <p class="mb-0">Financial Analyst</p>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- /.item -->
                        <div class="item">
                            <blockquote class="icon icon-top fs-lg text-center">
                                <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum ligula porta felis euismod semper. Cras justo odio consectetur.”</p>
                                <div class="blockquote-details justify-content-center text-center">
                                    <div class="info ps-0">
                                        <h5 class="mb-1">Cory Zamora</h5>
                                        <p class="mb-0">Marketing Specialist</p>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- /.item -->
                        <div class="item">
                            <blockquote class="icon icon-top fs-lg text-center">
                                <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum ligula porta felis euismod semper. Cras justo odio consectetur.”</p>
                                <div class="blockquote-details justify-content-center text-center">
                                    <div class="info ps-0">
                                        <h5 class="mb-1">Nikolas Brooten</h5>
                                        <p class="mb-0">Sales Manager</p>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        <!-- /.item -->
                    </div>
                    <!-- /.owl-carousel -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->

<?= $this->endSection() ?>


