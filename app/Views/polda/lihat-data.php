<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <!-- Search dan Filter -->
            <div class="mt-4 ms-1 mb-1">
                <form action="" method="POST" class="form-inline">
                    <div class="form-group form-group-sm mx-sm-3 mb-2 d-inline-flex w-50">
                        <input type="password" class="form-control" id="inputPassword2" placeholder="Cari...">
                        <button type="submit" class="btn btn-primary ms-1"><span class="material-icons">search</span></button>
                        <button type="button" class="btn btn-info ms-1" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><span class="material-icons">sort</span></button>
                    </div>

                    <div class="collapse m-4" id="collapseExample">

                        <div class="row mb-3">
                            <div class="col">
                                <div class="row mb-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-sm"> Satker </label>
                                    <div class="col-sm-3">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected></option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>

                    </div>
                </form>
            </div>


            <!-- table pns -->
            <div class="clas" style="overflow-x: scroll;">
                <table class="table table-hover table-striped table-bordered border-secondary align-middle">
                    <thead class="bg-info text-white align-middle text-center">
                        <tr>
                            <th>No.</th>
                            <th>#</th>
                            <?php foreach ($fields as $field) : ?>
                                <th><?= strtoupper(str_replace("_", " ", $field)) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pegawai as $row) : ?>

                            <tr>
                                <td>
                                    <?= $i; ?>
                                    <?php $i++; ?>
                                </td>
                                <td>
                                    <div class="d-inline-flex">
                                        <a href="">
                                            <span class="material-icons text-primary">create</span>
                                        </a>
                                        <a href="<?= base_url('/home/delete/' . $row['nip'] . "/nip/pegawai") ?>">
                                            <span class="material-icons text-danger">delete</span>
                                        </a>
                                    </div>
                                </td>
                                <?php foreach ($fields as $field) : ?>
                                    <td> <?= $row[$field]; ?> </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>