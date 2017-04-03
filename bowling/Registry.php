<?php

class Registry {
    private $container = array();

    public function set($obj)
    {
        $this->container[] = $obj;
    }

    public function get($index)
    {
        return $this->container[$index];
    }



}
