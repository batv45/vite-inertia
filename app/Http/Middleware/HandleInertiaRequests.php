<?php

namespace App\Http\Middleware;

use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\Rules\Password;
use App\Http\Resources\UserResource;
use Flasher\Laravel\Storage\SessionBag;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return vite()->getHash();
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'app' => [
                'routes' => function () {
//                    return (new Ziggy)->toArray();
                }
            ],
            'user' => $request->user() ? new UserResource($request->user()) : null,
            'flash' => function (){return flash()->render([], 'array');},
            'versions' => [
            	'php' => PHP_VERSION,
            	'laravel' => \Illuminate\Foundation\Application::VERSION
            ],

        ]);
    }
}
