<?php
require_once dirname(__FILE__) . '/../models/CobCommon.php';
require_once dirname(__FILE__) . '/Command.php';
require_once dirname(__FILE__) . '/../models/Room.php';
require_once dirname(__FILE__) . '/../models/Character.php';
require_once dirname(__FILE__) . '/../models/Entity.php';

class Game extends CobCommon {
    const STANDARD_COMMAND  = true;
    const FULL_LINE_COMMAND = false;

    public $characterName = '';

    private $_rooms       = array();
    private $_input       = NULL;
    private $_currentRoom = NULL;

    public function __construct() {
        $this->_input = fopen("php://stdin","r");
        if (empty($this->_input)) {
            //@TODO: display error
            exit;
        }
    }

    public function initialize() {
        for ($r = 1; $r <=225; $r++) {
            $this->_rooms[$r] = new Room($r);
        }
        return $this;
    }

    public function run() {
        echo TEAL_BRIGHT . 'Please enter your name: ' . GAME_INPUT_COLOR;
        $this->characterName = $this->_getInput(self::FULL_LINE_COMMAND);

        echo GAME_TEXT_COLOR . 'Hello, ' . CHARACTER_NAME_COLOR . $this->characterName . GAME_TEXT_COLOR . "!\n\n"
           . "Welcome to the world of Pannotia and the City of Beachhedge. Look around,\n"
           . 'explore, and have fun! If you need help at any time, type ' . GAME_COMMAND_COLOR . 'help' . GAME_TEXT_COLOR . ' or ' . GAME_COMMAND_COLOR . 'commands' . GAME_TEXT_COLOR . ".\n\n";

        $this->_currentRoom = $this->_rooms[1];
        while (true) {
            $this->_currentRoom->display();

            echo GAME_PROMPT_COLOR . '?> ' . GAME_INPUT_COLOR;
            $c = $this->_getInput();
            echo GAME_TEXT_COLOR;

            if ($c['command'] == 'quit' || $c['command'] == 'q' || $c['command'] == 'exit') {
                break;
            } else if ($c['command'] == 'help' || $c['command'] == 'commands') {
                $this->_showHelpScreen();
                continue;
            }

            $cmd = new Command($c, $this);
            if ($cmd->validateCommand()) {
                $cmd->runCommand();
            }
        }
    }

    private function _getInput($commandType = self::STANDARD_COMMAND) {
        $line = trim(fgets($this->_input));

        if ($commandType == self::FULL_LINE_COMMAND) {
            return $line;
        } else if ($commandType == self::STANDARD_COMMAND) {
            $commandarr = explode(' ', strtolower($line));

            $c = array();
            $c['command'] = array_shift($commandarr);
            $c['params']  = $commandarr;

            return $c;
        }
    }

    private function _showHelpScreen() {
        echo YELLOW_BRIGHT . 'City of Beachhedge: Help Screen' . GAME_TEXT_COLOR . "\n"
           . '   ' . GAME_COMMAND_COLOR . 'help' . GAME_TEXT_COLOR . ',' . GAME_COMMAND_COLOR . 'commands' . GAME_TEXT_COLOR . "                   Show this screen\n"
           . '   ' . GAME_COMMAND_COLOR . 'quit' . GAME_TEXT_COLOR . ',' . GAME_COMMAND_COLOR . 'q' . GAME_TEXT_COLOR . ',' . GAME_COMMAND_COLOR . 'exit' . GAME_TEXT_COLOR . "                     Exit the game\n"
           . '   ' . GAME_COMMAND_COLOR . 'n' . GAME_TEXT_COLOR . ',' . GAME_COMMAND_COLOR . 's' . GAME_TEXT_COLOR . ',' . GAME_COMMAND_COLOR . 'e' . GAME_TEXT_COLOR . ',' . GAME_COMMAND_COLOR . 'w' . GAME_TEXT_COLOR . "                         Move north, south, east or west, respectively\n"
//           . '   ' . GAME_COMMAND_COLOR . 'get' . GAME_SEC_COMMAND_COLOR . ' <object>' . GAME_TEXT_COLOR . "                    Pick up <object>\n"
//           . '   ' . GAME_COMMAND_COLOR . 'get' . GAME_SEC_COMMAND_COLOR . ' <item> <container>' . GAME_TEXT_COLOR . "          Get <item> from <container>\n"
//           . '   ' . GAME_COMMAND_COLOR . 'put' . GAME_SEC_COMMAND_COLOR . ' <item> <container>' . GAME_TEXT_COLOR . "          Put <item> in <container>\n"
           . '   ' . GAME_COMMAND_COLOR . 'open' . GAME_TEXT_COLOR . '/' . GAME_COMMAND_COLOR . 'close' . GAME_SEC_COMMAND_COLOR . ' <container>' . GAME_TEXT_COLOR . "          Open or close <container>\n"
//           . '   ' . GAME_COMMAND_COLOR . 'drop' . GAME_SEC_COMMAND_COLOR . ' <object>' . GAME_TEXT_COLOR . "                   Drop <object>\n"
           . '   ' . GAME_COMMAND_COLOR . 'kill' . GAME_SEC_COMMAND_COLOR . ' <monster>' . GAME_TEXT_COLOR . "                  Attack <monster>\n";

       echo "\n";
    }

    public function presentInRoom($keyword) {
        foreach ($this->_currentRoom->getItems() as $item) {
            foreach ($item->keywords as $k) {
                if ($k == $keyword) {
                    return true;
                }
            }
        }
        foreach ($this->_currentRoom->getMobs() as $mob) {
            foreach ($mob->keywords as $k) {
                if ($k == $keyword) {
                    return true;
                }
            }
        }
        return false;
    }

    public function heldInHand($keyword) {
        return false;
    }

    public function inContainer($keyword, $container) {
        return false;
    }

    public function changeRoom($roomID) {
        if (!isset($this->_rooms[$roomID])) {
            //@TODO: display error
            exit;
        }
        $this->_currentRoom = $this->_rooms[$roomID];
    }

    public function getCurrentRoom() {
        return $this->_currentRoom;
    }
}