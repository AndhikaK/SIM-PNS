<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href=" <?= base_url('/'); ?> ">CI App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href=" <?= base_url('/'); ?> ">Beranda</a>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href=" <?= base_url('/menu/lihat-data') ?> ">Lihat Data PNS</a></li>
                        <li><a class="dropdown-item" href=" <?= base_url('/menu/input-data') ?> ">Input Data PNS</a></li>
                        <li><a class="dropdown-item" href=" <?= base_url('/menu/lihat-struktur/jabatan') ?> ">Lihat Struktur </a></li>
                    </ul>
                </li>
                <li><a class="nav-link active" href=" <?= base_url('/menu/test') ?> ">Test SQL</a></li>
            </div>
        </div>
    </div>
</nav>