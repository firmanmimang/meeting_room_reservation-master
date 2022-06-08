<?= $this->extend('backend/main') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1><?= count($employees); ?> Employee Lists</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-12 d-flex justify-content-end">
                            <a href="/internal/employees/create" class="btn btn-info">Create Employee</a>
                        </div>
                    </div>
                    <?= $this->include('backend/includes/alert'); ?>
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $key => $employee) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $employee['name'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="/internal/employees/edit/<?= $employee['id'] ?>" class="btn btn-warning white">Edit</a>
                                                <a href="/internal/employees/delete/<?= $employee['id'] ?>" class="btn btn-danger btn-delete" data-id="<?= $employee['id'] ?>">Delete</a>
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
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
<?= $this->endSection() ?>