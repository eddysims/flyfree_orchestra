<?php

new FlyfreeBlock( 'block-content', array(
    'attributes' => array(
        'align' => array(
            'type' => 'string',
            'default' => 'center',
        ),
        'id' => array(
            'type' => 'string',
        ),
        'spacing' => array(
            'type' => 'string',
            'default' => 'large',
        ),
    )
));
