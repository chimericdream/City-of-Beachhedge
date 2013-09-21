<?php
require_once dirname(__FILE__) . '/Mob/Peasant.php';
require_once dirname(__FILE__) . '/Mob/Warrior.php';

class Entity_Mob extends Entity {
    const STATE_ALIVE = 1;
    const STATE_DEAD  = 0;
}