<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Lihat struktur</h1>

            <!-- Example single danger button -->
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle mb-3" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= strtoupper($dropdownItem) ?>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href=" <?= base_url('/menu/lihat-struktur/jabatan') ?> ">Jabatan</a></li>
                    <li><a class="dropdown-item" href=" <?= base_url('/menu/lihat-struktur/golongan') ?> ">Pangkat dan Golongan</a></li>
                    <li><a class="dropdown-item" href=" <?= base_url('/menu/lihat-struktur/satker') ?> ">Satuan Kerja</a></li>
                    <li><a class="dropdown-item" href=" <?= base_url('/menu/lihat-struktur/bagian') ?>">Bagian</a></li>
                    <li><a class="dropdown-item" href=" <?= base_url('/menu/lihat-struktur/subbag') ?> ">Subbag</a></li>
                </ul>
            </div>

            <div class="btn-group">
                <button class="btn btn-success mb-3 ms-3" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Tambah Data</button>
            </div>

            <div class="collapse m-4" id="collapseExample">
                <form method="POST" action="<?= base_url('/home/tambahdatadua') . '/' . $dropdownItem ?>">
                    <?= csrf_field(); ?>
                    <?php foreach ($fields as $field) : ?>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-sm"> <?= strtoupper(str_replace("_", " ", $field)) ?> </label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="<?= $field ?>" name="<?= $field ?>" required>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>


            <!-- table struktur -->
            <div class="w-50 p-0">
                <table class="table table-hover" border="1" cellpadding="10" cellspacing="0" style="margin-left: 20px;">
                    <thead class="bg-primary text-white">
                        <tr>
                            <?php foreach ($fields as $field) : ?>
                                <th class="text-center"> <?= strtoupper(str_replace("_", " ", $field)) ?> </th>
                            <?php endforeach; ?>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) : ?>
                            <tr>
                                <?php foreach ($fields as $field) : ?>
                                    <td class="text-center"> <?= strtoupper($row["$field"]) ?> </td>
                                <?php endforeach; ?>
                                <td>

                                    <span class="material-icons text-primary">
                                        create
                                    </span>

                                    <a href="<?= base_url("/home/delete/" . $row[$fields[0]] . "/" . $fields[0] . "/" . $dropdownItem) ?>"><span class="material-icons text-danger">delete</span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>