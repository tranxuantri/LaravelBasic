<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ApiCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $result = $company->save();
        if (!$result) {
            return response()->json("Insert fail", ResponseAlias::HTTP_OK);
        }
        return response()->json("Insert successfully", ResponseAlias::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        //
        $company = DB::select('select * from companies where id = ?', [$id]);
        if (sizeof($company) == 0) {
            return response()->json("Data $id not found", ResponseAlias::HTTP_NOT_FOUND);
        }
        return response()->json($company, ResponseAlias::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        //
        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
//        $result = $company->save();
        $result = DB::update(" update `companies` set `name` = '?', `email` = '?', `address` = '?' where `id` = 11)", ["$company->name", "$company->email", "$company->address"]);
        if (!$result) {
            return response()->json("Insert fail", ResponseAlias::HTTP_OK);
        }
        return response()->json("Insert successfully", ResponseAlias::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        //
        $result = Company::destroy($id);
        if ($result == 0) {
            return response()->json("Delete fail", ResponseAlias::HTTP_OK);
        }
        return response()->json("Delete successfully", ResponseAlias::HTTP_OK);
    }
}
