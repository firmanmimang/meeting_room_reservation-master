<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Reservation List
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4>
                    Reservations List
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

        