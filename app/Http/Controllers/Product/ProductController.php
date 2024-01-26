<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use App\Http\Requests\Product\ProductStoreRequest;


class ProductController extends Controller
{

    private CategoryRepository $categoryRepository;
    private ProductRepository $repository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $repository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->repository->index();
        return view('admin.product.all-products', ['products' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $allCategories = $this->categoryRepository->index();
        return view('admin.product.add-product', ['categories' => $allCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {

        $this->repository->store($request);
        return redirect()->route('products.index')->with('message', 'Product Stored Successfully!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = $this->repository->findById($id);
        $allCategories = $this->categoryRepository->index();
        return view(
            'admin.product.edit-product',
            [
                'categories' => $allCategories,
                'product' => $data
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductStoreRequest $request, string $id)
    {
        //
        $this->repository->update($request, $id);
        return redirect()->route('products.index')->with('message', 'Product Updated Successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->repository->delete($id);
        return redirect()->route('products.index')->with('message', 'Product Deleted Successfully!');
    }

    public function purchaseProduct(Request $request)
    {

        $product = $this->repository->findById($request->product_id);
        event(new \App\Events\ProductPurchased($product));
        return redirect()->route('products.index')->with('message', 'Product purchased successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new ProductImport, $request->file('file'));

        return redirect()->route('products.index')->with('message', 'Products imported successfully.');
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
        return redirect()->route('products.index')->with('message', 'Product exported successfully.');
    }
}
