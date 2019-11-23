export const lazyLoadBackgroundImage = (elm) => {
    const background = elm.dataset.background
    console.log(background)
    elm.style.backgroundImage = `url(${background})`;
}
