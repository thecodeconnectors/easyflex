<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

use TheCodeConnectors\EasyFlex\EasyFlex\Contracts\TransfersEasyFlexData;

trait TransfersFieldsToEasyFlexFields
{

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Concerns\TransfersFieldsToEasyFlexFields|\TheCodeConnectors\EasyFlex\EasyFlex\Contracts\TransfersEasyFlexData
     */
    public function toEnglish()
    {
        return static::fromEasyFlex($this->attributes);
    }

    /**
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Concerns\TransfersFieldsToEasyFlexFields|\TheCodeConnectors\EasyFlex\EasyFlex\Contracts\TransfersEasyFlexData
     */
    public function toDutch()
    {
        return static::toEasyFlex($this->attributes);
    }

    /**
     * @param array $attributes
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Contracts\TransfersEasyFlexData|static
     */
    public static function fromEasyFlex(array $attributes = []): TransfersEasyFlexData
    {
        $instance = new static;
        $fields   = $instance->fields();

        static::ensureAllAttributesHasFields(array_keys($attributes), $fields);

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

        static::ensureAllAttributesHasFields(array_keys($attributes), $fields);

        foreach ($attributes as $key => $value) {
            $key = $fields[$key];
            $instance->setAttribute($key, $value);
        }

        return $instance;
    }

    /**
     * @param array $attributes
     * @param array $fields
     */
    public static function ensureAllAttributesHasFields(array $attributes = [], array $fields = [])
    {
        $attributeCount = count($attributes);
        $fieldCount     = count($fields);

        if ($attributeCount > $fieldCount) {
            throw new \InvalidArgumentException("Missing fields in " . static::class . " for attributes: " . implode(',', array_diff(array_keys($attributes), $fields)));
        }
    }
}
