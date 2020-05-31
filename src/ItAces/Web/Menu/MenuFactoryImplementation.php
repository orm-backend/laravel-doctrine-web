<?php
namespace ItAces\Web\Menu;

class MenuFactoryImplementation implements MenuFactory
{
    
    /**
     * 
     * @var \ItAces\Web\Menu\Menu[]
     */
    protected $elements = [];
    
    /**
     * {@inheritDoc}
     * @see \ItAces\Web\Menu\MenuFactory::addMenu()
     */
    public function addMenu(string $key, Menu $menu) : void
    {
        $this->elements[$key] = $menu;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \ItAces\Web\Menu\MenuFactory::isContains()
     */
    public function isContains(string $key) : bool
    {
        return array_key_exists($key, $this->elements);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \ItAces\Web\Menu\MenuFactory::removeMenu()
     */
    public function removeMenu(string $key) : void
    {
        unset($this->elements[$key]);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \ItAces\Web\Menu\MenuFactory::getMenu()
     */
    public function getMenu(string $key)
    {
        return $this->elements[$key] ?? null;
    }

    /**
     *
     * {@inheritDoc}
     * @see \ItAces\Web\Menu\MenuFactory::getMenuValue()
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
