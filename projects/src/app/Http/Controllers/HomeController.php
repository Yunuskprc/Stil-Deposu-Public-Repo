<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function category($category){
        dd($category);
    }

}