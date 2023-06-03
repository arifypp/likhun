<?php

namespace Modules\Article\Http\Middleware;

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
        \Menu::make('admin_sidebar', function ($menu) {
            // Articles Dropdown
            $articles_menu = $menu->add('<i class="link-icon" data-feather="server"></i> '.__('<span class="link-title">Article</span>') .'<i class="link-arrow" data-feather="chevron-down"></i>', [
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 81,
                    'activematches' => [
                        'admin/posts*',
                        'admin/categories*',
                    ],
                    'permission' => ['view_posts', 'view_categories'],
                ]);
            $articles_menu->link->attr([
                'class' => 'nav-link',
                'href' => '#articles',
                'data-toggle' => 'collapse',
                'aria-expanded' => 'false',
                'role' => 'button',
                'aria-controls' => 'articles',
            ]);

            // Submenu: Posts
            $articles_menu->add(__('Posts'), [
                'route' => 'backend.posts.index',
                'class' => 'nav-item collapse',
                'id' => 'articles',
            ])
                ->data([
                    'order' => 82,
                    'activematches' => 'admin/posts*',
                    'permission' => ['edit_posts'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);
            // Submenu: Categories
            $articles_menu->add(__('Categories'), [
                'route' => 'backend.categories.index',
                'class' => 'nav-item collapse',
                'id' => 'articles',
            ])
                ->data([
                    'order' => 83,
                    'activematches' => 'admin/categories*',
                    'permission' => ['edit_categories'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);
        })->sortBy('order');

        return $next($request);
    }
}
