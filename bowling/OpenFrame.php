<?php

class OpenFrame extends Frame {

    public function total() {
        $this->total = $this->firstRoll + $this->secondRoll;
        return $this->total;
    }

}