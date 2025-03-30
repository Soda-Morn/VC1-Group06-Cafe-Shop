
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll("#basic-datatables tbody tr");

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchValue) ? "" : "none";
        });
    });

    document.querySelector(".sort-stock").addEventListener("click", function() {
        let table = document.querySelector("#basic-datatables tbody");
        let rows = Array.from(table.querySelectorAll("tr"));
        let ascending = this.dataset.order === "asc";

        rows.sort((a, b) => {
            let stockA = parseInt(a.querySelector(".stock-qty").textContent);
            let stockB = parseInt(b.querySelector(".stock-qty").textContent);
            return ascending ? stockA - stockB : stockB - stockA;
        });

        rows.forEach(row => table.appendChild(row));
        this.dataset.order = ascending ? "desc" : "asc";
    });
