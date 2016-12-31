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
            $authorization = $actions[2] . '_' . $actions[1];

            if( !$this->auth->user()->isAuthorized($authorization) ) {
                if( $this->auth->user()->isAuthorized($this->authorizedActions[$actions[2]] . '_' . $actions[1]) && array_key_exists($actions[2], $this->authorizedActions)  ) {
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
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
