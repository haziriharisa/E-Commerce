
const menuBtn = document.getElementById('menuBtn');
const header = document.getElementById('header');

menuBtn.addEventListener('click', () => {
    header.classList.toggle('active');
    
    const icon = menuBtn.querySelector('i');
    if (header.classList.contains('active')) {
        icon.classList.replace('fa-bars', 'fa-times');
    } else {
        icon.classList.replace('fa-times', 'fa-bars');
    }
});
   