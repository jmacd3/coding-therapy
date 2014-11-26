<?php

namespace CodingTherapy\ChangeMaker;

class CurrencyContainer implements \Iterator
{
    /**
     * Currency config array
     * @var array
     */
    protected $currencyConfig;

    /**
     * Constructor
     *
     * @param $currencyConfig
     */
    public function __construct($currencyConfig) {
        $this->currencyConfig = $currencyConfig;
        $this->init();
    }

    /**
     * Initialize currency container
     *
     */
    public function init()
    {
        // Sort currencyCofig (descending)
        usort($this->currencyConfig, function ($a, $b) {
            return $a['value'] < $b['value'];
        });


    }

    /**
     * Rewind container
     * @see Iterator Interface
     */
    public function rewind()
    {
        reset($this->currencyConfig);
    }

    /**
     * Implements current
     * @return array current currency unit
     * @see Iterator Interface
     */
    public function current()
    {
        $currencyUnit = current($this->currencyConfig);
        return $currencyUnit;
    }

    /**
     * Implements key
     * @return int key of current currency unit
     * @see Iterator Interface
     */
    public function key()
    {
        $key = key($this->currencyConfig);
        return $key;
    }

    /**
     * Implements next
     * @return array next currency unit
     * @see Iterator Interface
     */
    public function next()
    {
        $var = next($this->currencyConfig);
        return $var;
    }

    /**
     * Implements valid
     * @return boolean next currency unit (look up this method)
     * @see Iterator Interface
     */
    public function valid()
    {
        $key = key($this->currencyConfig);
        $var = ($key !== NULL && $key !== FALSE);
        return $var;
    }

}