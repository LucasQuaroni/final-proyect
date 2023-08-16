const options = document.querySelector('.options');
const menuButtons = document.querySelectorAll('.menu');

options.addEventListener('mouseleave', () => {
  menuButtons.forEach(button => {
    if (!button.classList.contains('hidden')) {
      button.classList.add('hidden');
    }
  });
});