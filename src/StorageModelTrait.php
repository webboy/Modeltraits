<?php  
namespace Webboy\Modeltraits;

use Illuminate\Database\Eloquent\Model;

trait StorageModelTrait
{
	public function getFilePath($owner = null,$path_attributes = null)
	{		
		$path_attributes = !empty($path_attributes) ? $path_attributes : $this->path_attributes;

		if (empty($path_attributes))
		{
			return null;
		}

		$values = array();

		if (!empty($owner))
		{
			$values[] = $owner->getTable();
			$values[] = $owner->getKey();
		}

		foreach ($this->path_attributes as $key=>$val)
		{
			$values[] = $this->$val;
		}

		if (empty($values))
		{
			return null;
		}

		$path = '';

		foreach ($values as $key=>$value)
		{
			$path .= $value;

			if ($key != count($values)-1)
			{
				$path .= DIRECTORY_SEPARATOR;
			}
		}

		return $path;		
	}
}