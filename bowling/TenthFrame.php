<?php

class TenthFrame extends Frame{

    protected $thirdRoll = 0;

    public function total() {

        $this->total = $this->firstRoll + $this->secondRoll + $this->thirdRoll;
        return $this->total;
    }
}