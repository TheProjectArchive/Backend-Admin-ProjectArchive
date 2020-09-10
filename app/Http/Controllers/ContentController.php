<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// import file model Person
use App\Content;


class ContentController extends Controller
{
    // mengambil semua data
    public function all()
    {
        $images = Content::all();
        foreach($images as $data)
        {
            $data->content_image = json_decode($data->content_image);
        }
        
        return $images;
    }

    // mengambil data by id
    public function show($id)
    {
        $content = Content::find($id);
        $content->content_image = json_decode($content->content_image);
        return $content;
    }

    // menambah data
    public function store(Request $request)
    {
        $nama_brand = $request->nama_brand;
        $category = $request->category;
        $description = $request->description;
        $url_content = $request->url_content;
        $pictures = [];
        $pictures2 ='';
        $pictures3 = '';

        if($request->hasFile('content_image'))
        {

            foreach($request->file('content_image') as $file){
                # code... 

                $filename = '/assets/'.$nama_brand.'/'.$file->getClientOriginalName();
                $file->move(public_path('assets/'.$nama_brand) ,$filename);
                $pictures[] = $filename;
            }

        }
        
        if($request->hasFile('cover_image')){
                $file2 = $request->file('cover_image');
                $filename2 = '/assets/'.$nama_brand.'/'.$file2->getClientOriginalName();
                $file2->move(public_path('assets/'.$nama_brand) ,$filename2);
                $pictures2 = $filename2;
        }

        if($request->hasFile('banner_image')){
                $file3 = $request->file('banner_image');
                $filename3 = '/assets/'.$nama_brand.'/'.$file3->getClientOriginalName();
                $file3->move(public_path('assets/'.$nama_brand) ,$filename3);
                $pictures3 = $filename3;

           
        }
        
        
        

       
       


        Content::create([
            'nama_brand' => $nama_brand,
            'category' => $category,
            'description' => $description,
            'url_content' => $url_content,
            'cover_image' => json_encode($pictures2),
            'banner_image' => json_encode($pictures3),
            'content_image' => json_encode($pictures),
        ]);
        return response()->json(['message'=>'image added']);
    }

    // mengubah data
    public function update($id, Request $request)
    {

        $content = Content::find($id);
        $category = $request->category;
        $description = $request->description;
        $url_content = $request->url_content;

        $content->category = $category;
        $content->description = $description;
        $content->url_content = $url_content;

        $lengthItem = strlen($content->nama_brand);

        if($request->nama_brand){
            $nama_brand = $request->nama_brand;
            if(!$request->hasFile('cover_image')){
                $tempCoverImage = $content->cover_image;
                $tempCoverImage = substr_replace($tempCoverImage,$nama_brand,11,$lengthItem);
                $content->cover_image = $tempCoverImage;
            }
            if(!$request->hasFile('banner_image')){
                $tempBannerImage = $content->banner_image;
                $tempBannerImage = substr_replace($tempBannerImage,$nama_brand,11,$lengthItem);
                $content->banner_image = $tempBannerImage;
            }
            if(!$request->hasFile('content_image')){
                $tempContentImage = json_decode($content->content_image);
                for($i=0;$i<count($tempContentImage);$i++){
                    $temp = $tempContentImage[$i];
                    $temp = substr_replace($temp,$nama_brand,8,$lengthItem);
                    $tempContentImage[$i] = $temp;
                }
                $content->content_image = json_encode($tempContentImage);
            }
            rename(public_path('assets/'.$content->nama_brand),public_path('assets/'.$nama_brand));

            $content->nama_brand = $nama_brand;
        }
        

        if($request->hasFile('cover_image')){
            $var = $content->cover_image;
            $length = 11 + $lengthItem + 2;
            $var = substr($var,$length,-1);
            unlink(public_path('assets/'.$content->nama_brand.'/'.$var));
            $file = $request->file('cover_image');
            $filename = '/assets/'.$content->nama_brand.'/'.$file->getClientOriginalName();
            $file->move(public_path('assets/'.$content->nama_brand) ,$filename);
            $pictures = $filename;
            $content->cover_image = json_encode($pictures);
            
        }
        if($request->hasFile('banner_image')){
            $var = $content->banner_image;
            $length = 11 + $lengthItem + 2;
            $var = substr($var,$length,-1);
            unlink(public_path('assets/'.$content->nama_brand.'/'.$var));
            $file2 = $request->file('banner_image');
            $filename2 = '/assets/'.$content->nama_brand.'/'.$file2->getClientOriginalName();
            $file2->move(public_path('assets/'.$content->nama_brand) ,$filename2);
            $pictures2 = $filename2;
            $content->banner_image = json_encode($pictures2);
        }
        if($request->hasFile('content_image')){
            $content->content_image = json_decode($content->content_image);
            $pictures3 = [];
            foreach($content->content_image as $data){
                $var = $data;
                $length = 8 + $lengthItem + 1;
                $var = substr($var,$length);
                unlink(public_path('assets/'.$content->nama_brand.'/'.$var));
            }
            foreach($request->file('content_image') as $file){
                $filename3 = '/assets/'.$content->nama_brand.'/'.$file->getClientOriginalName();
                $file->move(public_path('assets/'.$content->nama_brand) ,$filename3);
                $pictures3[] = $filename3;
            }
            $content->content_image = json_encode($pictures3);
        }
        // $nama_brand = $request->nama_brand;
        // $category = $request->category;
        // $description = $request->description;
        // $url_content = $request->url_content;
        //$content->update($request->all());
        // $content->update('nama_brand',$request->nama_brand);
        // $content->category->update($request->$category);
        // $content->description->update($request->$description);
        // $content->url_content->update($request->$url_content);
        
        $content->save();
    }

    // menghapus data
    public function delete($id)
    {
        $content = Content::find($id);       
        
        $content->delete();
        Storage::deleteDirectory('assets/'.$content->nama_brand);
        return 204;
    }

    public function getWorkItems(){
        $content = Content::select('cover_image','category','id')->get();
        return $content;
    }

    public function getWorkItemsByCategory($category){
        $category = str_replace("-"," ",$category);
        $content = Content::select('cover_image','category','id')->where('category','=',$category)->get();
        return $content;
    }

    public function getFilterList(){
        $list = Content::select('category')->orderBy('category')->get();
        return $list;
    }
}
