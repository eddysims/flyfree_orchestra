<?php

new FlyfreeBlock( 'hero-image', array(
    'attributes' => array(
        'id' => array(
            'type' => 'string',
        ),
        'spacing' => array(
            'type' => 'string',
            'default' => 'zero',
        ),
        'pretitle' => array(
            'type' => 'string',
        ),
        'title' => array(
            'type' => 'string',
        )
    )
));
