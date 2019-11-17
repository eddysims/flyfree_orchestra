const questions = document.querySelectorAll('.question');
questions.forEach( question => {
    console.log('quesion')
    const title = question.querySelector('.question__question')
    const onTitleClick = () => question.classList.toggle('is-open')
    title.addEventListener('click', () => onTitleClick());
    title.addEventListener('keydown', (key) => key.key === 'Enter' && onTitleClick())
})