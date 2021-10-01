<?php

namespace Live\Collection;

class FileCollection implements CollectionInterface
{

    /**
     * Collection file
     *
     * @var array
     */
    protected $file;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->file = [];
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $index, $defaultValue = null)
    {
        if (!$this->has('index')) {
            return $defaultValue;
        }
        if ($this->file[$index]['expirationTime'] < date('H:i:s', time() + 3600)) {
            return $this->file[$index];
        }
        return $defaultValue;
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $index, $value, $expirationTime = null)
    {
        if ($expirationTime == null) {
            $expirationTime = time() + 3600;
        }
        $value = [$value, $expirationTime];
        $this->file[$index] = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $index)
    {
        return array_key_exists($index, $this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        /**
         *  Since function count of interface Countable return number of elements
         *  in an array add 1 to returned value will generate a inconsistent value
         * */
        return count($this->data);
    }

    /**
     * {@inheritDoc}
     */
    public function clean()
    {
        $this->data = [];
    }
}
