<?php
interface CreatureInterface {
    public function getAttackRoll();
    public function getDamage();
    public function getAc();
    public function getHp();
    public function getInitiative();
    public function damage($amt = 0);
    public function heal($amt = 0);
}