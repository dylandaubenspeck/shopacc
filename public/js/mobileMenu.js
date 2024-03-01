const toggleButton = document.getElementById('toggleButton');
const mobileMenu = document.getElementById('mobileMenu');
toggleButton.addEventListener('click', function() {
    const isMenuOpen = mobileMenu.classList.contains('hidden');
    if (isMenuOpen) {
        mobileMenu.classList.remove('hidden');
    } else {
        mobileMenu.classList.add('hidden');
    }
});