<form action="/Categories/delete/<?= htmlspecialchars($category['Category_id']) ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
    <button type="submit" class="btn btn-danger mt-3">Delete</button>
</form>
