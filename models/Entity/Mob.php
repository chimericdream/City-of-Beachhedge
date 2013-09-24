<?php
require_once dirname(__FILE__) . '/Mob/Peasant.php';
require_once dirname(__FILE__) . '/Mob/Warrior.php';

class Entity_Mob extends Entity {
    const STATE_ALIVE = 1;
    const STATE_DEAD  = 0;

    protected $_currentState = self::STATE_ALIVE;

    public function __get($name) {
        if ($this->_currentState == self::STATE_DEAD && $name == 'longDesc') {
            return $this->replaceColors($this->_attributes['deadLongDesc']);
        }
        return parent::__get($name);
    }

    public function canKill() {
        if ($this->_currentState == self::STATE_DEAD) {
            echo ERROR_TEXT_COLOR . 'That is already dead!' . GAME_TEXT_COLOR . "\n";
            return false;
        }
        return true;
    }

    public function kill() {
        $this->_currentState = self::STATE_DEAD;
    }
}