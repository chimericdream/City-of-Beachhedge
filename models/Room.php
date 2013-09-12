<?php
class Room extends CobCommon {
    public $name        = '';
    public $description = '';
    public $exits       = array();
    public $items       = array();
    public $mobs        = array();

    public function __construct($roomNum) {
        $roomNum = str_pad($roomNum, 4, '0', STR_PAD_LEFT);
        $roomArr = json_decode(file_get_contents(dirname(__FILE__) . '/../data/rooms/' . $roomNum . '.txt'), true);

        $this->name        = $this->replaceColors($roomArr['name']);
        $this->description = $this->replaceColors($roomArr['description']);
        $this->exits       = $roomArr['exits'];
        foreach ($roomArr['items'] as $key => $item) {
            $type = ucfirst($item['type']);
            $classname = "Entity_Item_{$type}";
            if (class_exists($classname)) {
                $i = new $classname($item);
                $this->items[] = $i;
            }
        }
        var_dump($this);
    }

    public function display() {
        
    }
}