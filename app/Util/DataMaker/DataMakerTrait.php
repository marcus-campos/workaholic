<?php
/**
 * User: marcus-campos
 * Date: 01/01/18
 * Time: 16:39
 */

namespace App\Util\DataMaker;


trait DataMakerTrait
{
    /*
     * Example:
     * ?filters=[["type", "=", "integration"]]
     * &page=1
     * &perPage=100
     * &orderBy=[["updated_at", "asc"]]
     * http://localhost:8000/user/job?filters=[["type", "=", "integration"]]&page=1&perPage=100&orderBy=[['updated_at', 'asc']]
     */

    private $queryFilters = [];

    private $perPage;

    private $filterFillable = [];

    private $orderByFillable = [];

    private $orderBy = [];

    /**
     * DataMakerTrait constructor.
     */
    public function __construct()
    {
        $this->handle();
    }

    /**
     *
     */
    private function handle()
    {
        $filters = \request()->capture()->input('filters');
        if (!empty($filters)) {
            $this->queryFilters = json_decode(
                $filters,
                true
            );
        }

        $perPage = \request()->capture()->input('perPage');
        if (!empty($perPage)) {
            $this->perPage = $perPage;
        }

        $orderBy = \request()->capture()->input('orderBy');

        if (!empty($orderBy)) {
            $this->orderBy =  $this->queryFilters = json_decode(
                $orderBy,
                true
            );
        }
    }

    /**
     * @param $model
     * @param null $orderBy
     * @param int $perPage | if is 0, no paginate.
     * @return mixed
     */
    private function dataMaker($model, $orderBy = null, $perPage = 15)
    {
        $this->handle();

        $model = $this->filter($model);

        if(!empty($orderBy)) {
            $this->orderBy = $orderBy;
            $model = $this->orderBy($model);
        } else if(!empty($this->orderBy)) {
            $model = $this->orderBy($model);
        }

        if($perPage > 0) {
            $this->perPage = $perPage;
            $model = $this->paginate($model);
        }

        return $model;
    }

    /**
     * @param $model
     * @return mixed
     */
    private function paginate($model)
    {
        if (!empty($this->perPage)) {
            return $model->paginate($this->perPage);
        } else {
            return $model->paginate(15);
        }
    }

    /**
     * @param $model
     * @return mixed
     */
    private function filter($model)
    {
        $this->removeFilters();

        if(!empty($this->queryFilters))
            return $model->where($this->queryFilters);
        else
            return $model;
    }

    /**
     * @param $model
     * @return mixed
     */
    private function orderBy($model)
    {
        $this->removeOrderBy();
        if (!empty($this->orderBy)) {
            foreach ($this->orderBy as $value) {
                if(isset($value[1])) {
                    $model = $model->orderBy($value[0], $value[1]);
                    continue;
                }

                $model = $model->orderBy($value[0], $value[1]);
            }
        }

        return $model;
    }

    /**
     * Remove all filters when not add on fillable
     */
    private function removeFilters()
    {
        foreach ($this->queryFilters as $key => $filter) {
            $has = false;

            foreach ($this->filterFillable as $value) {
                if ($filter[0] == $value) {
                    $has = true;
                }
            }

            if ($has == false) {
                unset($this->queryFilters[$key]);
            }
        }
    }

    /**
     * Remove all orderby when not add on orderByFillable
     */
    private function removeOrderBy()
    {
        foreach ($this->orderBy as $key => $filter) {
            $has = false;

            foreach ($this->orderByFillable as $value) {
                if ($filter[0] == $value) {
                    $has = true;
                }
            }

            if ($has == false) {
                unset($this->orderBy[$key]);
            }
        }
    }

    /**
     * @return array
     */
    public function getQueryFilters(): array
    {
        return $this->queryFilters;
    }

    /**
     * @param array $queryFilters
     */
    public function setQueryFilters(array $queryFilters): void
    {
        $this->queryFilters = $queryFilters;
    }

    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param mixed $perPage
     */
    public function setPerPage($perPage): void
    {
        $this->perPage = $perPage;
    }

    /**
     * @return array
     */
    public function getFilterFillable(): array
    {
        return $this->filterFillable;
    }

    /**
     * @param array $filterFillable
     */
    public function setFilterFillable(array $filterFillable): void
    {
        $this->filterFillable = $filterFillable;
    }

    /**
     * @return array
     */
    public function getOrderByFillable(): array
    {
        return $this->orderByFillable;
    }

    /**
     * @param array $orderByFillable
     */
    public function setOrderByFillable(array $orderByFillable): void
    {
        $this->orderByFillable = $orderByFillable;
    }

    /**
     * @return array
     */
    public function getOrderBy(): array
    {
        return $this->orderBy;
    }

    /**
     * @param array $orderBy
     */
    public function setOrderBy(array $orderBy): void
    {
        $this->orderBy = $orderBy;
    }
}