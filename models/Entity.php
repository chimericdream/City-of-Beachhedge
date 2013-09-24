<?php
require_once dirname(__FILE__) . '/Entity/Item.php';
require_once dirname(__FILE__) . '/Entity/Mob.php';

class Entity extends CobCommon {
    protected $_defaults   = array();
    protected $_attributes = array();

    public function __construct(array $data) {
        $this->_attributes = array_merge($this->_defaults, $data);
//        $this->name      = empty($data['name'])      ? ''               : $this->replaceColors($data['name']);
//        $this->shortName = empty($data['shortName']) ? $this->name      : $this->replaceColors($data['shortName']);
//        $this->shortDesc = empty($data['shortDesc']) ? ''               : $this->replaceColors($data['shortDesc']);
//        $this->longDesc  = empty($data['longDesc'])  ? $this->shortDesc : $this->replaceColors($data['longDesc']);
//        $this->keywords  = empty($data['keywords'])  ? array()          : $data['keywords'];
    }

    public function __get($name) {
        if (!empty($this->_attributes[$name])) {
            return $this->replaceColors($this->_attributes[$name]);
        }
        return "PROPERTY NOT SET";
    }

    public function canOpen() {
        echo ERROR_TEXT_COLOR . 'You can\'t open that!' . GAME_TEXT_COLOR . "\n\n";
        return false;
    }

    public function canClose() {
        echo ERROR_TEXT_COLOR . 'You can\'t close that!' . GAME_TEXT_COLOR . "\n\n";
        return false;
    }

    public function canKill() {
        echo ERROR_TEXT_COLOR . 'You can\'t kill that!' . GAME_TEXT_COLOR . "\n\n";
        return true;
    }

    public function canExamine() {
        echo ERROR_TEXT_COLOR . 'You can\'t examine that!' . GAME_TEXT_COLOR . "\n\n";
        return false;
    }
}