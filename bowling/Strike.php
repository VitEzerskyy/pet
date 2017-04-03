<?php

class Strike extends Frame {

    public $firstBonus = 0;
    public $secondBonus = 0;

    public function total() {

        $this->total = $this->firstRoll + $this->firstBonus + $this->secondBonus;
        return $this->total;
    }

}