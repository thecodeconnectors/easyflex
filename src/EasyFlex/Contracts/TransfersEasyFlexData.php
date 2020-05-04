<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Contracts;

interface TransfersEasyFlexData
{
    /**
     * @return array
     */
    public function fields(): array;

    /**
     * @param array $attributes
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Contracts\TransfersEasyFlexData|static
     */
    public static function fromEasyFlex(array $attributes = []): TransfersEasyFlexData;

    /**
     * @param array $attributes
     *
     * @return \TheCodeConnectors\EasyFlex\EasyFlex\Contracts\TransfersEasyFlexData|static
     */
    public static function toEasyFlex(array $attributes = []): TransfersEasyFlexData;
}
