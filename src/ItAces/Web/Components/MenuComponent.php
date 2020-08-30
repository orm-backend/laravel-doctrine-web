<?php
namespace VVK\Web\Components;

use Illuminate\View\Component;

class MenuComponent extends Component
{
    
    /**
     * 
     * @var string
     */
    protected $template;
    
    /**
     *
     * @var string
     */
    protected $name;
    
    /**
     * 
     * @var \VVK\Web\Menu\MenuFactory
     */
    protected $factory;
    
    public function __construct(string $name, string $template)
    {
        $this->name = $name;
        $this->template = $template;
        $this->factory = app('menu');
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\View\Component::render()
     */
    public function render()
    {
        return view($this->template, [
            'menu' => $this->factory->getMenuValue($this->name)
        ]);
    }
    
}
