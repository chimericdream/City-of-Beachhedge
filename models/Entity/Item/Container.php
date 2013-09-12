<?php
class Entity_Item_Container extends Entity_Item {
    public function __construct(array $data) {
        $this->name = $this->replaceColors($data['name']);
    }
}