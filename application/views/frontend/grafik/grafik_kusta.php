    <main id="main">
        <!-- ======= Values Section ======= -->
        <section id="blog" class="blog mt-5">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2><?= $judul ?></h2>
                    <p>Menampilkan Informasi Penyakit Kusta dalam Bentuk Grafik di Kabupaten Kayong Utara Tahun <?= $rasioK['tahun'] ?></p>
                </header>

                <div class="row mb-3">
                    <div class="offset-1 col-sm-3 mt-2">
                        <button type="button" class="btn btn-primary dropdown-toggle" id="dropTahun" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-file-excel"></i> Download Laporan
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropTahun">
                            <?php foreach ($tahun as $thn) : ?>
                                <a class=" dropdown-item" href="<?= site_url(''); ?>beranda/excel_kusta/<?= $thn['tahun'] ?>"><?= $thn['tahun'] ?></a>
                            <?php endforeach; ?>

                        </div>
                    </div>
                    <div class="mx-auto col-sm-8">
                        <form action="" method="GET">
                            <div class="col-sm-4 ml-auto">
                                <div class="input-group mt-2">
                                    <select class="form-select" name="cari" id="cari">
                                        <option selected disabled>--Pilih Tahun--</option>
                                        <?php for ($y = date('Y'); $y >= 2000; $y--) : ?>
                                            <?php if ($y == $this->input->get('cari')) : ?>
                                                <option value="<?= $y; ?>" selected><?= $y; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $y; ?>"><?= $y; ?></option>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="submit">Pilih</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <?php if (empty($rasioK && $kusta)) : ?>
                    <div class="alert alert-danger col-sm-12" role="alert">
                        Data tidak ditemukan.
                    </div>
                <?php else : ?>

                    <div class="row">
                        <div class="col-lg-12 entries">

                            <article class="entry">
                                <h2 class="entry-title text-center">GRAFIK PREVALENCE RATE DI KABUPATEN KAYONG UTARA <?= $rasioK['tahun'] ?></h2>
                                <div class="dropdown-divider mb-3"></div>
                                <canvas id="pr" style="height:40vh; width:80vw"></canvas>
                                <div class="mt-3">
                                    <p><small>Keterangan :</small></p>
                                    <ul>
                                        <li style="list-style-type: none;"><small>PR : Prevalence Rate</small></li>
                                        </ul>
                                </div>
                            </article><!-- End blog entry -->

                            <article class="entry">
                                <h2 class="entry-title text-center">GRAFIK CASE DETECTION RATE DI KABUPATEN KAYONG UTARA <?= $rasioK['tahun'] ?></h2>
                                <div class="dropdown-divider mb-3"></div>
                                <canvas id="cdr" style="height:40vh; width:80vw"></canvas>
                                <div class="mt-3">
                                    <p><small>Keterangan :</small></p>
                                    <ul>
                                        <li style="list-style-type: none;"><small>CDR : Case Detection Rate / Angka penemuan kasus</small></li>
                                        </ul>
                                </div>
                            </article><!-- End blog entry -->

                            <article class="entry">
                                <h2 class="entry-title text-center">GRAFIK KASUS KUSTA TERDAFTAR BERDASARKAN TIPE KUSTA DI KABUPATEN KAYONG UTARA TAHUN <?= $rasioK['tahun'] ?></h2>
                                <div class="dropdown-divider mb-3"></div>
                                <canvas id="tipeKusta" style="height:40vh; width:80vw"></canvas>
                            </article><!-- End blog entry -->

                            <article class="entry">
                                <h2 class="entry-title text-center">GRAFIK KASUS KUSTA TERDAFTAR BERDASARKAN UMUR DI KABUPATEN KAYONG UTARA TAHUN <?= $rasioK['tahun'] ?></h2>
                                <div class="dropdown-divider mb-3"></div>
                                <canvas id="usiaK" style="height:40vh; width:80vw"></canvas>
                                <div class="mt-3">
                                    <p><small>Keterangan :</small></p>
                                    <ul>
                                        <li style="list-style-type: none;"><small>PB : Pausi Basiler (kusta kering)</small></li>
                                        <li style="list-style-type: none;"><small>MB : Multi Basiler (kusta basah)</small></li>
                                        </ul>
                                </div>
                            </article><!-- End blog entry -->

                            <article class="entry">
                                <h2 class="entry-title text-center">GRAFIK KASUS KUSTA TERDAFTAR YANG SEMBUH DAN CACAT MENURUT KECAMATAN DI KABUPATEN KAYONG UTARA TAHUN <?= $rasioK['tahun'] ?></h2>
                                <div class="dropdown-divider mb-3"></div>
                                <canvas id="sembuh" style="height:40vh; width:80vw"></canvas>
                                <div class="mt-3">
                                    <p><small>Keterangan :</small></p>
                                    <ul>
                                        <li style="list-style-type: none;"><small>Sembuh : Penderita positif kusta yang telah sembuh tanpa mengalami kecacatan</small></li>
                                        <li style="list-style-type: none;"><small>Cacat : Penderita positif kusta yang mengalami kecacatan</small></li>
                                        </ul>
                                </div>
                            </article><!-- End blog entry -->

                            <article class="entry">
                                <h2 class="entry-title text-center">GRAFIK PERSENTASE KASUS KUSTA TERDAFTAR BERDASARKAN JENIS KELAMIN DI KABUPATEN KAYONG UTARA TAHUN <?= $rasioK['tahun'] ?></h2>
                                <div class="dropdown-divider mb-3"></div>
                                <canvas id="rasioKusta" style="height:40vh; width:80vw"></canvas>
                            </article><!-- End blog entry -->

                        </div><!-- End blog entries list -->
                    </div>

                <?php endif; ?>

            </div>

        </section><!-- End Values Section -->

    </main><!-- End #main -->