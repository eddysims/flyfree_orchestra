const { TextControl, PanelBody, Toolbar } = wp.components;
import { Zero, Small, Medium, Large } from './Icons';

export const BlockSettings = ( {
	controls,
	includeSpacing = true,
	attributes,
	setAttributes,
} ) => {
	const Spacing = ! includeSpacing ? '' : <SpacingToolbar spacing={ attributes.spacing } controls={ controls } setAttributes={ setAttributes } />;

	return (
		<PanelBody title="Block Settings">
			<TextControl
				label="Block ID"
				value={ attributes.id }
				onChange={ ( val ) => setAttributes( { id: val.toLowerCase().replace( ' ', '-' ) } ) } />

			{ Spacing }
		</PanelBody>
	);
};

const SpacingToolbar = ( {
	spacing = 'small',
	setAttributes,
	controls = [ {
		icon: <Zero />,
		title: 'Zero',
		isActive: spacing === 'zero',
		onClick: () => setAttributes( { spacing: 'zero' } ),
	},
	{
		icon: <Small />,
		title: 'Small',
		isActive: spacing === 'small',
		onClick: () => setAttributes( { spacing: 'small' } ),
	},
	{
		icon: <Medium />,
		title: 'Medium',
		isActive: spacing === 'medium',
		onClick: () => setAttributes( { spacing: 'medium' } ),
	},
	{
		icon: <Large />,
		title: 'Large',
		isActive: spacing === 'large',
		onClick: () => setAttributes( { spacing: 'large' } ),
	} ],
} ) => {
	setAttributes( { spacing } );
	return (
		<div className="components-base-control">
			<div className="components-base-control__label">Spacing</div>
			<Toolbar controls={ controls } />
			<p className="components-base-control__help">This will determine the distance between this block and the surrounding blocks</p>
		</div>
	);
};
