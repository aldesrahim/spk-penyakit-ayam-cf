<?php

namespace App\Filament\Widgets;

use Filament\Facades\Filament;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class RefreshDatabase extends Widget
{
    protected static string $view = 'filament.widgets.refresh-database';

    public function run()
    {
        Artisan::call('migrate:fresh --seed');

        Auth::logout();

        Request::session()->invalidate();
        Request::session()->regenerateToken();

        $this->redirect(Filament::getLoginUrl());
    }
}
