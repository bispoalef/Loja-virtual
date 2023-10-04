document.addEventListener("DOMContentLoaded", function () {
    const darkModeToggle = document.getElementById("dark-mode-toggle");
    const body = document.body;
    const darkModeIcon = document.getElementById("dark-mode-icon");

    darkModeToggle.addEventListener("click", function () {
        body.classList.toggle("dark-mode");
        // Alterna entre os ícones de sol e lua
        darkModeIcon.classList.toggle("light", !body.classList.contains("dark-mode"));
        darkModeIcon.classList.toggle("dark", body.classList.contains("dark-mode"));
    });
});
