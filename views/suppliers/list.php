<style>
    h1{
        margin-left: 70px;
    }
</style>
<div class="container">
    <h1>Suppliers List</h1>
    <a href="/suppliers/create" class="btn btn-primary " style="transform: scale(0.9); font-size: 1.1rem; padding: 8px px; margin-left: 67px;">
        Create New Supplier
    </a>
    
    <table class="table table-striped table-sm m-3" style="transform: scale(0.9); background-color: #f8f9fa; color: #333; border: 1px solid #ddd;">
        <thead class="table-primary" style="background-color: orange; font-weight: bold; color: white;">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter = 1; ?> <!-- Initialize Counter -->
            <?php foreach ($suppliers as $supplier): ?>
                <tr style="background-color: #f4f4f4; color: #333;">
                    <td><?= $counter++ ?></td>  <!-- Use sequential ID -->
                    <td><?= htmlspecialchars($supplier['name']) ?></td>
                    <td><?= htmlspecialchars($supplier['phone_number']) ?></td>
                    <td><?= htmlspecialchars($supplier['address']) ?></td>
                    <td>
                        <!-- Edit Button -->
                        <a href="/suppliers/edit/<?= htmlspecialchars($supplier['id']) ?>" class="text-success">
                            <i class="material-icons">edit</i>
                        </a>
                        <!-- Delete Button without confirmation alert -->
                        <a href="/suppliers/delete/<?= htmlspecialchars($supplier['id']) ?>" class="text-danger">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
