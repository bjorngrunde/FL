<?php

namespace Family\Applys;


class RemoveApplicationCommand {
    public $id;

    function __construct($id)
    {
        $this->id = $id;
    }
} 