<?php

abstract class Person {

    private $id;
    private $lastname;
    private $firstname;
    private $birthDate;
    private $biography;
    private $path;

    public function __construct($id, $lastname, $firstname, $birthDate, $biography, $path)
    {
        $this->id = $id;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->birthDate = $birthDate;
        $this->biography = $biography;
        $this->path = $path;
    }

    // Getters

    public function getId()
    {
        return $this->id;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getBiography()
    {
        return $this->biography;
    }

    public function getPath()
    {
        return $this->path;
    }

}