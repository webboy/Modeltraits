<?php  
namespace Webboy\Modeltraits;

trait SortableModelTrait
{
	protected $default_order_by = 'id';

	protected $default_order_type = 'asc';

	public function scopeSort($query, $order_by = null, $order_type = null)
    {
        if(empty($order_by)) $order_by = $this->default_order_by;
        if(empty($order_type)) $order_type = $this->default_order_type;

        return $query->orderBy($this->table.'.'.$order_by,$order_type);

    }
}