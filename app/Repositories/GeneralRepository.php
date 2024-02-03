<?php

namespace App\Repositories;

use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class GeneralRepository
{
    public function get($model, $with = [] , $withCount =[])
    {
        return $model::with($with)->withCount($withCount)->get();
    }

    public function getBy($model, $conditions = [], $with = [])
    {
        return $model::with($with)->where($conditions)->get();
    }

    public function getSpeseficeColum($model, $colum, $conditions = [])
    {
        return $model::where($conditions)->pluck($colum);
    }

    public function getMultiColum($model, $colums = [], $conditions = [])
    {
        return $model::where($conditions)->get($colums);
    }

    public function add($model, $input)
    {
        $data = $input;
        try {

            return $model::firstOrCreate($data);
        } catch (\Throwable $th) {
            throw $th;
            return null;
        }
    }

    public function create($model, $input)
    {
        return $model::create($input);
    }

    public function find($model, $conditions)
    {
        return $model::where($conditions)->first();
    }

    public function findWith($model, $conditions, $with = [], $withCount = [])
    {
        return $model::with($with)->withCount($withCount)->where($conditions)->first();
    }

    public function delete($model, $conditions)
    {
        $row = $model::where($conditions)->first();
        $row->delete();
        return $row;
    }

}
