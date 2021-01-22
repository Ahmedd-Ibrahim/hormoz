<?php

namespace App\Repositories;

use App\Models\Gallery;
use App\Repositories\BaseRepository;

/**
 * Class GalleryRepository
 * @package App\Repositories
 * @version January 20, 2021, 9:20 am UTC
*/

class GalleryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image',
        'is_primary',
        'product_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Gallery::class;
    }

    public function create($input)
    {
        if(isset($input['image']) && is_file($input['image']))
        {
            $image =  UploadImage('products',$input['image']);
            $input['image'] = $image;
        }
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }


    public function update($input, $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        if($model->image){
            RemoveImageFromDisk('images'.DIRECTORY_SEPARATOR.$model->image);
        }

        if(isset($input['image']) && is_file($input['image']))
        {
            $paper =  UploadImage('products',$input['image']);
            $input['image'] = $paper;
        }

        $model->fill($input);

        $model->save();

        return $model;
    }



    public function delete($id)
    {

        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);
        if($model->image){
            RemoveImageFromDisk('images'.DIRECTORY_SEPARATOR.$model->image);
        }

        return $model->delete();
    }
}
