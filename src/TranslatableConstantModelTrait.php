<?php  
namespace Webboy\Modeltraits;

trait TranslatableConstantModelTrait
{
	public static function loadData()
	{
		if (empty(self::$data))
		{
			$oClass = new \ReflectionClass(__CLASS__);

			$constants = $oClass->getConstants();

			foreach ($constants as $name=>$value)
			{
				self::$data[$value]['name'] = trans('constants.'.($oClass->getShortName()).'-'.$name);
				self::$data[$value]['slug'] = strtolower($name);
			}
		}

		return self::$data;
	}

	public static function selectData()
    {
        $data = self::loadData();
        $output = [];

        foreach ($data as $key => $val)
        {
            $output[$key] = $val['name'];
        }

        return $output;
    }
}
?>