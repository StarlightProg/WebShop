<?php

namespace App\Helpers;

class MailSender{
    protected $name;
    protected $sound;

    public function __construct(string $name, string $sound)
    {
        $this->name = $name;
        $this->sound = $sound;
    }

    public function makeSound(){
        return $this->sound;
    }

    public function getSound(string $name){
        $this->name = $name;
    }

    public function setSound(string $sound){
        $this->sound = $sound;
    }
}