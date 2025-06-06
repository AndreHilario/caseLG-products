<?php

namespace App\Http\Controllers\Categories;

use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\Categories\CategoryService;
use App\Models\Category;

/**
 * @OA\Tag(
 *     name="Categories",
 *     description="Operações referentes a categorias de produto"
 * )
 */
class CategoryController extends Controller
{
    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Listar todas as categorias",
     *     tags={"Categories"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de categorias",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Category")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return CategoryResource::collection($this->service->list());
    }

    /**
     * @OA\Post(
     *     path="/api/categories",
     *     summary="Cadastrar nova categoria",
     *     tags={"Categories"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Eletrônicos")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Categoria criada",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados inválidos"
     *     )
     * )
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->service->create($request->validated());
        return new CategoryResource($category);
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     summary="Exibir detalhes de uma categoria",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da categoria",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados da categoria",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoria não encontrada"
     *     )
     * )
     */
    public function findOne($id)
    {
        $category = $this->service->getOne($id);
        return new CategoryResource($category);
    }

    /**
     * @OA\Put(
     *     path="/api/categories/{id}",
     *     summary="Atualizar categoria existente",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da categoria",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Casa & Jardim")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoria atualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoria não encontrada"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados inválidos"
     *     )
     * )
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $updated = $this->service->update($category, $request->validated());
        return new CategoryResource($updated);
    }

    /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     summary="Excluir uma categoria",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da categoria",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Categoria excluída com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoria não encontrada"
     *     )
     * )
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $this->service->delete($category);
        return response()->json(['message' => 'Categoria excluída com sucesso.'], 204);
    }
}

/**
 * @OA\Schema(
 *   schema="Category",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="name", type="string", example="Eletrônicos"),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2024-06-06T12:00:00Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2024-06-06T12:00:00Z")
 * )
 */
