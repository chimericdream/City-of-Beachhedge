<?php
abstract class Entity_Mob extends Entity implements CreatureInterface {
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

    public function getAttackRoll() {
        $strMod = $this->getAbilityModifier($this->_charAttrs['STR']);
        $d20 = rand(1,20);
        return $this->_baseAtk + $strMod + $d20;
    }
    
    public function getDamage() {
        $strMod = $this->getAbilityModifier($this->_charAttrs['STR']);
        $dieRoll = rand(1, $this->_weaponDamage);
        return $dieRoll + $strMod;
    }
    
    public function getAc() {
        $dexMod = floor(($this->_charAttrs['DEX'] - 10) / 2);
        return $this->_armorClass + $dexMod;
    }
    
    public function getHp() {
        return $this->_hitPoints;
    }

    public function getInitiative() {
        $dexMod = floor(($this->_charAttrs['DEX'] - 10) / 2);
        $d20 = rand(1,20);
        return $dexMod + $d20;
    }

    public function damage($amt = 0) {
        $this->_hitPoints -= $amt;
        return $this;
    }

    public function heal($amt = 0) {
        $this->_hitPoints += $amt;
        if ($this->_hitPoints > $this->_hpMax) {
            $this->_hitPoints = $this->_hpMax;
        }
        return $this;
    }
}

require_once dirname(__FILE__) . '/Mob/Peasant.php';
require_once dirname(__FILE__) . '/Mob/Warrior.php';