<?php $__env->startSection('title', 'Daftar Produk'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h2 style="margin: 0;">Daftar Produk</h2>
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">
            <i class='bx bx-plus'></i> Tambah Produk
        </a>
    </div>
    <div class="card-body">
        <table id="productsTable" class="dataTable-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Tgl Dibuat</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($product->id); ?></td>
                    <td>
                        <strong><?php echo e($product->name); ?></strong>
                        <?php if($product->description): ?>
                            <br><small style="color: var(--text-muted);"><?php echo e(Str::limit($product->description, 50)); ?></small>
                        <?php endif; ?>
                    </td>
                    <td>Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></td>
                    <td>
                        <span style="display: inline-block; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 500; background-color: <?php echo e($product->stock > 10 ? '#ECFDF5' : '#FEF2F2'); ?>; color: <?php echo e($product->stock > 10 ? '#065F46' : '#991B1B'); ?>;">
                            <?php echo e($product->stock); ?>

                        </span>
                    </td>
                    <td><?php echo e($product->created_at->format('d M Y')); ?></td>
                    <td style="text-align: right;">
                        <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-secondary" style="padding: 0.3rem 0.6rem;">
                            <i class='bx bx-edit-alt'></i>
                        </a>
                        <button type="button" class="btn btn-danger" style="padding: 0.3rem 0.6rem;" onclick="openDeleteModal(<?php echo e($product->id); ?>, '<?php echo e(addslashes($product->name)); ?>')">
                            <i class='bx bx-trash'></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title text-danger">Konfirmasi Hapus</h3>
        </div>
        <div class="modal-body">
            Apakah Anda yakin ingin menghapus produk <strong id="deleteProductName"></strong>? Tindakan ini tidak dapat dikembalikan.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteForm" method="POST" style="display: inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const table = document.getElementById("productsTable");
        if (table) {
            new simpleDatatables.DataTable(table, {
                searchable: true,
                fixedHeight: true,
                perPage: 10,
                labels: {
                    placeholder: "Cari produk...",
                    perPage: "data per halaman",
                    noRows: "Tidak ada data ditemukan",
                    info: "Menampilkan {start} sampai {end} dari {rows} data",
                }
            });
        }
    });

    // Delete Modal Logic
    const deleteModal = document.getElementById('deleteModal');
    const deleteProductName = document.getElementById('deleteProductName');
    const deleteForm = document.getElementById('deleteForm');

    function openDeleteModal(id, name) {
        deleteProductName.textContent = name;
        deleteForm.action = `/products/${id}`;
        deleteModal.classList.add('active');
    }

    function closeDeleteModal() {
        deleteModal.classList.remove('active');
    }

    // Close modal on outside click
    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) closeDeleteModal();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\jjj\k\2311102030\resources\views/products/index.blade.php ENDPATH**/ ?>