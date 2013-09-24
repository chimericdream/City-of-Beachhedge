<?php
class Entity_Mob_Warrior extends Entity_Mob {
    protected $_baseAtk      = 5;
    protected $_weaponDamage = 10;
    protected $_armorClass   = 12;
    protected $_hitPoints    = 75;
    protected $_hpMax        = 75;
    protected $_charAttrs    = array(
        'STR' => 18,
        'DEX' => 14,
        'CON' => 12,
        'INT' => 12,
        'WIS' => 8,
        'CHA' => 10,
    );

    protected $_defaults = array(
        'name'         => 'A tough looking warrior',
        'shortName'    => 'A warrior',
        'shortDesc'    => '%RED%A warrior',
        'longDesc'     => 'A %RED%warrior %GAME_TEXT_COLOR%is here, looking tough.',
        'keywords'     => array('warrior', 'tough'),
        'deadLongDesc' => 'The body of a %RED%warrior%GAME_TEXT_COLOR% is here, circled by flies.',
    );
}