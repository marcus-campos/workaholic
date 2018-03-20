<?php
/**
 * User: marcus-campos
 * Date: 01/01/18
 * Time: 16:39
 */

namespace App\Util\Filter;


trait FilterTrait
{
    /*
     * Example:
     * ?filters=[["type", "=", "integration"]]
     * &page=1
     * &perPage=100
     * http://localhost:8000/api/v1/user/5a3cf9d1522b26S0o4Q02cyqUD3OQQhIlkl0skv/setting?filters=[["type", "=", "integration"]]&page=1&perPage=100
     */

    protected $queryFilters = [];
    protected $paginate;
    protected $perPage;

    public function __construct()
    {
        $this->handle();
    }

    private function handle()
    {
        $filters = \request()->capture()->input('filters');
        if(!empty($filters))
            $this->queryFilters = json_decode(
                $filters,
                true
            );

        $page = \request()->capture()->input('page');
        if(!empty($page))
            $this->paginate = true;

        $perPage = \request()->capture()->input('perPage');
        if(!empty($perPage))
            $this->perPage = $perPage;
    }


    /**
     * @param $model
     * @return mixed
     */
    private function paginate($model)
    {
        if($this->paginate == true) {
            if(!empty($this->perPage))
                return $model->paginate($this->perPage);
            else
                return $model->paginate(15);
        }
        else
            return $model;
    }
    /**
     * @param $model
     * @return mixed
     */
    private function filter($model)
    {
        if(!empty($this->queryFilters))
            return $model->where($this->queryFilters);
        else
            return $model;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function addFilters($model)
    {
        return $this->paginate(
            $this->filter($model)
        );
    }
}