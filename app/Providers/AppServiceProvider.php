<?php

namespace App\Providers;

use App\Models\DB\ContentTypes;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->addAfter(
                'contents',
                [
                    'key' => 'structure',
                    'text' => 'Estruturas',
                    'url' => route('dashboard.content.index', ['single' => 'false']),
                    'icon' => 'fas fa-fw fa-project-diagram',
                    'submenu' => [
                        [
                            'text' => 'Ver tudo',
                            'url' => route('dashboard.content.index', ['single' => 'false']),
                        ],
                    ],
                ]
            );
            $subitems = ContentTypes::where('single', false)->get()->map(function (ContentTypes $contentType) {
                return [
                    'text' => $contentType->title,
                    'url' => route('dashboard.content.index', ['type' => $contentType->id]),
                ];
            });
            $event->menu->addIn('structure', ...$subitems);
            $event->menu->addAfter(
                'contents',
                [
                    'text' => 'Páginas',
                    'url' => route('dashboard.content.index', ['single' => 'true']),
                    'icon' => 'fas fa-fw fa-file-alt',
                ]
            );
        });
    }
}
