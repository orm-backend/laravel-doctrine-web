<?php
namespace VVK\Web\Fields;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use VVK\ORM\Entities\Entity;
use VVK\Types\FileType;
use VVK\Types\ImageType;
use VVK\Utility\Helper;


/**
 * 
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class WrappedEntity
{
    /**
     * 
     * @var integer
     */
    protected $id;
    
    /**
     * 
     * @var \VVK\Web\Fields\BaseField[]
     */
    protected $fields = [];
    
    /**
     * 
     * @var string
     */
    protected $type;
    
    /**
     *
     * @var bool
     */
    public $cretingAllowed;
    
    /**
     * 
     * @var bool
     */
    public $updatingAllowed;
    
    /**
     *
     * @var bool
     */
    public $delitingAllowed;
    
    /**
     *
     * @var bool
     */
    public $restoringAllowed;
    
    /**
     * 
     * @var string
     */
    public $classUrlName;
    
    /**
     * 
     * @param int $id
     */
    public function __construct(Entity $entity)
    {
        $this->id = $entity->getId();
        $this->classUrlName = Helper::classToUrl(get_class($entity));
        
        if ($entity instanceof ImageType) {
            $this->type = 'image';
            $this->url = Storage::url($entity->getPath());
        } else if ($entity instanceof FileType) {
            $this->type = 'file';
            $this->url = Storage::url($entity->getPath());
        } else {
            $this->type = 'common';
        }
        
        $this->cretingAllowed = Gate::inspect('create', Helper::classToUrl(get_class($entity)))->allowed();
        $this->readingAllowed = Gate::inspect('read-record', $entity)->allowed();
        $this->updatingAllowed = Gate::inspect('update-record', $entity)->allowed();
        $this->delitingAllowed = Gate::inspect('delete-record', $entity)->allowed();
        $this->restoringAllowed = Gate::inspect('restore-record', $entity)->allowed();
    }
    
    /**
     * 
     * @param \VVK\Web\Fields\MetaField $field
     */
    public function addField(MetaField $field)
    {
        $this->fields[$field->name] = $field;
    }
    
    /**
     * 
     * @return integer
     */
    public function id()
    {
        return $this->id;
    }
    
    /**
     *
     * @return string
     */
    public function type()
    {
        return $this->type;
    }
    
    /**
     * 
     * @return \VVK\Web\Fields\BaseField[]
     */
    public function fields()
    {
        return $this->fields;
    }
    
    /**
     *
     * @return \VVK\Web\Fields\BaseField
     */
    public function field(string $name)
    {
        return isset($this->fields[$name]) ? $this->fields[$name] : null;
    }

}
