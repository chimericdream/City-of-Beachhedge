<?php
class Entity_Mob_Peasant extends Entity_Mob {
    protected $_baseAtk      = 1;
    protected $_weaponDamage = 12;
    protected $_armorClass   = 12;
    protected $_hitPoints    = 50;
    protected $_hpMax        = 50;
    protected $_charAttrs    = array(
        'STR' => 12,
        'DEX' => 10,
        'CON' => 12,
        'INT' => 12,
        'WIS' => 8,
        'CHA' => 10,
    );

    protected $_defaults = array(
        'name'         => 'A simple-looking peasant',
        'shortName'    => 'A peasant',
        'shortDesc'    => '%YELLOW%A peasant',
        'longDesc'     => 'A simple %YELLOW%peasant%GAME_TEXT_COLOR% is in town for some shopping.',
        'keywords'     => array('peasant', 'simple'),
        'deadLongDesc' => 'The body of a simple %YELLOW%peasant%GAME_TEXT_COLOR% is here.',
    );
}