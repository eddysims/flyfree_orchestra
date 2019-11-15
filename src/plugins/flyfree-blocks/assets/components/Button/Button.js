import './Button.scss';

const Button = ( { link, children, disabled, klass } ) => (
	<a 
		href={ link }
		disabled={ disabled }
		className={ `Button ${ klass }` } >
		
		{ children }
	</a>
);

export default Button;
