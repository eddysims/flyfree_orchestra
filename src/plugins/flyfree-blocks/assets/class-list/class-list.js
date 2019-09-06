import './style.scss';
import './editor.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText } = wp.editor
const { apiFetch } = wp;

registerBlockType( 'flyfree/class-list', {
	title: __( 'Class List', 'Flyfree' ),
	icon: 'welcome-learn-more',
	category: 'common',
	keywords: [
		__( 'Classes' ),
	],
	attributes: {
		content: {
			type: 'string',
			selector: 'h2',
		},
		moreContent: {
			type: 'string',
			selector: 'p'
		},
		alert_bar: {
			type: 'string',
		}
	},
	edit: function( props ) {
		const onContentChange = ( newContent ) => props.setAttributes( { content: newContent } )
		const onNewContentChange = ( newContent ) => props.setAttributes( { moreContent: newContent } )

		apiFetch( { path: '/acf/v3/options/options/alert_bar' } )
			.then( response => {
				props.setAttributes( { alert_bar: response.alert_bar } )
			} );
		
		return (
			<section className={ props.className }>
				<RichText
					placeholder="Enter some text here"
					value={ props.attributes.content }
					onChange={ onContentChange }
					tagName="h3"
				/>
				<hr />
				<RichText
					placeholder="Enter some text here"
					value={ props.attributes.moreContent }
					onChange={ onNewContentChange }
					tagName="p"
				/>

				<h1>{ props.attributes.alert_bar }</h1>
			</section>
		);
	},
	save: function( props ) {
		return (
			<div className={ props.className }>
				<p>— Hello from the frontend.</p>
				<p>
					CGB BLOCK: <code>multi-block</code> is a new Gutenberg block.
				</p>
				<p>
					It was created via{ ' ' }
					<code>
						<a href="https://github.com/ahmadawais/create-guten-block">
							create-guten-block
						</a>
					</code>.
				</p>
			</div>
		);
	},
} );
