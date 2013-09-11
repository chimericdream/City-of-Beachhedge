<?php
require_once dirname(__FILE__) . '/Command.php';
require_once dirname(__FILE__) . '/../models/Room.php';
require_once dirname(__FILE__) . '/../models/Character.php';
require_once dirname(__FILE__) . '/../models/Entity.php';

define('GAME_TEXT_COLOR',      "\033[00;37;40m"); // white, not bright
define('GAME_INPUT_COLOR',     "\033[01;37;40m"); // white, bright
define('GAME_PROMPT_COLOR',    "\033[01;36;40m"); // teal, bright
define('GAME_COMMAND_COLOR',   "\033[01;32;40m"); // green, bright
define('CHARACTER_NAME_COLOR', "\033[01;33;40m"); // yellow, bright

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
        
    }
}