<?php
require_once dirname(__FILE__) . '/Command.php';
require_once dirname(__FILE__) . '/../models/Room.php';
require_once dirname(__FILE__) . '/../models/Character.php';
require_once dirname(__FILE__) . '/../models/Entity.php';

class Game {
    const STANDARD_COMMAND  = true;
    const FULL_LINE_COMMAND = false;

    public $characterName = '';

    private $_input = NULL;

    public function __construct() {
        $this->_input = fopen("php://stdin","r");
        if (empty($this->_input)) {
            //@TODO: display error
            exit;
        }
    }

    public function initialize() {
        return $this;
    }

    public function run() {
        echo GAME_PROMPT_COLOR . 'Please enter your name: ' . GAME_INPUT_COLOR;
        $this->characterName = $this->_getInput(self::FULL_LINE_COMMAND);

        echo GAME_TEXT_COLOR . 'Hello, ' . CHARACTER_NAME_COLOR . $this->characterName . GAME_TEXT_COLOR . "!\n\n"
           . "Welcome to the world of Pannotia and the City of Beachhedge. Look around, explore, and have fun! If\n"
           . 'you need help at any time, type ' . GAME_COMMAND_COLOR . 'help' . GAME_TEXT_COLOR . ' or ' . GAME_COMMAND_COLOR . 'commands' . GAME_TEXT_COLOR . ".\n\n";

        while (true) {
            echo GAME_PROMPT_COLOR . 'Command: ' . GAME_INPUT_COLOR;
            $c = $this->_getInput();
            echo GAME_TEXT_COLOR;

            if ($c['command'] == 'quit' || $c['command'] == 'q' || $c['command'] == 'exit') {
                break;
            } else if ($c['command'] == 'help' || $c['command'] == 'commands') {
                $this->_showHelpScreen();
                continue;
            }

            $cmd = new Command($c);
            if ($cmd->validateCommand()) {
                
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
           . '   ' . GAME_COMMAND_COLOR . 'get' . GAME_SEC_COMMAND_COLOR . ' <object>' . GAME_TEXT_COLOR . "                    Pick up <object>\n"
           . '   ' . GAME_COMMAND_COLOR . 'get' . GAME_SEC_COMMAND_COLOR . ' <item> <container>' . GAME_TEXT_COLOR . "          Get <item> from <container>\n"
           . '   ' . GAME_COMMAND_COLOR . 'put' . GAME_SEC_COMMAND_COLOR . ' <item> <container>' . GAME_TEXT_COLOR . "          Put <item> in <container>\n"
           . '   ' . GAME_COMMAND_COLOR . 'open' . GAME_TEXT_COLOR . '/' . GAME_COMMAND_COLOR . 'close' . GAME_SEC_COMMAND_COLOR . ' <container>' . GAME_TEXT_COLOR . "          Open or close <container>\n"
           . '   ' . GAME_COMMAND_COLOR . 'drop' . GAME_SEC_COMMAND_COLOR . ' <object>' . GAME_TEXT_COLOR . "                   Drop <object>\n"
           . '   ' . GAME_COMMAND_COLOR . 'kill' . GAME_SEC_COMMAND_COLOR . ' <monster>' . GAME_TEXT_COLOR . "                  Attack <monster>\n";
    }
}