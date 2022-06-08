<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Room Category Lists
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1><?= count($room_categories); ?> Room Category Lists</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-12 d-flex justify-content-end">
                            <a href="/internal/room_categories/create" class="btn btn-info">Create Category</a>
                        </div>
                    </div>
                    <?= $this->include('backend/includes/alert'); ?>
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Images</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($room_categories as $key => $category): ?>
                                <tr>
                                    <td><?= $key+1 ?></td>
                                    <td><?= $category['name'] ?></td>
                                    <td>
                                        <img width="150" height="150" src="<?= base_url('uploads/category_images/'. $category['images']) ?>" class="img-fluid" alt="category image">
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="/internal/room_categories/edit/<?= $category['id'] ?>" class="btn btn-warning white">Edit</a>
                                            <a href="/internal/room_categories/delete/<?= $category['id'] ?>" class="btn btn-danger btn-delete" data-id="<?= $category['id'] ?>">Delete</a>
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