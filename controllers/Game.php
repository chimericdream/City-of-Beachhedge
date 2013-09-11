<?php
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
        echo "\033[01;36;40mPlease enter your name: \033[01;37;40m";
        $this->characterName = $this->_getInput(self::FULL_LINE_COMMAND);

        echo "\033[00;37;40mHello, \033[01;33;40m{$this->characterName}\033[00;37;40m!\n\n";

        echo 'Welcome to the world of Pannotia and the City of Beachhedge. Look around, explore, and have fun!' . "\n\n";

        while (true) {
            $command = $this->_getInput();
            if ($command == 'quit' || $command == 'q' || $command == 'exit') {
                break;
            }
        }
    }

    private function _getInput($commandType = self::STANDARD_COMMAND) {
        $line = trim(fgets($this->_input));

        if ($commandType == self::FULL_LINE_COMMAND) {
            return $line;
        } else if ($commandType == self::STANDARD_COMMAND) {
            return $line;
        }
    }
}