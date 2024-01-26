<?php


namespace App\Repositories\Category;


use Carbon\Carbon;

use App\Models\Category;

use Illuminate\Support\Facades\DB;
use App\Exceptions\StoreResourceFailedException;
use App\Exceptions\DeleteResourceFailedException;
use App\Exceptions\UpdateResourceFailedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryRepository
{

    private Category $model;

    public function __construct(
        Category $model
    ) {
        $this->model = $model;
    }


    public function index()
    {

        return $this->model->all();
    }

    public function activeAll()
    {
        return $this->model->where('status', true)->get();
    }

    public function findById(string $id)
    {
        try {
            $data = $this->model->findOrFail($id);
            return $data;
        } catch (\Throwable $th) {

            throw new NotFoundHttpException('Not Found');
        }
    }



    public function store($validated)
    {
        try {
            return  DB::transaction(function () use ($validated) {

                $model =  $this->model->create([
                    ...$validated,
                    'created_by' => 1
                ]);
                return $model;
            });
        } catch (\Throwable $th) {

            info($th);
            throw new StoreResourceFailedException('Category Create Failed');
        }
    }

    public function update($validated, $id)
    {

        try {
            $model = $this->model->findOrFail($id);
            info($model);
        } catch (\Throwable $th) {
            info($th);
            throw new NotFoundHttpException('Category Not Found');
        }


        try {

            DB::transaction(function () use ($model, $validated) {

                $model->update([
                    ...$validated,
                    'updated_by' => 1
                ]);
            });

            return $model->fresh();
        } catch (\Throwable $th) {
            info($th);
            throw new UpdateResourceFailedException('Category Update Failed');
        }
    }



    public function delete($id)
    {
        try {
            $data = $this->model->findOrFail($id);
        } catch (\Throwable $th) {
            info($th);
            throw new NotFoundHttpException('Not Found');
        }

        try {
            $data->delete();
        } catch (\Throwable $th) {

            throw new DeleteResourceFailedException('Category Delete Failed');
        }
    }
}
