<?php

namespace App\Contracts;

/**
 * Interface CategoryContract
 */
interface CategoryContract
{
    /**
     * @return mixed
     */
    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @return mixed
     */
    public function findCategoryById(int $id);

    /**
     * @return mixed
     */
    public function createCategory(array $params);

    /**
     * @return mixed
     */
    public function updateCategory(array $params);

    /**
     * @return bool
     */
    public function deleteCategory($id);

    /**
     * @return mixed
     */
    public function treeList();

    /**
     * @return mixed
     */
    public function findBySlug($slug);
}
