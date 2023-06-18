<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah data komik</h2>
            <form action="/komik/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
                        <?php if (session('validation') && session('validation')->hasError('judul')) : ?>
                            <div class="invalid-feedback">
                                <?= session('validation')->getError('judul'); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="row mb-3">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (session('validation') && session('validation')->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                        <?php if (session('validation') && session('validation')->hasError('penulis')) : ?>
                            <div class="invalid-feedback">
                                <?= session('validation')->getError('penulis'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="file" id="sampul" name="sampul" class="form-control <?= (session('validation') && session('validation')->hasError('sampul')) ? 'is-invalid' : ''; ?>" onchange="previewimeg()">
                            <?php if (session('validation') && session('validation')->hasError('sampul')) : ?>
                                <div class="invalid-feedback">
                                    <?= session('validation')->getError('sampul'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>