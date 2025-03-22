<div class="container " style="max-width: 50%;">
    <form action="/suppliers/store" method="post">
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
        </div>
        
        <div class="mb-3 mt-3">
            <label for="phone_number" class="form-label">Phone Number:</label>
            <input type="text" class="form-control" id="phone_number" placeholder="Enter phone number" name="phone_number" required>
        </div>

        <div class="mb-3 mt-3">
            <label for="address" class="form-label">Address:</label>
            <textarea class="form-control" id="address" placeholder="Enter address" name="address" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/suppliers" class="btn btn-danger">Cancel</a>
    </form>
</div>
