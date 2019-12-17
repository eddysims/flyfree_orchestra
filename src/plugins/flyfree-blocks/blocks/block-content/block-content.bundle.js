
const { registerBlockType } = wp.blocks;
const { InspectorControls, InnerBlocks } = wp.editor;

import { BlockSettings } from '../../components/BlockSettings';
import './_block-content.scss';

registerBlockType( 'flyfree/block-content', {
	title: 'Block Content',
	category: 'flyfree',
	icon: {
		background: '#AC0015',
		foreground: '#ffffff',
		src: 'editor-justify',
	},
	supports: {
		align: [ 'center', 'wide', 'full' ],
		default: 'center',
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
						allowedBlocks={ [ 'core/heading', 'core/paragraph', 'core/list' ] }
						template={ [ [ 'core/paragraph' ] ] } />
				</div>
			</>
		);
	},
	save() {
		return <InnerBlocks.Content />;
	},
} );
