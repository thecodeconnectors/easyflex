<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Contracts\TransfersEasyFlexData;

trait TransfersFieldsToEasyFlexFields
{

    /**
     * @param array $attributes
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Contracts\TransfersEasyFlexData|static
     */
    public static function fromEasyFlex(array $attributes = []): TransfersEasyFlexData
    {
        $instance = new static;
        $fields   = $instance->fields();
        foreach ($attributes as $key => $value) {
            $key = array_search($key, $fields, true);
            $instance->setAttribute($key, $value);
        }

        return $instance;
    }

    /**
     * @param array $attributes
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Contracts\TransfersEasyFlexData|static
     */
    public static function toEasyFlex(array $attributes = []): TransfersEasyFlexData
    {
        $instance = new static;
        $fields   = $instance->fields();

        foreach ($attributes as $key => $value) {
            $key = $fields[$key];
            $instance->setAttribute($key, $value);
        }

        return $instance;
    }
}
