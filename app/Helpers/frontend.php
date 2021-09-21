<?php

function openMenu($menu, $current)
{
   return $current === $menu ? 'menu-open' : null;
}

function setMenu($menu, $current)
{
   return $current === $menu ? 'active' : null;
}