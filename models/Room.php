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
                $this->items[$key] = $i;
            }
        }
        $this->description = $this->replaceItemReferences($this->description, $this->items);
    }

    public function display() {
        echo $this->name . GAME_TEXT_COLOR . "\n";
        echo $this->description . GAME_TEXT_COLOR . "\n";
        echo WHITE . 'Exits:' . GAME_TEXT_COLOR;
        $e = array();
        foreach ($this->exits as $dir => $id) {
            $e[] = $dir;
        }
        echo implode(',', $e);
        echo "\n\n";
        if (!empty($this->items)) {
            foreach ($this->items as $i) {
                echo $i->longDesc . "\n";
            }
            echo "\n";
        }

        //var_dump($this);
    }
}