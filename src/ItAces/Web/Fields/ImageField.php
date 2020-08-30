<?php
namespace VVK\Web\Fields;

/**
 * 
 * @author Vitaliy Kovalenko vvk@kola.cloud
 *
 */
class ImageField extends FileField
{
    
    /**
     *
     * {@inheritDoc}
     * @see \VVK\Web\Fields\MetaField::getHtmlType()
     */
    protected function getHtmlType()
    {
        return 'image';
    }

}
