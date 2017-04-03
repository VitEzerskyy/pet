<?php
abstract class Frame {

    protected $firstRoll;
    protected $secondRoll;
    public $total;

    public function setRoll($firstRoll, $secondRoll) {
        $this->firstRoll = $firstRoll;
        $this->secondRoll = $secondRoll;
    }

    abstract public function total();

}

?>