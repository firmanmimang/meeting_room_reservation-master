<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url('frontend/assets/img/favicon.png') ?>">
    <title><?= $this->renderSection('title') ?></title>
    <link rel="stylesheet" href="<?= base_url('frontend/assets/css/plugins.css') ?>">
    <link rel="stylesheet" href="<?= base_url('frontend/assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('frontend/assets/css/colors/4a90e2.css') ?>">
    <link rel="preload" href="<?= base_url('frontend/assets/css/fonts/dm.css') ?>" as="style" onload="this.rel='stylesheet'">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body>
    <div class="content-wrapper">
        <?= $this->include('frontend/templates/navbar') ?>

        <?= $this->renderSection('content') ?>
    </div>

    <?= $this->include('frontend/templates/footer') ?>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="<?= base_url('frontend/assets/js/plugins.js') ?>"></script>
    <script src="<?= base_url('frontend/assets/js/theme.js') ?>"></script>

    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <?= $this->renderSection('js'); ?>

    <?php if(session()->getFlashData('success')){ ?>
        <script>
            Swal.fire(
                'Good job!',
                <?= session()->getFlashData('success') ?>,
                'success'
            )
        </script>
    <?php } ?>
</body>

</html>
