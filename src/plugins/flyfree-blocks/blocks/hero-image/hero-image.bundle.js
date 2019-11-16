/**
 * Internal dependencies
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InspectorControls } = wp.editor;
const { Fragment } = wp.element

import './_hero-image.scss';

registerBlockType( 'flyfree/hero-image', {
	title: __( 'Hero Image' ),
	icon: {
		background: '#f00',
		foreground: '#fff',
		src: 'text',
	},
	category: 'flyfree',
	keywords: [
		__( 'Text' ),
		__( 'Content' ),
	],
	supports: {
		align: [ 'center', 'wide' ],
		default: 'center',
	},
	edit( props ) {
		const {
			attributes: {
				id,
				pretitle,
			},
			setAttributes,
		} = props;

		return (
			<>
				<InspectorControls>
					Hello 
				</InspectorControls>
				<div>
					Hello World
				</div>
			</>
		);
	},
	save() {
		return null;
	},
} );