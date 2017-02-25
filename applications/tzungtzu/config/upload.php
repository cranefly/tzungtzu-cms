<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['upload'] = array(
	'is_water' 					=> TRUE,
	'watermarkwidth' 			=> 200, 				//打水印图片的最小宽度
	'watermarkheight' 			=> 200, 				//打水印图片的最小高度
	'watermarkpct' 				=> 60, 					//0 - 100 水印透明度
	'watermarkquality'			=> 80, 					//0 - 100 水印质量
	'watermarkpos'				=> 3, 					//水印位置 0 - 5
	'watermarktype' 			=> 0, 					//水印类型 0=文字，1=图片
	'watermarkimg'				=>'/sytle/water.png', 	// 水印图片位置
	'watermarktext' 			=> 'TzungTzu', 			// 水印文字
	'watermarkfontsize' 		=> 12, 					// 文字大小
	'watermarkfontcolor' 		=> '#FFFF', 			// 文字颜色
	'water_mark_font_family' 	=> 'elephant.ttf', 		// 字体

	'is_thumb' 			=> TRUE,
	'thumbmaxwidth' 	=> '', 							// 缩略图最大宽度
	'thumbmaxheight' 	=> '', 							// 缩略图最大高度
	'thumbprefix' 		=> '', 							//图片名称修饰符
	'thumbpath' 		=> '', 							//缩略图图片路径
);