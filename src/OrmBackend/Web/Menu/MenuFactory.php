<?php
namespace OrmBackend\Web\Menu;

interface MenuFactory
{
    
    /**
     * 
     * @param string $key
     * @param \OrmBackend\Web\Menu\Menu $menu
     */
    public function addMenu(string $key, Menu $menu) : void;
    
    /**
     * 
     * @param string $key
     * @return \OrmBackend\Web\Menu\Menu | null
     */
    public function getMenu(string $key);
    
    /**
     *
     * @param string $key
     * @return array | null
     */
    public function getMenuValue(string $key);
    
    /**
     * 
     * @param string $key
     * @return \OrmBackend\Web\Menu\Menu | null
     */
    public function removeMenu(string $key) : void;
    
    /**
     * 
     * @param string $key
     * @return bool
     */
    public function isContains(string $key) : bool;

}
