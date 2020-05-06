<?php

namespace App\Providers;

use App\Facades\Menu;
use Illuminate\Support\ServiceProvider;
use App\Services\Helper;

class LspServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->bindClass();
        Helper::load();
    }

    public function boot()
    {
        $this->app->Booted(function () {
            $this->makeMenu();
        });
    }

    // 
    protected function bindClass()
    {
        $this->app->bind('menu',function() {
            return new \App\Services\Menu;
        });
    }

    protected function makeMenu()
    {
        // 
        Menu::make('dashboard.sidebar', ['superadmin', 'admin', 'asesor', 'asesi']);
        Menu::make('dashboard.skema', ['admin']);
        Menu::make('dashboard.skema.widget', ['admin']);

        // 
        Menu::get('dashboard.sidebar')
            // superadmin
            ->add('superadmin', [ 'type' => 'item', 'text' => 'Home', 'icon' => 'la la-home', 'link' => route('superadmin.home') ])
            ->add('superadmin', [ 'type' => 'item', 'text' => 'Module', 'icon' => 'la la-plug', 'link' => route('superadmin.module.index') ])
            ->add('superadmin', [ 'type' => 'item', 'text' => 'Sistem', 'icon' => 'la la-server', 'link' => url('tes') ])

            // admin
            ->add('admin', [ 'type' => 'item', 'text' => 'Home', 'icon' => 'la la-home', 'link' => route('admin.home') ])
            ->add('admin', [ 'type' => 'item', 'text' => 'Profil', 'icon' => 'la la-user', 'link' => route('admin.profil') ])
            ->add('admin', [ 'type' => 'header', 'text' => 'Manajemen' ])
            ->add('admin', [ 'type' => 'item', 'text' => 'Kategori', 'icon' => 'la la-tags', 'link' => route('admin.kategori.index'), 'match' => 'admin/kategori*' ])
            ->add('admin', [ 'type' => 'item', 'text' => 'Tempat Uji', 'icon' => 'la la-map-marker', 'link' => route('admin.tuk.index'),  'match' => 'admin/tuk*' ])
            ->add('admin', [ 'type' => 'item', 'text' => 'Jadwal', 'icon' => 'la la-calendar', 'link' => route('admin.jadwal.index'),  'match' => 'admin/jadwal*' ])
            ->add('admin', [ 'type' => 'item', 'text' => 'Skema', 'icon' => 'la la-book', 'link' => route('admin.skema.index'),  'match' => 'admin/skema*' ])
            ->add('admin', [ 'type' => 'treeview', 'text' => 'User', 'icon' => 'la la-users', 'items' =>  [
                [ 'text' => 'Asesi', 'link' => route('admin.user.asesi.index'),  'match' => 'admin/user/asesi*' ],
                [ 'text' => 'Asesor', 'link' => route('admin.user.asesor.index'),  'match' => 'admin/user/asesor*' ],
            ]])
            ->add('admin', [ 'type' => 'item', 'text' => 'Berkas', 'icon' => 'la la-folder', 'link' => route('admin.berkas') ])

            // asesor
            ->add('asesor', [ 'type' => 'item', 'text' => 'Home', 'icon' => 'la la-home', 'link' => route('asesor.home') ])
            ->add('asesor', [ 'type' => 'item', 'text' => 'Profil', 'icon' => 'la la-user', 'link' => url('tes') ])

            // asesi
            ->add('asesi', [ 'type' => 'item', 'text' => 'Home', 'icon' => 'la la-home', 'link' => route('asesi.home') ])
            ->add('asesi', [ 'type' => 'item', 'text' => 'Profil', 'icon' => 'la la-user', 'link' => route('asesi.profil') ])
            ->add('asesi', [ 'type' => 'item', 'text' => 'Berkas', 'icon' => 'la la-folder', 'link' => route('asesi.berkas.index'),  'match' => 'asesi/berkas*' ])
            ->add('asesi', [ 'type' => 'header', 'text' => 'Skema' ])
            ->add('asesi', [ 'type' => 'item', 'text' => 'Daftar Skema', 'icon' => 'la la-book', 'link' => route('asesi.skema') ])
            ->add('asesi', [ 'type' => 'header', 'text' => 'Pra Asesmen' ])
            ->add('asesi', [ 'type' => 'item', 'text' => 'Permohonan', 'icon' => 'la la-book', 'link' => route('asesi.permohonan.index') ]);

        
        // 
        Menu::get('dashboard.skema')
            ->add('admin', [ 'link' => function ($skema) {
                return route('admin.skema.permohonan.index', [$skema->id]);
            }, 'text' => function () {
                return '<i class="ft-navigation"></i> Permohonan Asesi';
            }]);
    }
}
