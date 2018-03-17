<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Util\Filter\FilterTrait;
use Illuminate\Http\Request;

class CitiesStatesController extends Controller
{
    use FilterTrait;

    protected $model;

    public function index()
    {
            return $this->filter(new City())->get();
    }
}
