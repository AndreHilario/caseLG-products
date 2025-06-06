<?php

namespace App\Http\Controllers\Products;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Services\Products\ProductService;
use App\Http\Resources\ProductResource;

/**
 * @OA\Tag(
 *     name="Products",
 *     description="Operações relacionadas a produtos"
 * )
 */
class ProductController extends Controller
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Listar todos os produtos",
     *     tags={"Products"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de produtos",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Product")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return ProductResource::collection($this->service->list());
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     summary="Cadastrar novo produto",
     *     tags={"Products"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","category_id","price"},
     *             @OA\Property(property="name", type="string", example="TV LG OLED"),
     *             @OA\Property(property="category_id", type="integer", example=1),
     *             @OA\Property(property="price", type="number", format="float", example=4999.90)
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Produto criado",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados inválidos"
     *     )
     * )
     */
    public function store(ProductRequest $request)
    {
        $product = $this->service->create($request->validated());
        return new ProductResource($product);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Exibir detalhes de um produto",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do produto",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        $product = $this->service->getOne($id);
        return new ProductResource($product);
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     summary="Atualizar produto existente",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","category_id","price"},
     *             @OA\Property(property="name", type="string", example="TV LG NanoCell"),
     *             @OA\Property(property="category_id", type="integer", example=2),
     *             @OA\Property(property="price", type="number", format="float", example=5999.90)
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados inválidos"
     *     )
     * )
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $updated = $this->service->update($product, $request->validated());
        return new ProductResource($updated);
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     summary="Excluir um produto",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Produto excluído com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->service->delete($product);
        return response()->json(['message' => 'Produto excluído com sucesso.'], 204);
    }
}
