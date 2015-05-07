<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('img_url'))
{
	function img_url($key = '', $suffix = '')
	{
        $prefix = 'http://7xiyyf.com1.z0.glb.clouddn.com/';
		return $prefix . $key . $suffix;
	}
}
if ( ! function_exists('assets_url'))
{
	function assets_url($uri = '')
	{
		return $base_url($uri);
	}
}
