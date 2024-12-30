<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Tambah Pengeluaran Baru</h5>
            </div>
            <div class="card-body">
                <?php if (session()->has('errors')) : ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session('errors') as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <form action="/expenses" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Pengeluaran</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="amount" name="amount" 
                                   value="<?= old('amount') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Transportasi">Transportasi</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Hiburan">Hiburan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" 
                                rows="3" required><?= old('description') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date" 
                               value="<?= old('date') ?? date('Y-m-d') ?>" required>
                    </div>

                    <div class="text-end">
                        <a href="/expenses" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>