<?php

namespace Modules\Tag\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         *
         * Module Menu for Admin Backend
         *
         * *********************************************************************
         */
        \Menu::make('admin_sidebar', function ($menu) {
            // Tags
            $menu->add('<i class="link-icon" data-feather="bookmark"></i><span class="link-title"> '.__('Tags').'</span>', [
                'route' => 'backend.tags.index',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 84,
                    'activematches' => ['admin/tags*'],
                    'permission' => ['view_tags'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);
        })->sortBy('order');

        return $next($request);
    }
}
