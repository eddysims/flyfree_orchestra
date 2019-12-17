
const { registerBlockType } = wp.blocks;
const { InspectorControls, RichText, MediaPlaceholder } = wp.editor;
const { Toolbar } = wp.components;
const { BlockControls, MediaUpload, MediaUploadCheck } = wp.blockEditor;
const { apiFetch } = wp;

import { BlockSettings } from '../../components/BlockSettings';
import { getLargestImageSize } from '../../../../_common/scripts/getLargestImageSize';
import './_class-list.scss';

registerBlockType( 'flyfree/class-list', {
	title: 'Class List',
	category: 'flyfree',
	icon: {
		background: '#AC0015',
		foreground: '#ffffff',
		src: 'heart',
	},
	supports: {
		align: [ 'full' ],
		default: 'full',
	},
	edit: ( {
		attributes: {
			id,
			spacing,
			image,
			title,
			subtitle,
			classes,
		},
		setAttributes,
		className,
	} ) => {
		apiFetch( { url: `/wp-json/flyfree/classes` } )
			.then( ( data ) => setAttributes( { classes: data.classes } ) )
			.catch( () => new Error( 'Error From API for Classes' ) );

		return (
			<>
				<InspectorControls>
					<BlockSettings
						setAttributes={ setAttributes }
						attributes={ { id, spacing } } />
				</InspectorControls>
				<BlockControls>
					<EditImageToolbar
						image={ image }
						setAttributes={ setAttributes } />
				</BlockControls>
				<div className={ `${ className } margin-top-${ spacing }` } style={ { backgroundImage: `url(${ image })` } }>

					{ ! image ? <ImageSelect image={ image } setAttributes={ setAttributes } /> : '' }

					<div className="wp-block-flyfree-class-list__content">
						<RichText
							value={ title }
							placeholder="Class List Title"
							className="wp-block-flyfree-class-list__title"
							onChange={ ( val ) => setAttributes( { title: val } ) } />

						<RichText
							value={ subtitle }
							placeholder="Class List Sub Title"
							className="wp-block-flyfree-class-list__sub-title"
							onChange={ ( val ) => setAttributes( { subtitle: val } ) } />

						{ typeof classes === 'object' && classes.length > 0 ? <LocationList classes={ classes } /> : '' }
					</div>
				</div>
			</>
		);
	},
	save() {
		return null;
	},
} );

const ImageSelect = ( { setAttributes } ) => {
	return (
		<MediaPlaceholder
			onSelect={ ( { url, sizes } ) => {
				const newImage = sizes ? getLargestImageSize( sizes ) : url;
				setAttributes( { image: newImage } );
			} } />
	);
};

const EditImageToolbar = ( { setAttributes } ) => {
	return (
		<>
			<MediaUploadCheck>
				<MediaUpload
					onSelect={ ( { url, sizes } ) => {
						const newImage = sizes ? getLargestImageSize( sizes ) : url;
						setAttributes( { image: newImage } );
					} }
					render={ ( { open } ) => (
						<Toolbar controls={ [ {
							icon: 'edit',
							label: 'Edit Image',
							onClick: open,
						} ] } />
					) }
				/>
			</MediaUploadCheck>
		</>
	);
};

const LocationList = ( { classes } ) => {
	const classList = classes.map( ( cls ) => {
		return (
			<li key={ cls.location_name }>
				{ cls.location_name }<br />
				{ cls.location_address }
				<ClassList classes={ cls.classes } />
			</li>
		);
	} );
	return (
		<ul className="class-list">
			{ classList }
		</ul>
	);
};

const ClassList = ( { classes } ) => {
	const list = classes.map( ( {
		name,
		url,
		is_full, //eslint-disable-line camelcase
		is_all, //eslint-disable-line camelcase
	} ) => {
		return (
			<li key={ name }>
				<a
					className={ `button ${ is_all && 'is-block is-black' }` } //eslint-disable-line camelcase
					disabled={ is_full } //eslint-disable-line camelcase
					href={ url }
					target="_blank"
					rel="noopener noreferrer">

					{ name }
				</a>
			</li>
		);
	} );
	return (
		<ul>
			{ list }
		</ul>
	);
};
