<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Product\ProductStoreRequest;
use App\Http\Requests\Api\V1\Product\ProductUpdateRequest;
use App\Http\Resources\V1\ProductResource;
use App\Models\User;
use App\Repositories\ProductRepository;
use App\Traits\HasApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use HasApiResponse;

    /**
     * @var float|\Illuminate\Support\HigherOrderCollectionProxy|mixed
     */
    private float $discount;

    public function __construct(protected ProductRepository $productRepository)
    {
        $this->discount = User::find(auth()->id())->type->discount_percentage;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->getAll();

        return $this->successResponse(
            data: ProductResource::collection(
                $products->map(
                    callback: fn($product) => new ProductResource($product, $this->discount)
                )
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $this->productRepository->create($request->validated());

        return $this->successResponse(
            data: [
                'message' => 'Product created successfully.',
                'product' => new ProductResource($product, $this->discount),
            ],
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productRepository->getById($id);

        return $this->successResponse(
            data: [
                'product' => new ProductResource($product, $this->discount),
            ],
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = $this->productRepository->update(
            attributes: $request->validated(),
            id: $id
        );

        return $this->successResponse(
            data: [
                'message' => 'Product updated successfully.',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productRepository->delete($id);

        return $this->successResponse(
            data: [],
            code: 204
        );
    }
}
