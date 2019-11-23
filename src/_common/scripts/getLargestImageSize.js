export const getLargestImageSize = ( sizes ) => {
	if ( ! sizes.full ) {
		return null;
	}

	if ( sizes.large && sizes.large.url ) {
		return sizes.large.url;
	}

	if ( sizes.full.width > 300 && sizes.full.width < 1024 ) {
		return sizes.full.url;
	}

	if ( sizes.medium && sizes.medium.url ) {
		return sizes.medium.url;
	}

	return sizes.full.url;
};