<?php  
namespace Webboy\Modeltraits;

use Illuminate\Database\Eloquent\Builder;

trait DatabaseFunctionModelTrait
{
	protected static $db_function_columns = array();

	public static function getColumns($columns = ['*'])
	{		
		$columns = array_merge($columns,self::$db_function_columns);

		return $columns;
	}

	public function scopeAddFunctionColumns(Builder $query,$columns = ['*'])
	{
		if (!empty(self::$db_function_columns) && is_array(self::$db_function_columns))
		{
			foreach (self::$db_function_columns as $column)
			{
				array_push($columns,$column);
			}
		}
		
		$query->select($columns);

		return $query;
	}
}