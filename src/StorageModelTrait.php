<?php  
namespace Webboy\Modeltraits;

use File;

trait StorageModelTrait
{
	public function getFilePath($owner = null, $identifier='id',$filename='filename')
	{
		if (!isset($this->$identifier) || !isset($this->$filename))
		{
			return false;
		}

		if (!empty($owner))
		{
			$path = storage_path($owner->getTable().DIRECTORY_SEPARATOR.$owner->$identifier.DIRECTORY_SEPARATOR.$this->table.DIRECTORY_SEPARATOR.$this->$filename);
		} else {
			$path = storage_path($this->table.DIRECTORY_SEPARATOR.$this->$identifier.DIRECTORY_SEPARATOR.$this->$filename);
		}
		
		
		if(!File::exists($path))
		{
			return false;
		}			
		return $path;		
	}
}
?>