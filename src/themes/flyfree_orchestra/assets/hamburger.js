const hamburgerClick = () => {
    const hamburger = document.querySelector('.hamburger');
    hamburger.addEventListener('click', () => hamburger.classList.toggle('is-open'));
}

export default hamburgerClick;