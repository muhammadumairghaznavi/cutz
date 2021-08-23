<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    function fetch(Request $request)
    {
        if ($request->get('query')) {
            $data = Product::whereTranslationLike('title', '%' . $request->get('query') . '%')->orWhereTranslationLike('description', '%' . $request->get('query') . '%')
                ->InStock()->Active()->latest()->take(20)->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li><a href="#">' . $row->title . '</a></li> ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
