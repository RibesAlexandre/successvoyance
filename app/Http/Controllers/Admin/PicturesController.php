<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UploadPictureRequest;
use App\Models\Content\Picture;
use App\Http\Controllers\Controller;

use Date;
use Image;
use Illuminate\Http\Request;

/**
 * Class PicturesController
 * @author Alexandre Ribes
 * @package App\Http\Controllers
 */
class PicturesController extends Controller
{
    /**
     * @param UploadPictureRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(UploadPictureRequest $request)
    {
        $image = Image::make($request->file('picture'));

        if( $request->has('picture_name') ) {
            $pictureName = $request->input('picture_name') . '.' . Date::now()->format('d-m-Y-H-i');
        } else {
            $pictureName = str_random(20) . '.' . Date::now()->format('d-m-Y-H-i');
        }
        $image->save(public_path('uploads/pictures') . '/' . $pictureName . '.' . $request->file('picture')->getClientOriginalExtension());

        $picture = Picture::create([
            'name'  =>  $pictureName,
            'file'  =>  $pictureName . '.' . $request->file('picture')->getClientOriginalExtension()
        ]);

        return response()->json([
            'success'   =>  true,
            'id'        =>  $picture->id,
            'name'      =>  $picture->name,
            'url'       =>  asset('uploads/pictures/' . $picture->file),
            'content'   =>  view('admin.components.picture_card', compact('picture'))->render()
        ]);
    }

    /**
     * Suppression d'une image uploadée
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $picture = Picture::where('name', $request->get('image'))->first();
        if( $picture ) {
            if( is_file(public_path('uploads/pictures/' . $picture->file)) ) {
                unlink(public_path('uploads/pictures/' . $picture->file));
            }

            $picture->delete();

            return response()->json([
                'success'   => true,
                'name'      =>  $picture->name,
                'id'        =>  $picture->id,
                'url'       =>  asset('uploads/pictures/' . $picture->file),
            ]);
        }

        return response()->json([
            'success'   =>  false,
        ]);
    }
}
