<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

trait HasFields
{
    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @return array
     */
    public function fields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     *
     * @return $this
     */
    public function setFields(array $fields = []): self
    {
        $this->fields = $fields;

        return $this;
    }

}
