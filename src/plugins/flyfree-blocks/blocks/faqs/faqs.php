<?php

new FlyfreeBlock( 'faqs', array(
    'include_frontend_script' => true,
    'attributes' => array(
        'id' => array(
            'type' => 'string',
        ),
        'spacing' => array(
            'type' => 'string',
            'default' => 'large',
        ),
        'questions' => array(
            'type' => 'array',
            'default' => array(
                array(
                    'question' => '',
                    'answer' => '',
                ),
            ),
        ),
    )
));
