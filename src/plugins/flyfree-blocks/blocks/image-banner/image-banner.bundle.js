
const { registerBlockType } = wp.blocks;
const { InspectorControls, MediaPlaceholder } = wp.editor;
const { Toolbar } = wp.components;
const { BlockControls, MediaUpload, MediaUploadCheck } = wp.blockEditor;
import { Small, Medium, Large } from '../../components/Icons';

import { BlockSettings } from '../../components/BlockSettings';
import { getLargestImageSize } from '../../../../_common/scripts/getLargestImageSize';
import './_image-banner.scss';

registerBlockType( 'flyfree/image-banner', {
	title: 'Image Banner',
	category: 'flyfree',
	icon: {
		background: '#AC0015',
		foreground: '#ffffff',
		src: 'format-image',
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
			size,
		},
		setAttributes,
		className,
	} ) => {
		return (
			<>
				<InspectorControls>
					<BlockSettings
						setAttributes={ setAttributes }
						attributes={ { id, spacing } } />
				</InspectorControls>
				<BlockControls>
					<EditImageToolbar
						size={ size }
						image={ image }
						setAttributes={ setAttributes } />
				</BlockControls>
				<div className={ `${ className } is-${ size }` } style={ { backgroundImage: `url(${ image })` } }>
					{ ! image ? <ImageSelect image={ image } setAttributes={ setAttributes } /> : '' }
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

const EditImageToolbar = ( { size, setAttributes } ) => {
	const controls = [ {
		icon: <Small />,
		title: 'Small',
		isActive: size === 'small',
		onClick: () => setAttributes( { size: 'small' } ),
	},
	{
		icon: <Medium />,
		title: 'Medium',
		isActive: size === 'medium',
		onClick: () => setAttributes( { size: 'medium' } ),
	},
	{
		icon: <Large />,
		title: 'Large',
		isActive: size === 'large',
		onClick: () => setAttributes( { size: 'large' } ),
	} ];

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
			<Toolbar controls={ controls } />
		</>
	);
};
