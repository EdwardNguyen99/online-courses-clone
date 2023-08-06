<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    /**
     * @return mixed
     */
    abstract public function getModel();

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @param  array  $attributes
     *
     * @return false|mixed
     */
    public function update($id, $attributes = [])
    {
        $result = $this->model->find($id);
        if ($result) {
            return $result->update($id, $attributes);
        }

        return false;
    }

    /**
     * @param $id
     * @param  array  $attributes
     *
     * @return false|mixed
     */
    public function delete($id, $attributes = [])
    {
        $result = $this->model->find($id);
        if ($result) {
            return $result->delete();
        }

        return false;
    }
}
