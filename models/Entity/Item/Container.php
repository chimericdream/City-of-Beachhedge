<?php
class Entity_Item_Container extends Entity_Item {
    const STATE_OPEN   = 1;
    const STATE_CLOSED = 0;

    protected $_defaults = array(
        'name'      => '%GREEN%bag%GAME_TEXT_COLOR%',
        'shortName' => '',
        'shortDesc' => '%YELLOW%A peasant',
        'longDesc'  => 'A %GREEN%bag%GAME_TEXT_COLOR% is laying on the ground.',
        'keywords'  => array('bag', 'sack'),
    );
}