<?php

namespace App\Interfaces;


interface GeneralInterface
{

    public function withData(array $with);

    public function getData($with = []);

    public function getPaginated($with = [], $number);

    public function getBy($conditions = [], $with = []);

    public function create($input);
}
