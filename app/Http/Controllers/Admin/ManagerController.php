<?php

namespace App\Http\Controllers\Admin;

//  Requests
use App\Http\Requests\Admin\CreateEditLinkRequest;
use App\Http\Requests\Admin\CreateEditBlockRequest;
use App\Http\Requests\Admin\CreateEditCarouselRequest;

//  Models
use App\Models\Config;
use App\Models\Content\Link;
use App\Models\Content\Page;
use App\Models\Content\Block;
use App\Models\Content\Carousel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//  Utils
use DB;
use Date;

/**
 * Class ManagerController
 * @author Alexandre Ribes
 * @package App\Http\Controllers\Admin
 */
class ManagerController extends Controller
{
    protected $containers = [
        'header'    =>  'Navigation',
        'content'   =>  'Contenu',
        'menu'      =>  'Menu',
        'footer'    =>  'Bas de page',
    ];

    protected $linksContainer = [
        'header'    =>  'Navigation',
        'menu'      =>  'Menu',
        'footer'    =>  'Bas de page',
    ];

    public function index()
    {
        $links = Link::orderByRaw('container ASC, position ASC')->whereNull('parent_id')->get();
        $carousels = Carousel::orderBy('id', 'DESC')->get();
        $blocks = Block::orderBy('id', 'DESC')->get();
        $config = Config::all();



        return view('admin.manager.index', compact('links', 'carousels', 'blocks', 'config'))->with('containers', $this->containers);
    }

    /**
     * Permet d'ordonner les liens
     *
     * @param $id integer
     * @param $asc string
     * @param $type string
     * @return \Illuminate\Http\JsonResponse
     */
    public function order($id, $asc, $type)
    {
        if( !in_array($asc, ['up', 'down']) ) {
            return response()->json([
                'alert'     =>  true,
                'type'      =>  'error',
                'message'   =>  'Action inconnue !'
            ]);
        }

        if( !in_array($type, ['block', 'link', 'carousel']) ) {
            return response()->json([
                'alert'     =>  true,
                'type'      =>  'error',
                'message'   =>  'Élément inconnu !'
            ]);
        }

        switch( $type ) {
            case 'block':
                $element = Block::findOrFail($id);
                break;

            case 'link':
                $element = Link::findOrFail($id);
                break;

            case 'carousel':
                $element = Carousel::findOrFail($id);
                break;

            default: null;
        }

        if( $asc == 'up' ) {
            $direction = '<';
        } else {
            $direction = '>';
        }

        if( $type == 'block' ) {
            $move = Block::where('position', $direction, $element->position)->orderBy('position', 'DESC')->first();
        } else if( $type == 'link' ) {
            if( !is_null($element->parent_id) ) {
                $move = Link::where('position', $direction, $element->position)->where('container', $element->container)->where('parent_id', $element->parent_id)->orderBy('position', 'DESC')->first();
            } else {
                $move = Link::where('position', $direction, $element->position)->where('container', $element->container)->whereNull('parent_id')->orderBy('position', 'DESC')->first();
            }
        } else if( $type == 'carousel' ) {
            $move = Carousel::where('position', $direction, $element->position)->orderBy('position', 'DESC')->first();
        }

        if( $move ) {
            $beforePosition = $element->position;
            $element->update(['position' => $move->position]);
            $move->update(['position' => $beforePosition]);
        } else {
            return response()->json(['success' => false]);
        }

        return response()->json([
            'success'   =>  true,
            'element'   =>  $element,
            'move'      =>  $move,
            'position'  =>  $element->position,
            'move_pos'  =>  $move->position,
        ]);

        $link = Link::findOrFail($id);

        if( $asc == 'up' ) {
            if( !is_null($link->parent_id) ) {
                $linkBefore = Link::where('position', '<', $link->position)->where('container', $link->container)->where('parent_id', $link->parent_id)->orderBy('position', 'DESC')->first();
            } else {
                $linkBefore = Link::where('position', '<', $link->position)->where('container', $link->container)->whereNull('parent_id')->orderBy('position', 'DESC')->first();
            }
            if( $linkBefore ) {
                $beforePosition = $link->position;
                $link->update(['position' => $linkBefore->position]);
                $linkBefore->update(['position' => $beforePosition]);
                //DB::table('kinks')->where('id', $link->id)->decrement('position');
                //DB::table('links')->where('id', $linkBefore->id)->increment('position');
                $response = $linkBefore;
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            if( !is_null($link->parent_id) ) {
                $linkAfter = Link::where('position', '>', $link->position)->where('container', $link->container)->where('parent_id', $link->parent_id)->orderBy('position', 'ASC')->first();
            } else {
                $linkAfter = Link::where('position', '>', $link->position)->where('container', $link->container)->whereNull('parent_id')->orderBy('position', 'ASC')->first();
            }
            if( $linkAfter ) {
                $afterPosition = $link->position;
                $link->update(['position' => $linkAfter->position]);
                $linkAfter->update(['position' => $afterPosition]);
                //DB::table('kinks')->where('id', $link->id)->increment('position');
                //DB::table('links')->where('id', $linkAfter->id)->decrement('position');
                $response = $linkAfter;
            } else {
                return response()->json(['success' => false]);
            }
        }

        return response()->json([
            'success'   =>  true,
            'link'      =>  $link,
            'element'   =>  $response,
            'position'  =>  $link->position,
            'element_p' =>  $response->position,
        ]);
    }

    /**
     * Met à jour la configuration du type
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateConfig(Request $request)
    {
        foreach( Config::all() as $cfg ) {
            if( !empty($request->input($cfg->key)) && !is_null($request->input($cfg->key)) ) {
                $cfg->update(['value' => $request->input($cfg->key)]);
            }
        }

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'La configuration du site a correctement été mise à jour',
            'type'      =>  'success'
        ]);
    }

    public function link($id)
    {
        $link = Link::with('childrens')->where('id', $id)->firstOrFail();
        return view('admin.manager.link', compact('link'));
    }

    public function createLink(Request $request)
    {
        $link = new Link();
        $pagesData = Page::orderBy('name', 'ASC')->get();

        $pages = [0 => 'Sélectionnez une page'];
        foreach( $pagesData as $p ) {
            $pages[route('page', ['slug' => $p->slug])] = $p->name;
        }

        $parents = [0 => 'Sélectionnez un parent'];
        $parentsData = Link::whereNull('parent_id')->orderBy('position', 'ASC')->get();
        foreach( $parentsData as $parent ) {
            $parents[$parent->id] = $parent->name;
        }

        if( $request->has('parent') ) {
            if( array_key_exists($request->get('parent'), $parents) ) {
                $link->parent_id = $request->get('parent');
            }
        }

        return view('admin.manager.create_link', compact('link', 'pages', 'parents'))->with('containers', $this->linksContainer);
    }

    public function createCarousel()
    {
        $carousel = new Carousel();
        return view('admin.manager.create_carousel', compact('carousel'))->with('containers', $this->containers);
    }

    public function createBlock()
    {
        $block = new Block();
        return view('admin.manager.create_blocks', compact('block'))->with('containers', $this->containers);
    }

    public function storeLink(CreateEditLinkRequest $request)
    {
        $maxPosition = Link::select('id', 'position')->where('container', $request->input('container'))->orderBy('position', 'DESC')->first();

        if( $request->has('parent_id') ) {
            $parent = Link::where('id', $request->input('parent_id'))->firstOrFail();
            if( !is_null($parent->parent_id) ) {
                return response()->json([
                    'success'   =>  false,
                    'alert'     =>  true,
                    'type'      =>  'error',
                    'message'   =>  'Le lien ne peut être l\'enfant d\'un lien déjà enfant.',
                ]);
            }
        }

        Link::create([
            'name'      =>  $request->input('name'),
            'slug'      =>  str_slug($request->input('name')),
            'link'      =>  $request->input('link'),
            'position'  =>  $maxPosition ? $maxPosition->position + 1 : 1,
            'container' =>  $request->input('container')
        ]);

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Le lien a correctement été ajouté au ' . $this->linksContainer[$request->input('container')] . ' !',
            'redirect'  =>  route('admin.manager.index'),
            'type'      =>  'success'
        ]);
    }

    public function storeCarousel(CreateEditCarouselRequest $request)
    {
        $inputs = $request->all();
        $maxPosition = Carousel::select('id', 'position')->orderBy('position', 'DESC')->first();
        if( $request->hasFile('picture') ) {
            $pictureName = str_slug($request->input('title')) . Date::now()->parse('d-m-Y') . '.' . $request->file('picture')->getClientOriginalExtension();
            $request->file('picture')->move(public_path('uploads/carousels'), $pictureName);
            $inputs = array_add($inputs, 'picture', $pictureName);
        }

        if( $maxPosition ) {
            $inputs = array_add($inputs, 'position', $maxPosition->position + 1);
        } else {
            $inputs = array_add($inputs, 'position', 1);
        }
        Carousel::create($inputs);

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Le carousel a correctement été enregistré !',
            'redirect'  =>  route('admin.manager.index'),
            'type'      =>  'success'
        ]);
    }

    public function storeBlock(CreateEditBlockRequest $request)
    {

    }

    public function editLink($id)
    {
        $link = Link::findOrFail($id);
        $parents = Link::whereNull('parent_id')->where('id', '!=', $link->id)->orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('admin.manager.edit_link', compact('link', 'parents'))->with('containers', $this->linksContainer);
    }

    public function editCarousel($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.manager.edit_carousel', compact('carousel'));
    }

    public function editBlock($id)
    {
        $block = Block::findOrFail($id);
    }

    public function updateLink($id, CreateEditLinkRequest $request)
    {
        $link = Link::findOrFail($id);

        if( $request->has('parent_id') ) {
            $parent = Link::where('id', $request->input('parent_id'))->firstOrFail();
            if( !is_null($parent->parent_id) ) {
                return response()->json([
                    'success'   =>  false,
                    'alert'     =>  true,
                    'type'      =>  'error',
                    'message'   =>  'Le lien ne peut être l\'enfant d\'un lien déjà enfant.',
                ]);
            }
        }

        $link->update($request->all());

        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'type'      =>  'success',
            'message'   =>  'Le lien a correctement été mis à jour !',
            'redirect'  =>  route('admin.manager.index'),
        ]);
    }

    public function updateCarousel($id, CreateEditCarouselRequest $request)
    {
        $carousel = Carousel::findOrFail($id);
        $inputs = $request->all();

        if( $request->hasFile('picture') ) {
            if( is_file(public_path('uploads/carousels/' . $carousel->picture)) ) {
                unlink(public_path('uploads/carousels/' . $carousel->picture));
            }
            $pictureName = str_slug($request->input('title')) . Date::now()->parse('d-m-Y') . '.' . $request->file('picture')->getClientOriginalExtension();
            $request->file('picture')->move(public_path('uploads/carousels'), $pictureName);
            $inputs = array_add($inputs, 'picture', $pictureName);
        }

        $carousel->update($inputs);
        return response()->json([
            'success'   =>  true,
            'alert'     =>  true,
            'message'   =>  'Le carousel a correctement été mis à jour !',
            'redirect'  =>  route('admin.manager.index'),
            'type'      =>  'success'
        ]);
    }

    public function updateBlock($id, CreateEditBlockRequest $request)
    {
        $block = Block::findOrFail($id);
    }

    public function destroyLink($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();
        return response()->json([
            'success'   =>  true
        ]);
    }

    public function destroyCarousel($id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();

        return response()->json(['success' => true]);
    }

    public function destroyBlock($id)
    {
        $block = Block::findOrFail($id);
        $block->delete();

        return response()->json(['success' => true]);
    }
}
