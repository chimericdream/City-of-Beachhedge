<?php
class Entity_Mob_Warrior extends Entity_Mob {
    protected $_defaults = array(
        'name'         => 'A tough looking warrior',
        'shortName'    => 'A warrior',
        'shortDesc'    => '%RED%A warrior',
        'longDesc'     => 'A %RED%warrior %GAME_TEXT_COLOR%is here, looking tough.',
        'keywords'     => array('warrior', 'tough'),
        'deadLongDesc' => 'The body of a %RED%warrior%GAME_TEXT_COLOR% is here, circled by flies.',
    );
}