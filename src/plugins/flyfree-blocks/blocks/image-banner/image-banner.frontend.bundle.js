import { lazyLoadBackgroundImage } from '../../../../_common/scripts/lazyLoadBackgroundImage';

const lazyImages = () => {
	const images = document.querySelectorAll( '[data-background]' );
	images.forEach( ( image ) => lazyLoadBackgroundImage( image ) );
};

if ( document.readyState !== 'loading' ) {
	lazyImages();
} else {
	document.addEventListener( 'DOMContentLoaded', () => lazyImages() );
}
