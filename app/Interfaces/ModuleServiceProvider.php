<?php
namespace App\Interfaces;

interface ModuleServiceProvider
{
    public function register();
    public function boot();
    public function checkInstalled();
}