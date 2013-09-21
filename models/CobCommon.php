<?php
abstract class CobCommon {
    protected function replaceColors($input) {
        $input = str_replace(
            array(
                '%GREEN%',
                '%GREEN_BRIGHT%',
                '%RED%',
                '%RED_BRIGHT%',
                '%TEAL%',
                '%TEAL_BRIGHT%',
                '%WHITE%',
                '%WHITE_BRIGHT%',
                '%YELLOW%',
                '%YELLOW_BRIGHT%',
                '%GAME_TEXT_COLOR%',
                '%GAME_INPUT_COLOR%',
                '%GAME_PROMPT_COLOR%',
                '%GAME_COMMAND_COLOR%',
                '%GAME_SEC_COMMAND_COLOR%',
                '%CHARACTER_NAME_COLOR%',
                '%ERROR_TEXT_COLOR%',
            ), 
            array(
                GREEN,
                GREEN_BRIGHT,
                RED,
                RED_BRIGHT,
                TEAL,
                TEAL_BRIGHT,
                WHITE,
                WHITE_BRIGHT,
                YELLOW,
                YELLOW_BRIGHT,
                GAME_TEXT_COLOR,
                GAME_INPUT_COLOR,
                GAME_PROMPT_COLOR,
                GAME_COMMAND_COLOR,
                GAME_SEC_COMMAND_COLOR,
                CHARACTER_NAME_COLOR,
                ERROR_TEXT_COLOR,
            ), 
            $input
        );
        return $input;
    }

    protected function replaceItemReferences($input, array $items) {
        foreach ($items as $key => $item) {
            $input = str_replace('{' . $key . '}', $item->shortName, $input);
        }
        return $input;
    }
}