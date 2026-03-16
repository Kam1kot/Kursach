const toggle = document.getElementById("sidebarToggle");

toggle?.addEventListener("click", () => {
    if (window.innerWidth < 1024) {
        document.body.classList.toggle("sidebar-collapsed");
    } else {
        document.body.classList.toggle("sidebar-open");
    }
});

const app_window = window.innerWidth;
const sidebar = document.querySelector(".admin");
if (app_window < 1024) {
    sidebar.classList.toggle("sidebar-collapsed");
}
