<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Listar empresas
     */
    public function index()
    {
        $companies = Company::select('id', 'code', 'name', 'primary_color')->get();

        return response()->json([
            'data' => $companies
        ]);
    }
}
