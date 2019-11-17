<?php

new FlyfreeBlock( 'content', array(
    'include_frontend_styles' => false,
    'attributes' => array(
        'id' => array(
            'type' => 'string',
        ),
        'spacing' => array(
            'type' => 'string',
            'default' => 'large',
        ),
    )
));
