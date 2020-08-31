<?php
namespace OrmBackend\Web\Menu;


/**
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class Menu
{
    
    /**
     * @var array
     */
    protected $link;
    
    /**
     * @var \OrmBackend\Web\Menu\Menu[]
     */
    protected $submenu;
    
    /**
     * Initializes a new Menu.
     *
     * @param array $link
     */
    public function __construct(array $link = [])
    {
        $this->link = $link;
        $this->submenu = [];
    }
    
    /**
     * 
     * @param array $link
     */
    public function setLink(array $link) : void
    {
        $this->link = $link;
    }
    
    /**
     * 
     * @return array
     */
    public function getLink() : array
    {
        return $this->link;
    }
    
    /**
     * 
     * @param string $key
     * @return mixed|NULL
     */
    public function getLinkValue(string $key)
    {
        return $this->link[$key] ?? null;
    }
    
    /**
     * 
     * @param string $key
     * @param mixed $value
     */
    public function setLinkValue(string $key, $value) : void
    {
        $this->link[$key] = $value;
    }
    
    /**
     * 
     * @param string $key
     * @return bool
     */
    public function containsLinkValue(string $key) : bool
    {
        return array_key_exists($key, $this->link);
    }
    
    /**
     * 
     * @param array $submenu
     */
    public function setSubmenu(array $submenu) : void
    {
        $this->submenu = $submenu;
    }
    
    /**
     * 
     * @return array
     */
    public function getSubmenu() : array
    {
        return $this->submenu;
    }
    
    /**
     * 
     * @param string $key
     * @param \OrmBackend\Web\Menu\Menu $submenu
     */
    public function addSubmenuElement(string $key, Menu $submenu) : void
    {
        $this->submenu[$key] = $submenu;
    }
    
    /**
     * 
     * @param string $key
     * @return NULL|\OrmBackend\Web\Menu\Menu
     */
    public function getSubmenuElement(string $key)
    {
        return $this->submenu[$key] ?? null;
    }

    /**
     * 
     * @param string $key
     */
    public function removeSubmenuElement(string $key) : void
    {
        unset($this->submenu[$key]);
    }
    
    /**
     * 
     * @param string $key
     * @return bool
     */
    public function containsSubmenuElement(string $key) : bool
    {
        return array_key_exists($key, $this->submenu);
    }

    /**
     * 
     * @return array
     */
    public function toArray() : array
    {
        $values = $this->link;
        $values['submenu'] = [];
        
        foreach ($this->submenu as $key => $menu) {
            $values['submenu'][$key] = $menu->toArray();
        }
        
        return $values;
    }
    
}
