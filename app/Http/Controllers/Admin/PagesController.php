<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateEditPageRequest;
use App\Models\Content\Page;
use App\Models\Content\Picture;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

/**
 * Class PagesController
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Admin
 */
class PagesController extends Controller
{
    /**
     * Liste des pages
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Formulaire de création
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $page = new Page();
        return view('admin.pages.create', compact('page'));
    }

    /**
     * Enregistrement de la page
     *
     * @param CreateEditPageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateEditPageRequest $request)
    {
        $page = Page::create($request->all());
        if( $request->has('pictures') ) {
            $pictures = [];
            foreach( $request->input('pictures') as $p ) {
                $picture = Picture::where('id', $p)->first();
                if( $picture ) {
                    $pictures[] = $picture->id;
                }
            }

            $page->pictures()->sync($pictures);
        }

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'type'      =>  'success',
            'message'   =>  'Votre page a correctement été créée ! Vous allez être redirigé dans 3 secondes',
            'timer'     =>  3000,
            'redirect'  =>  route('admin.pages.index'),
        ]);

        alert()->success('La page a correctement été rajoutée !', 'Page créée !');
        return redirect()->route('admin.pages.index');
    }

    /**
     * Edition de la page
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $page = Page::with('pictures')->findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Mise à jour de la page
     *
     * @param $id
     * @param CreateEditPageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, CreateEditPageRequest $request)
    {
        $page = Page::findOrFail($id);
        $page->update($request->all());

        //  Mise à jour des images
        if( $request->has('pictures') ) {
            $pictures = [];
            foreach( $request->input('pictures') as $p ) {
                $picture = Picture::where('id', $p)->first();
                if( $picture ) {
                    $pictures[] = $picture->id;
                }
            }

            $page->pictures()->sync($pictures);
        }

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'type'      =>  'success',
            'message'   =>  'Votre page a correctement été mise à jour ! Vous allez être redirigé dans 3 secondes',
            'timer'     =>  3000,
            'redirect'  =>  route('admin.pages.index'),
        ]);

        alert()->success('La page a correctement été mise à jour !', 'Page mise à jour !');
        return redirect()->route('admin.pages.index');
    }

    /**
     * Suppression de la page
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return response()->json([
            'success'   =>  true
        ]);
    }
}
