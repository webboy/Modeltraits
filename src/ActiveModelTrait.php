<?php  
namespace Webboy\Modeltraits;

trait ActiveModelTrait
{

	public function scopeActive($query)
    {
    	if (null !== self::STATUS_ACTIVE && !empty($this->status_column))
    	{
        	$query->where($this->table.'.'.$this->status_column,self::STATUS_ACTIVE);
        }

        return $query;
    }
}