<?php
class Command {
    private $_validCommands = array(
        'n',
        's',
        'e',
        'w',
        'get',
        'put',
        'open',
        'close',
        'drop',
        'kill',
    );

    private $_cmd = NULL;

    public function __construct($c) {
        $this->_cmd = $c;
    }

    public function validateCommand() {
        if (!in_array($this->_cmd['command'], $this->_validCommands)) {
            echo ERROR_TEXT_COLOR . 'Sorry, I didn\'t understand that!' . GAME_TEXT_COLOR . ' (Type ' . GAME_COMMAND_COLOR . 'help' . GAME_TEXT_COLOR . ' for a list of commands)' . "\n\n";
            return;
        }

        switch ($this->_cmd['command']) {
            case 'n':
            case 's':
            case 'e':
            case 'w':
                break;
            case 'get':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What do you want to get?' . GAME_TEXT_COLOR . "\n\n";
                    return;
                }
                break;
            case 'put':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What are you putting, and where?' . GAME_TEXT_COLOR . "\n\n";
                    return;
                }
                if (count($this->_cmd['params']) == 1) {
                    echo ERROR_TEXT_COLOR . 'Where are you putting that?' . GAME_TEXT_COLOR . "\n\n";
                    return;
                }
                break;
            case 'open':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What do you want to open?' . GAME_TEXT_COLOR . "\n\n";
                    return;
                }
                break;
            case 'close':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What do you want to close?' . GAME_TEXT_COLOR . "\n\n";
                    return;
                }
                break;
            case 'drop':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What do you want to drop?' . GAME_TEXT_COLOR . "\n\n";
                    return;
                }
                break;
            case 'kill':
            if (empty($this->_cmd['params'])) {
                echo ERROR_TEXT_COLOR . 'What do you want to kill?' . GAME_TEXT_COLOR . "\n\n";
                return;
            }
            break;
        }
    }
}