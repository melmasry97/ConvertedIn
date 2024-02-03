<?php

namespace App\Interfaces;


interface GeneralInterface
{

    public function get($model, $with = [], $withCount = []);

    public function getBy($model, $conditions = [], $with = []);

    public function getSpeseficeColum($model, $colum, $conditions = []);

    public function getMultiColum($model, $colums = [], $conditions = []);

    public function add($model, $input);

    public function create($model, $input);

    public function find($model, $conditions);

    public function findWith($model, $conditions, $with = [], $withCount = []);

    public function delete($model, $conditions);
}
