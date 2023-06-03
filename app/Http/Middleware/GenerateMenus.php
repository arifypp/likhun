<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

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
            // Separator: Access Management
            $menu->add('Main', [
                'class' => 'nav-item nav-category',
            ]);
            // Dashboard
            $menu->add('<i class="link-icon" data-feather="box"></i> '.__('<span class="link-title">Dashboard</span>'), [
                'route' => 'backend.dashboard',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 1,
                    'activematches' => 'admin/dashboard*',
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Notifications
            $menu->add('<i class="link-icon" data-feather="bell"></i> <span class="link-title">'.__('Notifications').'</span>', [
                'route' => 'backend.notifications.index',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 99,
                    'activematches' => 'admin/notifications*',
                    'permission' => [],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Separator: Lyric Music
            $menu->add('Lyrical Music', [
                'class' => 'nav-item nav-category',
            ])
                ->data([
                    'order' => 100,
                    'permission' => ['edit_settings', 'view_backups', 'view_users', 'view_roles', 'view_logs'],
                ]);
            
            // Songs with submenu categories
            $songs_menu = $menu->add('<i class="link-icon" data-feather="music"></i> '.__('<span class="link-title">Manage Songs</span>') .'<i class="link-arrow" data-feather="chevron-down"></i>', [
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 101,
                    'activematches' => [
                        'admin/songs*',
                        'admin/categories*',
                    ],
                    // 'permission' => ['view_songs', 'view_categories'],
                ]);
            $songs_menu->link->attr([
                'class' => 'nav-link',
                'href' => '#lyrical_songs',
                'data-toggle' => 'collapse',
                'aria-expanded' => 'false',
                'role' => 'button',
                'aria-controls' => 'songs',
            ]);

            // Submenu: Song
            $songs_menu->add(__('Song'), [
                'route' => 'backend.songs',
                'class' => 'nav-item collapse',
                'id' => 'lyrical_songs',
            ])
                ->data([
                    'order' => 102,
                    'activematches' => 'admin/song*',
                    'permission' => ['edit_songs'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                    'id' => 'songs',
                ]);

            // Submenu: Artist
            $songs_menu->add(__('Artist'), [
                'route' => 'backend.artists',
                'class' => 'nav-item collapse',
                'id' => 'lyrical_songs',
            ])
                ->data([
                    'order' => 103,
                    'activematches' => 'admin/artists*',
                    'permission' => ['edit_artists'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                    'id' => 'songs',
                ]);

            // Submenu: Categories
            $songs_menu->add(__('Categories'), [
                'route' => 'backend.song_categories',
                'class' => 'nav-item collapse',
                'id' => 'lyrical_songs',
            ])
                ->data([
                    'order' => 104,
                    'activematches' => 'admin/song_categories*',
                    'permission' => ['edit_song_categories'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                    'id' => 'songs',
                ]);
            
            // Separator: Management
            $menu->add('Management', [
                'class' => 'nav-item nav-category',
            ])
                ->data([
                    'order' => 101,
                    'permission' => ['edit_settings', 'view_backups', 'view_users', 'view_roles', 'view_logs'],
                ]);

            // Settings
            $menu->add('<i class="link-icon" data-feather="settings"></i> <span class="link-title">'.__('Settings').'</span>', [
                'route' => 'backend.settings',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 102,
                    'activematches' => 'admin/settings*',
                    'permission' => ['edit_settings'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Backup
            $menu->add('<i class="link-icon" data-feather="rotate-cw"></i> <span class="link-title">'.__('Backups').'</span>', [
                'route' => 'backend.backups.index',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 103,
                    'activematches' => 'admin/backups*',
                    'permission' => ['view_backups'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Access Control Dropdown
            $accessControl = $menu->add('<i class="link-icon" data-feather="unlock"></i> <span class="link-title">'.__('Access Control').'</span><i class="link-arrow" data-feather="chevron-down"></i>', [
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 104,
                    'activematches' => [
                        'admin/users*',
                        'admin/roles*',
                    ],
                    'permission' => ['view_users', 'view_roles'],
                ]);
            $accessControl->link->attr([
                'class' => 'nav-link',
                'href' => '#access',
                'data-toggle' => 'collapse',
                'aria-expanded' => 'false',
                'role' => 'button',
                'aria-controls' => 'access',
            ]);

            // Submenu: Users
            $accessControl->add('Users', [
                'route' => 'backend.users.index',
                'class' => 'nav-item collapse',
                'id' => 'access',
            ])
                ->data([
                    'order' => 105,
                    'activematches' => 'admin/users*',
                    'permission' => ['view_users'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Submenu: Roles
            $accessControl->add('Roles', [
                'route' => 'backend.roles.index',
                'class' => 'nav-item collapse',
                'id' => 'access',
            ])
                ->data([
                    'order' => 106,
                    'activematches' => 'admin/roles*',
                    'permission' => ['view_roles'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Log Viewer Dropdown
            $accessControl = $menu->add('<i class="link-icon" data-feather="pie-chart"></i> <span class="link-title">'.__('Log Viewer'). '</span><i class="link-arrow" data-feather="chevron-down"></i>', [
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 107,
                    'activematches' => [
                        'log-viewer*',
                    ],
                    'permission' => ['view_logs'],
                ]);
            $accessControl->link->attr([
                'class' => 'nav-link',
                'href' => '#log-viewer',
                'data-toggle' => 'collapse',
                'aria-expanded' => 'false',
                'role' => 'button',
                'aria-controls' => 'log-viewer',
            ]);

            // Submenu: Log Viewer Dashboard
            $accessControl->add('Dashboard', [
                'route' => 'log-viewer::dashboard',
                'class' => 'nav-item collapse',
                'id' => 'log-viewer',
            ])
                ->data([
                    'order' => 108,
                    'activematches' => 'admin/log-viewer',
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Submenu: Log Viewer Logs by Days
            $accessControl->add('Logs by Days', [
                'route' => 'log-viewer::logs.list',
                'class' => 'nav-item collapse',
                'id' => 'log-viewer',
            ])
                ->data([
                    'order' => 109,
                    'activematches' => 'admin/log-viewer/logs*',
                ])
                ->link->attr([
                    'class' => 'nav-link',
                    'id' => 'log-viewer',
                ]);

            // Separator: Support Me
            $menu->add('Support Me', [
                'class' => 'nav-item nav-category',
            ])
                ->data([
                    'order' => 110,
                    'permission' => ['edit_settings', 'view_backups', 'view_users', 'view_roles', 'view_logs'],
            ]);
            
            $menu->add('<i class="link-icon" data-feather="hash"></i> <span class="link-title">'.__('Support Us').'</span>', [
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 111,
                ])
                ->link->attr([
                    'class' => 'nav-link',
                    'target' => '_blank',
                    'href' => 'https://happyarif.com',
                ]);

            // Access Permission Check
            $menu->filter(function ($item) {
                if ($item->data('permission')) {
                    if (auth()->check()) {
                        if (auth()->user()->hasRole('super admin')) {
                            return true;
                        } elseif (auth()->user()->hasAnyPermission($item->data('permission'))) {
                            return true;
                        }
                    }

                    return false;
                } else {
                    return true;
                }
            });

            // Set Active Menu
            $menu->filter(function ($item) {
                if ($item->activematches) {
                    $activematches = (is_string($item->activematches)) ? [$item->activematches] : $item->activematches;
                    foreach ($activematches as $pattern) {
                        if (request()->is($pattern)) {
                            $item->active();
                            $item->link->active();
                            if ($item->hasParent()) {
                                $item->parent()->active();
                            }
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

        return $next($request);
    }
}
