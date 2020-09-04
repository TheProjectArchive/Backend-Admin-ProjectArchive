<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AboutDesc;

class AboutDescController extends Controller
{
     // mengambil semua data
     public function all()
     {
         return AboutDesc::all();
     }

      // menambah data
    public function store(Request $request)
    {
        return AboutDesc::create($request->all());
    }

    // mengambil data by id
    public function show($id)
    {
        return AboutDesc::find($id);
    }

     // mengubah data
    public function update($id, Request $request)
    {
        $aboutdesc = AboutDesc::find($id);
        $aboutdesc->update($request->all());
        return $aboutdesc;
    }


}
