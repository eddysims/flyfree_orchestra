
const { registerBlockType } = wp.blocks;
const { select } = wp.data;
const { InspectorControls, RichText } = wp.editor;

import './_hero-image.scss';

registerBlockType( 'flyfree/hero-image', {
	title: 'Hero Banner',
	category: 'flyfree',
	icon: {
		background: '#AC0015',
		foreground: '#ffffff',
		src: 'tide',
	},
	supports: {
		align: [ 'full' ],
		default: 'full',
	},
	edit: (props) => {

		const {
			attributes: {
				id,
				pretitle,
				title,
			},
			setAttributes,
			className
		} = props;
		
		if ( ! title || title === '' ) {
			setAttributes( { title: select( 'core/editor' ).getEditedPostAttribute( 'title' ) } );
		}

		return (
			<>
				<InspectorControls>
					Hello 
				</InspectorControls>
				<div className={className}>
					<RichText
						value={ pretitle }
						placeholder="Pretitle"
						onChange={ (val) => setAttributes( { pretitle: val } ) } />

					<RichText
						value={ title }
						placeholder="Title"
						tagName="h1"
						className="wp-block-flyfree-hero-image__heading"
						onChange={ (val) => setAttributes( { title: val } ) } />
				</div>
			</>
		);
	},
	save() {
		return null;
	},
} );