<?php  
namespace Webboy\Modeltraits;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

trait ApiModelTrait
{
	public static $default_api_attributes = ['id'];

	public static $api_attributes = [];

	public static $allowed_api_attributes = ['id'];

	public function prepareApiAttributes()
	{
		if (empty(self::$api_attributes))
		{
			self::$api_attributes = self::$default_api_attributes;
		}

		$output = array();		
		foreach (self::$api_attributes as $attribute)
		{
			if (in_array($attribute,self::$allowed_api_attributes))				
			{
				$method = (string)Str::of('get_'.$attribute.'_api_attribute')->camel();
				if (method_exists($this,$method))
				{
					$output[$attribute] = $this->$method();
				} 
				else
				{				
					if (isset($this->$attribute))
					{
						$output[$attribute] = $this->$attribute;		
					}
				}
			}
		}		


		return $output;
	}

	public static function setColumns()
    {   	
        
        if (!empty(Request::get('only')))
        {
            self::$api_attributes = array_merge(['id'],explode(',',Request::get('only')));

        } elseif (!empty(Request::get('columns')))
        {
            self::$api_attributes = array_merge(self::$default_api_attributes,explode(',',Request::get('columns')));
        }

        if (!empty(Request::get('except')))
        {
            if (count(self::$api_attributes)==0)
            {
                self::$api_attributes = self::$default_api_attributes;
            }
            
            self::$api_attributes = array_diff(self::$api_attributes,explode(',',Request::get('except')));
        }
        
    }
}