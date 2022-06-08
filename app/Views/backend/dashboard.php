<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fa fa-lg fa-door-open white"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Rooms</h4>
                </div>
                <div class="card-body">
                    <?= $rooms ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fa fa-list fa-lg white"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Room Category</h4>
                </div>
                <div class="card-body">
                    <?= $room_categories ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fa fa-images fa-lg white"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Room Images</h4>
                </div>
                <div class="card-body">
                    <?= $room_images ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4>
                    Today Reservations List
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>Room Name</th>
                                <th>Time Start</th>
                                <th>Time End</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $key => $reservation) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $reservation['user_name'] ?></td>
                                    <td><?= $reservation['room_name'] ?></td>
                                    <td><?= $reservation['time_start'] ?></td>
                                    <td><?= $reservation['time_end'] ?></td>
                                    <td><?= $reservation['status'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>