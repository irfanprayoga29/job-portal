const moreList = document.getElementById("moreList");
const collapseText = document.getElementById("collapseText");
const toggleCollapse = document.getElementById("toggleCollapse");

moreList.addEventListener("hide.bs.collapse", () => {
    collapseText.innerText = "See more";
    toggleCollapse.querySelector("i").className = "bi bi-chevron-down";
});

moreList.addEventListener("show.bs.collapse", () => {
    collapseText.innerText = "See less";
    toggleCollapse.querySelector("i").className = "bi bi-chevron-up";
});
