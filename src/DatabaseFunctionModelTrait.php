<?php  
namespace Webboy\Modeltraits;

trait DatabaseFunctionModelTrait
{
	protected static $db_function_columns = array();

	public static function getColumns($columns = ['*'])
	{		
		$columns = array_merge($columns,self::$db_function_columns);

		return $columns;
	}
}