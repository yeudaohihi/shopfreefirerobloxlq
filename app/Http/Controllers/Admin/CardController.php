<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CardList;

class CardController extends Controller
{
    public function index()
    {
        $cards = CardList::orderBy('id', 'desc')->limit(2000)->get();

        return view('admin.cards.index', compact('cards'));
    }
}
