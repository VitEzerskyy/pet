<?php
class Player {
    private $name;
    public $state = 0;
    public $container = array();

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setFrame(Frame $obj)
    {
        if ($this->state == 1) {
            $this->container[] = $obj;
        }
    }

}

?>