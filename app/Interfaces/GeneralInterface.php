<?php

namespace App\Interfaces;


interface GeneralInterface
{

    public function withData($with = [], $withCount = []);

    public function get($with = [], $withCount = []);

    public function getPaginated($with = [], $withCount = [], $number);

    public function getBy($conditions = [], $with = []);

    public function getSpeseficeColum($colum, $conditions = []);

    public function getMultiColum($colums = [], $conditions = []);

    public function add($input);

    public function create($input);

    public function find($conditions);

    public function findWith($conditions, $with = [], $withCount = []);

    public function delete($conditions);
}
