<?php

class Spare extends Frame {

    public $bonus = 0;

    public function total() {

        $this->total = $this->firstRoll + $this->secondRoll + $this->bonus;
        return $this->total;
    }

}