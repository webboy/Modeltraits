<?php  
namespace Webboy\Modeltraits;

use Illuminate\Support\Facades\Input;

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
				$method = camel_case('get_'.$attribute.'_api_attribute');
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
        
        if (!empty(Input::get('only')))
        {
            self::$api_attributes = array_merge(['id'],explode(',',Input::get('only')));

        } elseif (!empty(Input::get('columns')))
        {
            self::$api_attributes = array_merge(self::$default_api_attributes,explode(',',Input::get('columns')));
        }

        if (!empty(Input::get('except')))
        {
            if (count(self::$api_attributes)==0)
            {
                self::$api_attributes = self::$default_api_attributes;
            }
            
            self::$api_attributes = array_diff(self::$api_attributes,explode(',',Input::get('except')));
        }
        
    }
}