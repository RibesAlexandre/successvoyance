<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class HasPermission
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    protected $authorizedActions = [
        'store'         =>  'create',
        'update'        =>  'edit',
        'index'         =>  'index',
        'delete'        =>  'destroy',
        'create'        =>  'create',
        'edit'          =>  'edit',
        'destroy'       =>  'destroy',
    ];

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $actions = explode('.', $request->route()->getName());

        if( !in_array($request->route()->getName(), ['admin.index']) ) {

            $actionOne = $actions[1];
            $actionOne = str_replace('store', 'create', $actionOne);
            $actionOne = str_replace('update', 'edit', $actionOne);

            if( isset($actions[2]) ) {

                $actionTwo = $actions[2];
                $actionTwo = str_replace('store', 'create', $actionTwo);
                $actionTwo = str_replace('update', 'edit', $actionTwo);

                $authorization = $actionOne . '_' . $actionTwo;
            } else {
                $authorization = $actionOne;
            }

            if( !$this->auth->check() ) {
                if( $request->ajax() ) {
                    return response()->json([
                        'success'   =>  false,
                        'alert'     =>  true,
                        'message'   =>  'Vous devez être connecté pour accéder à cette page',
                    ]);
                } else {
                    alert()->error('Vous devez être connecté pour pouvoir accéder à cette page');
                    return redirect()->route('home');
                }
            }

            if( $this->auth->user()->isAuthorized($authorization) ) {
                return $next($request);
            } else {
                if( $request->ajax() ) {
                    return response()->json([
                        'success'   =>  'false',
                        'alert'     =>  true,
                        'message'   =>  'Vous n\'êtes pas autorisés à réaliser cette action',
                    ]);
                } else {
                    alert()->error('Vous n\'êtes pas autorisé à accéder à cette page', 'Accès interdit');
                    return redirect()->route('admin.index');
                }
            }
        }

        return $next($request);
    }
}
