<?php

namespace App\Contracts;

/**
 * Interface BaseContract
 */
interface BaseContract
{
    /**
     * Create a model instance
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update a model instance
     *
     * @return mixed
     */
    public function update(array $attributes, int $id);

    /**
     * Return all model rows
     *
     * @param  array  $columns
     * @return mixed
     */
    public function all($columns = ['*'], string $orderBy = 'id', string $sortBy = 'desc');

    /**
     * Find one by ID
     *
     * @return mixed
     */
    public function find(int $id);

    /**
     * Find one by ID or throw exception
     *
     * @return mixed
     */
    public function findOneOrFail(int $id);

    /**
     * Find based on a different column
     *
     * @return mixed
     */
    public function findBy(array $data);

    /**
     * Find one based on a different column
     *
     * @return mixed
     */
    public function findOneBy(array $data);

    /**
     * Find one based on a different column or through exception
     *
     * @return mixed
     */
    public function findOneByOrFail(array $data);

    /**
     * Delete one by Id
     *
     * @return mixed
     */
    public function delete(int $id);
}
