document.addEventListener('DOMContentLoaded', function () {
    var dropdowns = document.querySelectorAll('.dropdown-submenu');
    dropdowns.forEach(function (dropdown) {
        dropdown.addEventListener('mouseenter', function () {
            var submenu = dropdown.querySelector('.dropdown-menu');
            submenu.classList.add('show');
        });
        dropdown.addEventListener('mouseleave', function () {
            var submenu = dropdown.querySelector('.dropdown-menu');
            submenu.classList.remove('show');
        });
    });
});
