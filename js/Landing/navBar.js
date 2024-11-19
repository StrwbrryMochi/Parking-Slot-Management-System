const menu = document.querySelector('#mobile-menu');
const menuLinks = document.querySelector('.navbar__menu');
const menuItems = document.querySelectorAll('.navbar__menu .navbar__item');


// Toggle menu open and close
menu.addEventListener('click', function() {
   
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
});

// Close menu if  clicked
menuItems.forEach(item => {
    item.addEventListener('click', function() {
        menu.classList.remove('is-active');
        menuLinks.classList.remove('active');
    });
});
