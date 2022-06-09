<?= $this->extend('backend/main') ?>

<?= $this->section('title') ?>
    Create CV
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Create CV</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="/internal/cv/update/<?= $cv['id_mahasiswa']?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <a href="/internal/cv" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="nama" value="<?= $cv['nama'] ?>" placeholder="nama">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('nama') ?>
                                </div>
                            </div>
                        </div>
<!-- Email                       -->
                        <div class="form-group row mt-5">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" value="<?= $cv['email'] ?>" placeholder="email">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                            </div>
                        </div>
<!-- Phone Number                       -->
                        <div class="form-group row mt-5">
                            <label for="no_hp" class="col-sm-2 col-form-label">Nomor HP</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_hp" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : '' ?>" id="no_hp" value="<?= $cv['no_hp'] ?>" placeholder="nomor hp">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('no_hp') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat, Tanggal Lahir</label>
                            <div class="col-sm-5">
                                <input type="text" name="tempat_lahir" class="form-control <?= ($validation->hasError('tempat_lahir')) ? 'is-invalid' : '' ?>" id="tempat_lahir" value="<?= $cv['tempat_lahir'] ?>" placeholder="tempat lahir">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('tempat_lahir') ?>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <input type="date" name="tanggal_lahir" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : '' ?>" id="tanggal_lahir" value="<?= $cv['tanggal_lahir'] ?>" placeholder="tanggal lahir">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('tanggal_lahir') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                            <div class="col-sm-10">
                                <input type="text" name="agama" class="form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : '' ?>" id="agama" value="<?= $cv['agama'] ?>" placeholder="agama">
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('agama') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="laki-laki" <?= $cv['jenis_kelamin'] == 'laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="perempuan" <?= $cv['jenis_kelamin'] == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('jenis_kelamin') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : '' ?>" id="status" name="status">
                                    <option value="belum menikah" <?= $cv['status'] == 'belum menikah' ? 'selected' : '' ?>>Belum Menikah</option>
                                    <option value="menikah" <?= $cv['status'] == 'menikah' ? 'selected' : '' ?>>Menikah</option>
                                </select>
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('status') ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" id="alamat" rows="4" name="alamat" placeholder="masukan alamat"><?= $cv['alamat'] ?></textarea>
                                <div class="invalid-feedback font-size-invalid-feedback">
                                    <?= $validation->getError('alamat') ?>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div>
                            <h5 class="text-dark"><b>Pendidikan</b></h5>
                            <div id="wrap-pendidikan">
                                <?php foreach($pendidikan as $pd) : ?>
                                    <input type='hidden' name='id_pendidikan[]' value='<?= $pd['id_pendidikan'] ?>'/>
                                    <div class="d-flex" style="gap:5px;">
                                        <div class="form-group w-100">
                                            <label for="nama-pendidikan">Jenis Pendidikan</label>
                                            <input type="text" class="form-control" name="nama_pendidikan[]" id="nama-pendidikan" placeholder="Enter here" value="<?= $pd['nama_pendidikan'] ?>">
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="tipe-pendidikan">Tipe</label>
                                            <select class="form-control" id="tipe-pendidikan" name="tipe_pendidikan[]">
                                                <option value="formal" <?= $pd['tipe_pendidikan'] == 'formal' ? 'selected' : '' ?>>Formal</option>
                                                <option value="non-formal" <?= $pd['tipe_pendidikan'] == 'non-formal' ? 'selected' : '' ?>>Non Formal</option>
                                            </select>
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="tempat-pendidikan">Sekolah</label>
                                            <input type="text" class="form-control" name="tempat_pendidikan[]" id="tempat-pendidikan" placeholder="Enter here" value="<?= $pd['tempat_pendidikan'] ?>">
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="waktu-pendidikan">Waktu Pendidikan</label>
                                            <input type="text" class="form-control" id="waktu-pendidikan" name="waktu_pendidikan[]" placeholder="Enter here" value="<?= $pd['waktu_pendidikan'] ?>">
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <button type="button" id="btn-add-pendidikan" class="btn btn-info btn-sm" >
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

                        <hr/>

                        <div>
                            <h5 class="text-dark"><b>Pengalaman</b></h5>
                            <div id="wrap-pengalaman">
                                <?php foreach($pengalaman as $p) : ?>
                                    <div class="form-group">
                                        <input type='hidden' name='id_pengalaman[]' value='<?= $p['id_pengalaman'] ?>'/>
                                        <input type="text" class="form-control" name="pengalaman[]" id="pengalaman" placeholder="Enter here" value="<?= $p['pengalaman'] ?>">
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <button type="button" id="btn-add-pengalaman" class="btn btn-info btn-sm" >
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

                        <hr/>

                        <div>
                            <h5 class="text-dark"><b>Kemampuan</b></h5>
                            
                            <div id="wrap-kemampuan">
                                <?php foreach($kemampuan as $k) : ?>
                                    <input type='hidden' name='id_kemampuan[]' value='<?= $k['id_kemampuan'] ?>'/>
                                    <div class="d-flex" style="gap:5px;">
                                        <div class="form-group w-100">
                                            <label for="kategori-kemampuan">Kategori Kemampuan</label>
                                            <input type="text" class="form-control" name="kategori_kemampuan[]" id="kategori-kemampuan" placeholder="Enter here" value="<?= $k['kategori_kemampuan'] ?>">
                                        </div>
                                        <div class="form-group w-100">
                                            <label for="sub-kategori-kemampuan">Sub-Kategori Kemampuan</label>
                                            <input type="text" class="form-control" name="sub_kategori_kemampuan[]" id="sub-kategori-kemampuan" placeholder="Enter here" value="<?= $k['sub_kategori_kemampuan'] ?>">
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            
                            <button type="button" id="btn-add-kemampuan" class="btn btn-info btn-sm" >
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

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
    $(document).ready(()=>{
        $('#btn-add-pengalaman').click(function(){
            $('#wrap-pengalaman').append("<div class='form-group'><input type='text' class='form-control' name='pengalaman[]' id='pengalaman' placeholder='Enter here'></div>");
        })

        $('#btn-add-kemampuan').click(function(){
            $('#wrap-kemampuan').append("<div class='d-flex' style='gap:5px;'><div class='form-group w-100'><label for='kategori-kemampuan'>Kategori Kemampuan</label><input type='text' class='form-control' name='kategori_kemampuan[]' id='kategori-kemampuan' placeholder='Enter here'></div><div class='form-group w-100'><label for='sub-kategori-kemampuan'>Sub-Kategori Kemampuan</label><input type='text' class='form-control' name='sub_kategori_kemampuan[]' id='sub-kategori-kemampuan' placeholder='Enter here'></div></div>");
        })

        $('#btn-add-pendidikan').click(function(){
            $('#wrap-pendidikan').append("<div class='d-flex' style='gap:5px;'><div class='form-group w-100'><label for='nama-pendidikan'>Jenis Pendidikan</label><input type='text' class='form-control w-100' name='nama_pendidikan[]' id='nama-pendidikan' placeholder='Enter here'></div><div class='form-group w-100'><label for='tipe-pendidikan'>Tipe</label><select class='form-control' id='tipe-pendidikan' name='tipe_pendidikan[]'>    <option value='formal' selected>Formal</option>    <option value='non-formal'>Non Formal</option></select></div><div class='form-group w-100'><label for='tempat-pendidikan'>Sekolah</label><input type='text' class='form-control' name='tempat_pendidikan[]' id='tempat-pendidikan' placeholder='Enter here'></div><div class='form-group w-100'><label for='waktu-pendidikan'>Waktu Pendidikan</label><input type='text' class='form-control' id='waktu-pendidikan' name='waktu_pendidikan[]' placeholder='Enter here'></div></div>");
        })
    })
</script>


<?= $this->endSection() ?>
