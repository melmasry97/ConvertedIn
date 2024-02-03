<?php

namespace App\Interfaces;


interface GeneralInterface
{

    public function withData(array $with);

    public function getData($with = []);

    public function getPaginated($with = [], $number);

    public function getBy($conditions = [], $with = []);

    public function getSpeseficeColum($colum, $conditions = []);

    public function getMultiColum($colums = [], $conditions = []);

    public function add($input);

    public function create($input);

    public function find($conditions);

    public function findWith($conditions, $with = [], $withCount = []);

    public function delete($conditions);
}
