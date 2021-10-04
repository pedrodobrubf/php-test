<?php

namespace Live\Collection;

/**
 * Memory collection
 *
 * @package Live\Collection
 */
class MemoryCollection implements CollectionInterface
{
    /**
     * Collection data
     *
     * @var array
     */
    protected $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $index, $defaultValue = null)
    {
        if (!$this->has($index)) {
            return $defaultValue;
        }
        if (strtotime($this->data[$index]['expirationTime']) < strtotime(date('H:i:s', time() + 3600))) {
            return $this->data[$index][0];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $index, $value, $expirationTime = null)
    {
        if ($expirationTime == null) {
            $expirationTime = '11:59:59';
        }
        $value = [$value, 'expirationTime' => $expirationTime];
        $this->data[$index] = $value;
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
