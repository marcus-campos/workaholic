<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * @param $name
     * @return mixed
     */
    public function getCityByName($name)
    {
        return State::with(['cities' => function ($query) use ($name) {
                $query->where('name', 'like', '%'.$name.'%');
            }])
            ->whereHas('cities', function ($query) use ($name) {
                $query->where('name', 'like', '%'.$name.'%');
            })->get();
    }
}
