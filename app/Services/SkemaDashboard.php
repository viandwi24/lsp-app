<?php
namespace App\Services;

use Closure;

class SkemaDashboard
{
    protected static $menu = [];
    protected static $widget = [];

    public static function addMenu($item)
    {
        self::$menu[] = $item;
    }

    public static function getMenu($skema)
    {
        $result = [];
        foreach(self::$menu as $menu)
        {
            // link
            $tmp = [];
            if (self::isClosure($menu['link']))
            {
                $closure = $menu['link'];
                $tmp['link'] = $closure($skema);
            } else { $tmp['link'] = $menu['link']; }

            // text
            if (self::isClosure($menu['text']))
            {
                $closure = $menu['text'];
                $tmp['text'] = $closure($skema);
            } else { $tmp['text'] = $menu['text']; }

            // 
            $result[] = $tmp;
        }
        return $result;
    }

    public static function addWidget($item)
    {
        self::$widget[] = $item;
    }

    public static function getWidget($skema)
    {
        $result = [];
        foreach(self::$widget as $widget)
        {
            if (self::isClosure($widget))
            {
                $closure = $widget;
                $result[] = $closure($skema);
            } else { $result[] = $widget; }
        }
        return $result;
    }

    protected static function isClosure($suspected_closure) {
        try {
            $reflection = new \ReflectionFunction($suspected_closure);
        } catch (\Throwable $th) {
            return false;
        }
    
        return (bool) $reflection->isClosure();
    }
}