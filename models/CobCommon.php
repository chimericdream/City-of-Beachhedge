<?php
abstract class CobCommon {
    protected function replaceColors($input) {
        $input = str_replace(
            array(
				'%DARK_GRAY%',
				'%BLUE%',
				'%BLUE_BRIGHT%',
				'%MAGENTA%',
				'%MAGENTA_BRIGHT%',
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
				DARK_GRAY,
				BLUE,
				BLUE_BRIGHT,
				MAGENTA,
				MAGENTA_BRIGHT,
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

    protected function replaceEntityReferences($input, array $entities) {
        foreach ($entities as $key => $entity) {
            $input = str_replace('{' . $key . '}', $entity->shortName, $input);
        }
        return $input;
    }

    protected function getAbilityModifier($ability) {
        return floor(($ability - 10) / 2);
    }
}