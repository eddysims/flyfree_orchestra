
const { registerBlockType  } = wp.blocks;
const { select } = wp.data;
const { InspectorControls, RichText } = wp.editor;
const { Button } = wp.components;

import { BlockSettings } from '../../components/BlockSettings';
import './_faqs.scss';

registerBlockType( 'flyfree/faqs', {
	title: 'FAQs',
	category: 'flyfree',
	icon: {
		background: '#AC0015',
		foreground: '#ffffff',
		src: 'editor-help',
	},
	edit: ( { 
		attributes: {
			id,
			spacing,
            questions,
		},
		setAttributes,
		className
	} ) => {

        const onAddFaqButtonClick = () => {
            setAttributes( { questions: [...questions, {
                question: '',
                answer: ''
            } ] } )
        };

        const onChangeQuestion = ( val, index ) => {
			const newQuestion = questions.map( ( item, i ) => i === index ? { ...item, question: val } : item );
			setAttributes( { questions: newQuestion } );
        };
        
        const onChangeAnswer = ( val, index ) => {
			const newAnswer = questions.map( ( item, i ) => i === index ? { ...item, answer: val } : item );
			setAttributes( { questions: newAnswer } );
        };

        console.log('q', questions);

		return (
			<>
				<InspectorControls>
					<BlockSettings
						setAttributes={ setAttributes }
						attributes={ { id, spacing } } />
				</InspectorControls>
				<div className={className}>
                    <FaqList
                        questions={ questions }
                        onChangeQuestion={ onChangeQuestion }
                        onChangeAnswer={ onChangeAnswer } />

                    <Button isLarge={ true } isPrimary={ true } onClick={ onAddFaqButtonClick }>
                        Add FAQ
                    </Button>
				</div>
			</>
		);
	},
	save() {
		return null;
	},
} );

const FaqList = ( { questions, onChangeQuestion, onChangeAnswer } ) => {
    const Questions = questions.map( (question, index) => {
        return (
            <div key={index}>
                <RichText
                    value={ question.question }
                    placeholder="Question"
                    onChange={ ( val ) => onChangeQuestion( val, index ) } />

                <RichText
                    value={ question.answer }
                    placeholder="Answer"
                    onChange={ ( val ) => onChangeAnswer( val, index ) } />
            </div>
        );
    } );

    return (
        <div>
            { Questions }
        </div>
    )
}