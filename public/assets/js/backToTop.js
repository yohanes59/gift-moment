// Navbar Fixed
window.onscroll = function() {
    const header = document.querySelector('nav');
    const fixedNav = header.offsetTop;
    const backToTop = document.querySelector('#back-to-top');

    if(window.pageYOffset > fixedNav) {
        backToTop.classList.remove('hidden');
        backToTop.classList.add('flex');
    } else {
        backToTop.classList.remove('flex');
        backToTop.classList.add('hidden');
    }
};

function toTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}