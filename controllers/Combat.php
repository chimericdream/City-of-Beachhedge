<?php
class Combat {
    private $_player = NULL;
    private $_enemy  = NULL;

    public function __construct(Character $player, Entity_Mob $enemy) {
        $this->_player = $player;
        $this->_enemy  = $enemy;
    }

    public function run() {
        $pinit = $this->_player->getInitiative();
        $einit = $this->_enemy->getInitiative();
        if ($pinit > $einit) {
            $init = array($this->_player, $this->_enemy);
        } else {
            $init = array($this->_enemy, $this->_player);
        }

        $i = 1;
        while (true) {
            $currPlayer = ($i - 1) % 2;
            $currEnemy  = ($currPlayer + 1) % 2;

            if ($currPlayer == 0) {
                echo "\n";
            }

            $atk = $init[$currPlayer]->getAttackRoll();
            $ac  = $init[$currEnemy]->getAc();
            if ($atk >= $ac) {
                $dmg = $init[$currPlayer]->getDamage();
                $init[$currEnemy]->damage($dmg);
                if ($init[$currPlayer] instanceof Character) {
                    echo "You hit {$this->_enemy->shortName}";
                } else {
                    echo "{$this->_enemy->shortName} hits you";
                }
                echo " for {$dmg} damage!\n";
            } else {
                if ($init[$currPlayer] instanceof Character) {
                    echo "You swing wildly, missing {$this->_enemy->shortName} with your attack.\n";
                } else {
                    echo "{$this->_enemy->shortName} swings wildly, missing you by a mile.\n";
                }
            }

            if ($this->_player->getHp() <= 0) {
                echo "You have been killed by {$this->_enemy->shortName}!\n";
                exit;
            }
            if ($this->_enemy->getHp() <= 0) {
                echo "You have managed to kill {$this->_enemy->shortName}!\n";
                $this->_player->heal(999);
                break;
            }

            $i++;
            sleep(1);
        }
    }
}