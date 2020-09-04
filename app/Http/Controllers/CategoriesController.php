<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categories;

class CategoriesController extends Controller
{
    // mengambil semua data
    public function all()
    {
        return Categories::all();
    }

    // mengambil data by id
    public function show($id)
    {
        return Categories::find($id);
    }

    // menambah data
    public function store(Request $request)
    {
        return Categories::create($request->all());
    }

    // mengubah data
    public function update($id, Request $request)
    {
        $ctg = Categories::find($id);
        $ctg->update($request->all());
        return $ctg;
    }

    // menghapus data
    public function delete($id)
    {
        $ctg = Categories::find($id);
        $ctg->delete();
        return 204;
    }
}
