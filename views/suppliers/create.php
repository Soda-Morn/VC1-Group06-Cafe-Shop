</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center ">
    <div class="card shadow-lg p-4 rounded-4" style="width: 80%; max-width: 800px; background: #f8f9fa;">
        <h2 class="text-center text-primary mb-4">​Add Supplier</h2>
        <form action="/suppliers/store" method="post">
            
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name......" name="name" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label fw-bold">Phone Number:</label>
                <input type="text" class="form-control" id="phone_number" placeholder="Enter phone number........" name="phone_number" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label fw-bold">Address:</label>
                <textarea class="form-control" id="address" placeholder="Enter address......." name="address" required></textarea>
            </div>

            <div class="d-flex justify-content-between">
                
                <a href="/suppliers" class="btn btn-danger w-45">Cancel</a>
                <button type="submit" class="btn btn-primary w-45">Submit</button>
            </div>
        </form>
    </div>
</div>
<script src="/views/assets/js/Language_options/supplier-create-o.js"></script>
