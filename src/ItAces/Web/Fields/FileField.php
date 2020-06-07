<?php
namespace ItAces\Web\Fields;

use Doctrine\ORM\Mapping\ClassMetadata;
use Illuminate\Support\Facades\Storage;
use ItAces\ORM\Entities\Entity;

/**
 * 
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class FileField extends ReferenceField
{
    
    /**
     * 
     * @var string
     */
    public $url;
    
    /**
     *
     * @var string
     */
    public $path;
    
    /**
     *
     * @param \Doctrine\ORM\Mapping\ClassMetadata $classMetadata
     * @param string $fieldName
     * @param \ItAces\ORM\Entities\Entity $entity
     * @param int $index
     * @return \ItAces\Web\Fields\MetaField
     */
    public static function getInstance(ClassMetadata $classMetadata, string $fieldName, Entity $entity = null, int $index = null)
    {
        $instance = parent::getInstance($classMetadata, $fieldName, $entity, $index);

        if ($entity && array_search($fieldName, FieldContainer::FORBIDDEN_FIELDS) === false) {
            /**
             * 
             * @var \ItAces\Types\FileType $file
             */
            $file = $entity->{$fieldName};

            if ($file) {
                $instance->path = $file->getPath();
                $instance->url = Storage::url($instance->path);
            }
        }
        
        return $instance;
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \ItAces\Web\Fields\MetaField::getHtmlType()
     */
    protected function getHtmlType()
    {
        return 'file';
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \ItAces\Web\Fields\MetaField::getDefaultSortable()
     */
    protected function getDefaultSortable()
    {
        return 'false';
    }

}
