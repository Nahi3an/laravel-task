<?php

namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Exceptions\StoreResourceFailedException;
use App\Exceptions\DeleteResourceFailedException;
use App\Exceptions\UpdateResourceFailedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductRepository
{

    private Product $model;

    public function __construct(
        Product $model,

    ) {
        $this->model = $model;
    }



    public function index()
    {
        $data = $this->model->with('category')->get();
        return $data;
    }

    public function findById($id)
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


            $model = $this->model->create(
                [
                    'name' => $validated->name,
                    'price' => $validated->price,
                    'quantity' => $validated->quantity,
                    'category_id' => $validated->category_id,
                    'created_by' => 1
                ]
            );

            return $model;
        } catch (\Throwable $th) {

            info($th);
            throw new StoreResourceFailedException('Product Create Failed');
        }
    }

    public function update($validated, $id)
    {


        info("In Repo");
        info($id);
        info($validated);

        try {
            $model = $this->model->findOrFail($id);
        } catch (\Throwable $th) {
            throw new NotFoundHttpException('Product Not Found');
        }


        try {


            $model->update(
                [
                    'name' => $validated->name,
                    'price' => $validated->price,
                    'quantity' => $validated->quantity,
                    'category_id' => $validated->category_id,
                    'updated_by' => 1
                ]
            );

            return $model->fresh();
        } catch (\Throwable $th) {
            info($th);
            throw new UpdateResourceFailedException('Product Update Error');
        }
    }



    public function delete($id)
    {
        try {
            $data = $this->findById($id);
        } catch (\Throwable $th) {

            throw new NotFoundHttpException('Not Found');
        }

        try {
            $data->delete();
        } catch (\Throwable $th) {
            throw new DeleteResourceFailedException('Product Delete Failed');
        }
    }
}
