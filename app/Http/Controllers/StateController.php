<?php

namespace App\Http\Controllers;

use App\Models\State;

class StateController extends Controller
{
    public function index()
    {
        return State::all();
    }

public function stateReturnFormat(string $type, ?int $id = null)
{
    switch ($type) {
        case 'abbr':
            return State::abbr($id);
        case 'long':
            return State::long($id);
        case 'allLong':
            return State::allLong();
        case 'allAbbr':
            return State::allAbbr();
        default:
            return State::all();
    }
}
}
