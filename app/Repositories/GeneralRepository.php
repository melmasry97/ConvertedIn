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
            if (isset($input['attachOne'])) {
                $width = isset($input['attachOne']['width']) ? $input['attachOne']['width'] : null;
                $height = isset($input['attachOne']['height']) ? $input['attachOne']['height'] : null;
                $data[$input['attachOne']['name']] = $this->upload($input['attachOne']['file'], 'storage/' . $input['attachOne']['folder'], $width, $height);
                unset($data['attachOne']);
            }
            return $model::firstOrCreate($data);
        } catch (\Throwable $th) {
            throw $th;
            if (isset($input['attachOne'])) {
                $this->deleteImage($data[$input['attachOne']['name']]);
            }
            return null;
        }
    }

    public function create($model, $input)
    {
        return $model::create($input);
    }

    public function put($model, $conditions, $input)
    {
        $data = $input;
        $row = $model::where($conditions)->first();
        try {
            if (isset($input['attachOne'])) {
                $width = isset($input['attachOne']['width']) ? $input['attachOne']['width'] : null;
                $height = isset($input['attachOne']['height']) ? $input['attachOne']['height'] : null;
                $data[$input['attachOne']['name']] = $this->upload($input['attachOne']['file'], 'storage/' . $input['attachOne']['folder'], $width, $height); //public/' . $input['attachOne']['folder'] . '/
                $name = $input['attachOne']['name'];
                $this->deleteImage($row->$name);
                unset($data['attachOne']);
            }

            $row->update($data);
            return $row;
        } catch (\Throwable $th) {
            if (isset($input['attachOne'])) {
                $this->deleteImage($data[$input['attachOne']['name']]);
            }
        }
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


    public function upload($image, $folder = 'conferences', $with = null, $height = null)
    {
        // $path = $image->hashName($folder . '/' . Auth::user()->id);
        // $image = Image::make($image)->fit(300);
        // Storage::put($path, (string) $image->encode());
        // return $url = Storage::url($path);

        if (!empty($with) && !empty($height)) {
            try {

                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                //code...
            } catch (\Throwable $th) {
                $folder = 'images';
            }
            $path = $image->hashName($folder);
            $image = Image::make($image)->resize($with, $height);
            $image->save($path);
            return $path;
        } else {
            $image_name = time() . rand(1, 100000) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($folder), $image_name);
            return $folder . '/' . $image_name;
        }
    }

    public function deleteImage($path)
    {
        $file = explode('public/', $path);
        $file_name = end($file);
        // File::delete(public_path($file_name));
        File::delete($file_name);
    }


    public function visit_login($conference_id)
    {
        return Visit::where('conference_id', $conference_id)->where('user_id', '!=', null)->get();
    }

    public function add_visitor($request)
    {
        return $request->ip();
    }
}
