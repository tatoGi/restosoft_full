<?php

namespace App\Contracts;

/**
 * Interface ProductContract
 */
interface ProductContract
{
    /**
     * @return mixed
     */
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @return mixed
     */
    public function findProductById(int $id);

    /**
     * @return mixed
     */
    public function createProduct(array $params);

    /**
     * @return mixed
     */
    public function updateProduct(array $params);

    /**
     * @return bool
     */
    public function deleteProduct($id);

    /**
     * @return mixed
     */
    public function findProductBySlug($slug);
}
