<?= $this->extend('frontend/main') ?>

<?= $this->section('title') ?>
Rooms Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="wrapper py-10 bg-light">
    <div class="container">
        <a href="/rooms" class="btn btn-primary btn-sm">Back</a>
        <div class="row mt-5">
            <div class="col-6">
                <div class="basic-slider owl-carousel dots-over" data-nav="true" data-margin="5">
                    <?php foreach ($images as $key => $image) : ?>
                        <div class="item"><img src="<?= base_url('uploads/room_images/'.$image['image_name']) ?>" class="rounded" alt="" /></div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-5">
                    <h3><?= $room['name']; ?></h3>
                    <span>Category : <?= $room['category']; ?></span>
                    <br>
                    <span>Number of Person : <?= $room['num_person']; ?></span>
                    <p>
                        <?= $room['description']; ?>
                    </p>
                </div>
            </div>
            <div class="col-6">
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
                <hr style="margin:5%;">
                <div class="row">
                    <?= $this->include('frontend/includes/alert'); ?>
                    <div class="col-12">
                        <h4>Room reservation form</h4>
                        <form action="/rooms/reservation" method="post">
                            <?= csrf_field(); ?>

                            <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
                            <input type="hidden" name="slug" value="<?= $room['slug'] ?>">

                            <div class="form-floating mb-4">
                                <input id="time_start" name="time_start" type="datetime-local" class="form-control" placeholder="Time Start" required>
                                <label for="time_start">Time Start</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input id="time_end" name="time_end" type="datetime-local" class="form-control" placeholder="Time End" required>
                                <label for="time_end">Time End</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-sm">Book</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable({
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                "pageLength": 5
            });
        });
    </script>
<?= $this->endSection() ?>