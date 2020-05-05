<?php

namespace App\Services;

class Menu
{
    protected $menu = [];
    protected $selectedName = null;
    protected $selectedRole = null;

    // 
    public function make(string $name, array $roles)
    {
        $this->menu[$name] = [];
        foreach ($roles as $role)
        {
            $this->menu[$name][$role] = [];
        }
        return $this;
    }

    // 
    public function get(string $name, $role = null)
    {
        $this->selectedName = $name;
        if ($role != null) $this->selectedRole = $role;
        return $this;
    }

    // 
    public function add($role, array $item)
    {
        // 
        if ($role != null) $this->selectedRole = $role;
        
        // 
        if ($this->selectedName == null or !isset($this->menu[$this->selectedName])) return null;
        if (!is_array($this->selectedRole) && ($this->selectedRole == null or !isset($this->menu[$this->selectedName][$this->selectedRole]))) return null;

        // 
        if (is_array($this->selectedRole))
        {
            foreach($this->selectedRole as $role)
            {
                $this->menu[$this->selectedName][$role][] = $item;
            }
        } else {
            $this->menu[$this->selectedName][$this->selectedRole][] = $item;
        }

        return $this;
    }
    
    // 
    public function toArray(string $role)
    {
        if ($this->selectedName == null or !isset($this->menu[$this->selectedName])) return null;

        // 
        return $this->menu[$this->selectedName][$role];
    }
}