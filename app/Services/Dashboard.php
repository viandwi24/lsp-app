<?php
namespace App\Services;

class Dashboard
{
    protected static $newMenu = [
        'admin' => [], 'asesor' => [], 'asesi' => [], 'superadmin' => [], 
    ];

    public static function addMenu($role, $data)
    {
        self::$newMenu[$role][] = $data;
    }

    protected static function defaultSidebarMenu()
    {
        return [
            'admin' => [
                [ 'type' => 'item', 'text' => 'Home', 'icon' => 'la la-home', 'link' => url()->route('admin.home') ],
                [ 'type' => 'item', 'text' => 'Profil', 'icon' => 'la la-user', 'link' => url()->route('admin.profil.index') ],
                
                [ 'type' => 'header', 'text' => 'Manajemen' ],
                [ 'type' => 'item', 'text' => 'Kategori', 'icon' => 'la la-tags', 'link' => url()->route('admin.kategori.index'), 'match' => 'admin/kategori*' ],
                [ 'type' => 'item', 'text' => 'Tempat Uji', 'icon' => 'la la-map-marker', 'link' => url()->route('admin.tuk.index'),  'match' => 'admin/tuk*' ],
                [ 'type' => 'item', 'text' => 'Jadwal', 'icon' => 'la la-calendar', 'link' => url()->route('admin.jadwal.index'),  'match' => 'admin/jadwal*' ],
                [ 'type' => 'item', 'text' => 'Skema', 'icon' => 'la la-book', 'link' => url('tes') ],
                [ 'type' => 'treeview', 'text' => 'User', 'icon' => 'la la-users', 'items' =>  [
                    [ 'text' => 'Asesi', 'link' => url()->route('admin.user.asesi.index'),  'match' => 'admin/user/asesi*' ],
                    [ 'text' => 'Asesor', 'link' => url('tes') ],
                ]],
            ],

            'asesor' => [
                [ 'type' => 'item', 'text' => 'Home', 'icon' => 'la la-home', 'link' => url()->route('asesor.home') ],
                [ 'type' => 'item', 'text' => 'Profil', 'icon' => 'la la-user', 'link' => url('tes') ],
            ],

            'asesi' => [
                [ 'type' => 'item', 'text' => 'Home', 'icon' => 'la la-home', 'link' => url()->route('asesi.home') ],
                [ 'type' => 'item', 'text' => 'Profil', 'icon' => 'la la-user', 'link' => url('tes') ],
            ],

            'superadmin' => [
                [ 'type' => 'item', 'text' => 'Home', 'icon' => 'la la-home', 'link' => url()->route('superadmin.home') ],
                [ 'type' => 'item', 'text' => 'Module', 'icon' => 'la la-plug', 'link' => url()->route('superadmin.module.index') ],
                [ 'type' => 'item', 'text' => 'Sistem', 'icon' => 'la la-server', 'link' => url('tes') ],
            ],
        ];
    }
    
    public static function getSidebarMenu()
    {
        $arr = self::defaultSidebarMenu();
        $newArr = [];

        $newArr['admin'] = array_merge($arr['admin'], self::$newMenu['admin']);
        $newArr['asesi'] = array_merge($arr['asesi'], self::$newMenu['asesi']);
        $newArr['asesor'] = array_merge($arr['asesor'], self::$newMenu['asesor']);
        $newArr['superadmin'] = array_merge($arr['superadmin'], self::$newMenu['superadmin']);
        return $newArr;
    }
}