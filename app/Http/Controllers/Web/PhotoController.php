<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PhotoController extends Controller
{

    public function upload(Request $request){
        $total_photos=Photo::where('product_id',$request->product_id)->count();
            if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $imageName = $file->getClientOriginalName();
                if($total_photos<=5) {
                    $file->move($path = storage_path('app/public/products'), $imageName);
                    $upload = Photo::create([
                        'image' => $imageName,
                        'product_id' => $request->product_id
                    ]);
                }

            }
        }



    public function delete(Request $request){
        $filename =  $request->get('filename');
        Photo::where('image',$filename)->delete();
        $path=storage_path('app/public/products/').$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function destroy($data){
        $filename =  $data;
        Photo::where('image',$filename)->delete();
        $path=storage_path('app/public/products/').$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return redirect()->back()->with('danger','Image deleted successfully');

    }
}
