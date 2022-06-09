<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    CV Lists
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1><?= count($cvs); ?> CV List</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-12 d-flex justify-content-end">
                            <a href="/internal/cv/export-excel" class="btn btn-success mx-1">Export Excell</a>
                            <a href="/internal/cv/export-pdf" class="btn mx-1" style="box-shadow: 0 2px 6px #f68c83; background-color: #f71200; border-color: #f71200; color: #fff;">Export PDF</a>
                            <a href="/internal/cv/create" class="btn btn-info mx-1">Create CV</a>
                        </div>
                    </div>
                    <?= $this->include('backend/includes/alert'); ?>
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nomor HP</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($cvs as $key => $cv): ?>
                                <tr>
                                    <td><?= $key+1 ?></td>
                                    <td><?= $cv['nama'] ?></td>
                                    <td><?= $cv['tempat_lahir'].", ". $cv['tanggal_lahir']?></td>
                                    <td><?= $cv['jenis_kelamin'] ?></td>
                                    <td><?= $cv['no_hp'] ?></td>
                                    <td><?= $cv['email'] ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="/internal/cv/export-pdf/<?= $cv['id_mahasiswa'] ?>" class="btn white" style="box-shadow: 0 2px 6px #f68c83; background-color: #f71200; border-color: #f71200; color: #fff;">Download</a>
                                            <a href="/internal/cv/edit/<?= $cv['id_mahasiswa'] ?>" class="btn btn-warning white">Edit</a>
                                            <a href="/internal/cv/delete/<?= $cv['id_mahasiswa'] ?>" class="btn btn-danger btn-delete" data-id="<?= $cv['id_mahasiswa'] ?>">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
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
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
<?= $this->endSection() ?>