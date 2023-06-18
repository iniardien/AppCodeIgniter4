<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h1>Contact</h1>
<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Harum quae fuga sint, nostrum facere totam accusantium nobis dicta facilis soluta,
    est, repudiandae recusandae reprehenderit! Assumenda culpa cumque rerum eligendi ut!</p>
<?php foreach ($alamat as $a) : ?>
    <ul>
        <li><?= $a['tipe']; ?></li>
        <li><?= $a['jalan']; ?></li>
        <li><?= $a['kota']; ?></li>
    </ul>
<?php endforeach; ?>
<?= $this->endSection(); ?>