<?php
namespace Family\Commanding;

interface CommandBus
{
    public function execute($command);
}