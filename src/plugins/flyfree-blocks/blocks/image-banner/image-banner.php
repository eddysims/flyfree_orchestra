<?php

new FlyfreeBlock( 'image-banner', array(
    'include_frontend_script' => true,
    'attributes' => array(
        'align' => array(
            'type' => 'string',
            'default' => 'full',
        ),
        'id' => array(
            'type' => 'string',
        ),
        'spacing' => array(
            'type' => 'string',
            'default' => 'large',
        ),
        'image' => array(
            'type' => 'string',
        ),
        'size' => array(
            'type' => 'string',
            'default' => 'medium',
        ),
    )
));
