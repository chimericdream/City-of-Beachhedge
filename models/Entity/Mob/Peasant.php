<?php
class Entity_Mob_Peasant extends Entity_Mob {
    protected $_defaults = array(
        'name'      => 'A simple-looking peasant',
        'shortName' => 'A peasant',
        'shortDesc' => '%YELLOW%A peasant',
        'longDesc'  => 'A simple %YELLOW%peasant%GAME_TEXT_COLOR% is in town for some shopping.',
        'keywords'  => array('peasant', 'simple'),
    );
}