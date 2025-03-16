<div class="container mt-3">
    <a href="/supplier/create" class="btn btn-primary">Add New</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Profile</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($supplier as $index => $suppliers): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td>
                        <?php if (!empty($supplier['profile'])): ?>
                            <img src="<?= $supplier['profile'] ?>" width="50" height="50" class="rounded-circle">
                        <?php endif; ?>
                    </td>

                    <td><?= $supplier['name'] ?></td>
                    <td>
                        <a href="/supplier/edit?id=<?= $supplier['id'] ?>" class="btn btn-warning">Edit</a> |
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supplier<?= $supplier['id'] ?>">
                            Delete
                        </button>

                        <!-- Modal -->
                        <?php require 'delete.php' ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>