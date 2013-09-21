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
        'exa',
        'examine',
    );

    private $_cmd = NULL;

    public function __construct($c, Game $g) {
        $this->_cmd  = $c;
        $this->_game = $g;
    }

    public function validateCommand() {
        if (!in_array($this->_cmd['command'], $this->_validCommands)) {
            echo ERROR_TEXT_COLOR . 'Sorry, I didn\'t understand that!' . GAME_TEXT_COLOR . ' (Type ' . GAME_COMMAND_COLOR . 'help' . GAME_TEXT_COLOR . ' for a list of commands)' . "\n\n";
            return false;
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
                    return false;
                }
                break;
            case 'put':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What are you putting, and where?' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                if (count($this->_cmd['params']) == 1) {
                    echo ERROR_TEXT_COLOR . 'Where are you putting that?' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                $item = array_shift($this->_cmd['params']);
                if (!$this->_game->heldInHand($item)) {
                    echo ERROR_TEXT_COLOR . 'You are not holding that item.' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                $container = array_shift($this->_cmd['params']);
                if (!$this->_game->heldInHand($container) && !$this->_game->presentInRoom($container)) {
                    echo ERROR_TEXT_COLOR . 'You do not see that container.' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                break;
            case 'open':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What do you want to open?' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                if (!$this->_game->heldInHand($item) && !$this->_game->presentInRoom($item)) {
                    echo ERROR_TEXT_COLOR . 'Nothing here to open.' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                break;
            case 'close':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What do you want to close?' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                $item = array_shift($this->_cmd['params']);
                if (!$this->_game->heldInHand($item) && !$this->_game->presentInRoom($item)) {
                    echo ERROR_TEXT_COLOR . 'Nothing here to close.' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                break;
            case 'drop':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What do you want to drop?' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                $item = array_shift($this->_cmd['params']);
                if (!$this->_game->heldInHand($item)) {
                    echo ERROR_TEXT_COLOR . 'You are not holding that.' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                break;
            case 'kill':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What do you want to kill?' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                $enemy = array_shift($this->_cmd['params']);
                if (!$this->_game->presentInRoom($enemy)) {
                    echo ERROR_TEXT_COLOR . 'Nobody here by that name.' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                break;
            case 'exa':
            case 'examine':
                if (empty($this->_cmd['params'])) {
                    echo ERROR_TEXT_COLOR . 'What do you want to examine?' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                $entity = array_shift($this->_cmd['params']);
                if (!$this->_game->presentInRoom($entity) && !$this->_game->heldInHand($entity)) {
                    echo ERROR_TEXT_COLOR . 'Nobody here by that name.' . GAME_TEXT_COLOR . "\n\n";
                    return false;
                }
                break;
        }
        return true;
    }

    public function runCommand() {
        switch ($this->_cmd['command']) {
            case 'n':
            case 's':
            case 'e':
            case 'w':
                if ($this->_game->getCurrentRoom()->hasExit($this->_cmd['command'])) {
                    $this->_game->changeRoom($this->_game->getCurrentRoom()->getRoomNumber($this->_cmd['command']));
                }
                break;
            case 'get':
                break;
            case 'put':
                break;
            case 'open':
                break;
            case 'close':
                break;
            case 'drop':
                break;
            case 'kill':
                break;
            case 'exa':
            case 'examine':
                break;
        }
    }
}