<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Create Room
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <section class="section">
        <div class="section-header">
            <h1>Create Room</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="/internal/rooms/store" method="post">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-12">
                                    <a href="/internal/rooms" class="btn btn-danger">Back</a>
                                </div>
                            </div>
                            <div class="form-group row mt-5">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" id="name" value="" placeholder="Room Name">
                                    <div class="invalid-feedback font-size-invalid-feedback">
                                        <?= $validation->getError('name') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="num_person" class="col-sm-2 col-form-label">Number of Person</label>
                                <div class="col-sm-10">
                                    <input type="number" min="1" max="99" name="num_person" class="form-control <?= ($validation->hasError('num_person')) ? 'is-invalid' : '' ?>" id="num_person" value="" placeholder="10">
                                    <div class="invalid-feedback font-size-invalid-feedback">
                                        <?= $validation->getError('num_person') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : '' ?>" name="description" id="description" style="height:300px;"></textarea>
                                    <div class="invalid-feedback font-size-invalid-feedback">
                                        <?= $validation->getError('description') ?>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="room_category_id" class="col-sm-2 col-form-label">Room Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control <?= ($validation->hasError('room_category_id')) ? 'is-invalid' : '' ?>" name="room_category_id" id="exampleFormControlSelect1">
                                        <option value="" selected disabled>-- Choose Category --</option>
                                        <?php foreach($categories as $key => $category) : ?>
                                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback font-size-invalid-feedback">
                                        <?= $validation->getError('room_category_id') ?>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row mb-5">
                                <div class="col-9"></div>
                                <div class="col-3 d-flex justify-content-end">
                                    <button class="btn btn-info btn-lg">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>

    <script>
        tinymce.init({
            selector: 'textarea#description',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            /* enable title field in the Image dialog*/
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            /*
              URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
              images_upload_url: 'postAcceptor.php',
              here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                /*
                  Note: In modern browsers input[type="file"] is functional without
                  even adding it to the DOM, but that might not be the case in some older
                  or quirky browsers like IE, so you might want to add it to the DOM
                  just in case, and visually hide it. And do not forget do remove it
                  once you do not need it anymore.
                */

                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function() {
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
            content_style: 'body { font-family:Montserrat; font-size:14px }'
        });
    </script>

<?= $this->endSection() ?>
