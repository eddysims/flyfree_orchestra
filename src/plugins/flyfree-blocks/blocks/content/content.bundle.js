
const { registerBlockType } = wp.blocks;
const { InspectorControls, InnerBlocks } = wp.editor;

import { BlockSettings } from '../../components/BlockSettings';

registerBlockType( 'flyfree/content', {
	title: 'Content Area',
	category: 'flyfree',
	icon: {
		background: '#AC0015',
		foreground: '#ffffff',
		src: 'text',
	},
	edit: ( {
		attributes: {
			id,
			spacing,
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
				<div className={ `${ className } margin-top-${ spacing }` }>
					<InnerBlocks
						allowedBlocks={ [ 'core/heading', 'core/paragraph', 'core/list', 'core/shortcode' ] }
						template={ [ [ 'core/paragraph' ] ] } />
				</div>
			</>
		);
	},
	save() {
		return <InnerBlocks.Content />;
	},
} );
