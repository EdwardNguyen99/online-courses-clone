<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * @param $id
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * @param $id
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function delete($id, $attributes = []);
}
