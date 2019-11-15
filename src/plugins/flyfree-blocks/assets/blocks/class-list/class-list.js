import './style.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText } = wp.editor;
const { apiFetch } = wp;

import ClassList from '../../components/Classlist/Classlist';

registerBlockType( 'flyfree/class-list', {
	title: __( 'Class List', 'Flyfree' ),
	icon: 'welcome-learn-more',
	category: 'common',
	keywords: [
		__( 'Classes' ),
	],
	supports: {
		align: ['wide', 'full']
	},
	attributes: {
		align: {
			type: 'string',
			default: 'full',
		},
		title: {
			type: 'string',
			selector: 'h2',
		},
		content: {
			type: 'string',
			selector: 'p'
		},
		locations: {
			type: 'array',
			default: [],
		}
	},
	edit: function( props ) {
		const { attributes, setAttributes } = props;

		const onTitleChange = newVal => setAttributes( { title: newVal } );
		const onContentChange = newVal => setAttributes( { content: newVal } );

		apiFetch( { path: '/acf/v3/options/options/locations' } )
			.then( response => setAttributes( { locations: response.locations } ) );

		return (
			<section className={ props.className }>
				<RichText
					value={ attributes.title }
					placeholder="Class tist title"
					className={ `${ props.className }__title` }
					onChange={ onTitleChange }
					multiline={ false }
				/>

				<RichText
					value={ attributes.content }
					placeholder="Class tist content"
					className={ `${ props.className }__sub-title` }
					onChange={ onContentChange }
					multiline={ false }
				/>

				<ClassList locations={ attributes.locations } />

			</section>
		);
	},
	save: function( props ) {
		const { attributes, className } = props
		console.log( props )
		return (
			<div className={ className }>
				<div className="container">
					<div className={ `wp-block-flyfree-class-list__title` }>{ attributes.title }</div>
					<div className={ `wp-block-flyfree-class-list__sub-title` }>{ attributes.content }</div>

					<ClassList locations={ attributes.locations } />
				</div>
			</div>
		);
	},
} );
