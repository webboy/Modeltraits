<?php  
namespace Webboy\Modeltraits;

trait SortableModelTrait
{
	public function scopeSort($query, $order_by = null, $order_type = null)
    {
        if(empty($order_by)) $order_by = 'id';
        if(empty($order_type)) $order_type = 'asc';

        return $query->orderBy($order_by,$order_type);

    }
}