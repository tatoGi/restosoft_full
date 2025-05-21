<?php

namespace App\Contracts;

interface AttributeContract
{
    /**
     * @return mixed
     */
    public function listAttributes(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @return mixed
     */
    public function findAttributeById(int $id);

    /**
     * @return mixed
     */
    public function createAttribute(array $params);

    /**
     * @return mixed
     */
    public function updateAttribute(array $params);

    /**
     * @return bool
     */
    public function deleteAttribute($id);
}
