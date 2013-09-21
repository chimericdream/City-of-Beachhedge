<?php
require_once dirname(__FILE__) . '/Entity/Item.php';
require_once dirname(__FILE__) . '/Entity/Mob.php';

class Entity extends CobCommon {
    public $name;
    public $shortName;
    public $shortDesc;
    public $longDesc;

    public function __construct(array $data) {
        $this->name      = empty($data['name'])      ? ''               : $this->replaceColors($data['name']);
        $this->shortName = empty($data['shortName']) ? $this->name      : $this->replaceColors($data['shortName']);
        $this->shortDesc = empty($data['shortDesc']) ? ''               : $this->replaceColors($data['shortDesc']);
        $this->longDesc  = empty($data['longDesc'])  ? $this->shortDesc : $this->replaceColors($data['longDesc']);
    }
}