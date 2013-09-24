<?php
class Character extends CobCommon implements CreatureInterface {
    public $name = '';
    protected $_baseAtk      = 10;
    protected $_weaponDamage = 12;
    protected $_armorClass   = 15;
    protected $_hitPoints    = 100;
    protected $_hpMax        = 100;
    protected $_charAttrs    = array(
        'STR' => 18,
        'DEX' => 16,
        'CON' => 16,
        'INT' => 14,
        'WIS' => 12,
        'CHA' => 14,
    );

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
        $dexMod = $this->getAbilityModifier($this->_charAttrs['DEX']);
        return $this->_armorClass + $dexMod;
    }
    
    public function getHp() {
        return $this->_hitPoints;
    }

    public function getInitiative() {
        $dexMod = $this->getAbilityModifier($this->_charAttrs['DEX']);
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