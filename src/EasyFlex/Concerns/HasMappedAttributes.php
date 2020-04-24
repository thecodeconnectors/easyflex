<?php

namespace TheCodeConnectors\EasyFlex\EasyFlex\Concerns;

trait HasMappedAttributes
{
    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $mappedAttributes = [];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setAttributes($attributes);
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes = []): void
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function setAttribute($key, $value)
    {
        var_dump($key);
        exit();
        
        if ($this->hasAttribute($key)) {
            $this->attributes[$key] = $value;
        } else if ($mapped = $this->getMappedAttributeName($key)) {
            $this->attributes[$mapped] = $value;
        }
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function hasAttribute($key)
    {
        return array_key_exists($key, $this->attributes);
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function hasMappedAttribute($key)
    {
        return array_key_exists($key, $this->mappedAttributes);
    }

    /**
     * @param $key
     *
     * @return string|null
     */
    public function getMappedAttributeName($key)
    {
        if (array_key_exists($key, $this->mappedAttributes)) {
            return $this->mappedAttributes[$key];
        }

        if (in_array($key, $this->mappedAttributes, true)) {
            return array_search($key, $this->mappedAttributes, true);
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $key = $this->getAttributeName($key);
        $this->setAttribute($key, $value);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        $key = $this->getAttributeName($key) ?: $key;

        return $this->getAttribute($key);
    }

    /**
     * @param $key
     *
     * @return false|int|string
     */
    protected function getAttributeName($key)
    {
        if (property_exists($this, $key)) {
            return $key;
        }

        $key = $this->getMappedAttributeName($key);

        if (property_exists($this, $key)) {
            return $key;
        }

        return $key;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    protected function getAttribute($key)
    {
        if ($this->hasAttribute($key)) {
            return $this->attributes[$key];
        }

        if ($mapped = $this->getMappedAttributeName($key)) {
            return $this->attributes[$mapped];
        }
    }
}
