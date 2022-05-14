
 const openModal = document.querySelector('.js-modal');
 const closeModal = document.querySelector('.modal-close');
 const modal = document.querySelector('.modal-category');
 function open() {
    modal.classList.add('open');
}
function close() {
    modal.classList.remove('open');
}
openModal.addEventListener('click',open);
closeModal.addEventListener('click',close);
// modal.addEventListener('click',close);
