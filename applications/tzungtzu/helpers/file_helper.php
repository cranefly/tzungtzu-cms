<?php 

/**
 * 创建文件夹
 * @param type $dir
 * @return boolean
 */
if (!function_exists('mkdirs'))
{
	function mkdirs($dir)
	{
		if (!is_dir($dir)) {
			if (!mkdirs(dirname($dir))) {
				return FALSE;
			}
			if (!mkdir($dir, 0777)) {
				return FALSE;
			}
		}  

		return TRUE;
	}
}

/* End of file file_helper.php */
/* Location: ./application/helpers/file_helper.php */