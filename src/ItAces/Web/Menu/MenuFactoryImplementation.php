<?php
namespace VVK\Web\Menu;

class MenuFactoryImplementation implements MenuFactory
{
    
    /**
     * 
     * @var \VVK\Web\Menu\Menu[]
     */
    protected $elements = [];
    
    /**
     * {@inheritDoc}
     * @see \VVK\Web\Menu\MenuFactory::addMenu()
     */
    public function addMenu(string $key, Menu $menu) : void
    {
        $this->elements[$key] = $menu;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VVK\Web\Menu\MenuFactory::isContains()
     */
    public function isContains(string $key) : bool
    {
        return array_key_exists($key, $this->elements);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VVK\Web\Menu\MenuFactory::removeMenu()
     */
    public function removeMenu(string $key) : void
    {
        unset($this->elements[$key]);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VVK\Web\Menu\MenuFactory::getMenu()
     */
    public function getMenu(string $key)
    {
        return $this->elements[$key] ?? null;
    }

    /**
     *
     * {@inheritDoc}
     * @see \VVK\Web\Menu\MenuFactory::getMenuValue()
     */
    public function getMenuValue(string $key)
    {
        if (!$this->isContains($key)) {
            return null;
        }
        
        $menu = $this->elements[$key]->toArray();
        
        return $menu['submenu'];
    }

}
