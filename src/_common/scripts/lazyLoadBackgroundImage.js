export const lazyLoadBackgroundImage = ( elm ) => {
	const background = elm.dataset.background;
	elm.style.backgroundImage = `url(${ background })`;
};
