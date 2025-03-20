
    


<div class="container mt-9 table table-striped table-sm">
    <h1>Suppliers List</h1>
    <a href="/suppliers/create" class="btn btn-primary m-4">Create New Supplier</a>
    <table class="table table-striped table-sm m-3 m-3 ">
        <thead class="table-warning">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suppliers as $supplier): ?>
                <tr>
                    <td><?= htmlspecialchars($supplier['id']) ?></td>
                    <td><?= htmlspecialchars($supplier['name']) ?></td>
                    <td><?= htmlspecialchars($supplier['phone_number']) ?></td>
                    <td><?= htmlspecialchars($supplier['address']) ?></td>
                    <td>
                        <!-- Edit Button with Material Icon -->
                        <a href="/suppliers/edit/<?= htmlspecialchars($supplier['id']) ?>" class="text-success">
                            <i class="material-icons">edit</i>
                        </a>
                        <!-- Delete Button with Material Icon -->
                        <a href="/suppliers/delete/<?= htmlspecialchars($supplier['id']) ?>" class="text-danger" onclick="return confirm('Are you sure?')">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
