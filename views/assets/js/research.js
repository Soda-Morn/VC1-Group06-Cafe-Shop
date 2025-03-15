document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchBox");
  const itemList = document.getElementById("itemList").getElementsByTagName("li");

  searchInput.addEventListener("keyup", function () {
    let filter = searchInput.value.toLowerCase();

    for (let i = 0; i < itemList.length; i++) {
      let text = itemList[i].textContent || itemList[i].innerText;
      if (text.toLowerCase().indexOf(filter) > -1) {
        itemList[i].style.display = "";
      } else {
        itemList[i].style.display = "none";
      }
    }
  });
});