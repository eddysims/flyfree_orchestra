import Button from '../Button/Button';

const ClassList = ( { locations } ) => {
	const classes = locations.map( item => {
		let classList;

		if( item.classes.length > 0 ) {
			classList = item.classes.map((course) => (
				<li className="class-list__item">
					<Button 
						link={ course.class_url }
						disabled={ course.class_is_full }
						klass={ course.class_is_view_all ? 'is-black' : '' }>
						
						{ course.class_type }
					</Button>
				</li>
			) )
		}

		return (
			<div className={ `class-list__class class-list__class--${ item.location_name.replace(' ', '-').toLowerCase() }` }>
				<div className="class-list__name">
					FlyFree Movement<br />
					{ item.location_name }
				</div>

				{ item.location_address }

				<ul className="class-list__list">
					{ classList }
				</ul>
			</div>
		)
	} );

	return (
		<div className="class-list">
			{classes}
		</div>
	)

	// const classList = locations.map( item => {

	// 	let listOfClasses

	// 	if ( item.classes.length > 0 ) {
	// 		listOfClasses = item.classes.map( (course) => {
	// 			const {
	// 				class_url,
	// 				class_type,
	// 				class_is_full,
	// 				class_is_view_all
	// 			} = course;

	// 			return (
	// 				<li>
	// 					<Button 
	// 						link={ class_url }
	// 						disabled={ class_is_full }
	// 						full={ course.class_type} >
							
	// 						{ class_type }
	// 					</Button>
	// 				</li> 
	// 			)
	// 		} );
	// 	}

	// 	return listOfClasses;
	// }
}

export default ClassList;
