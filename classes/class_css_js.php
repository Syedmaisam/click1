<?php
if ( ! function_exists('JsCss'))
{
	function JsCss($argArrData)
	{
            $str = "";
            foreach($argArrData['css'] AS $item){
                $str .= '<link rel="stylesheet" href="'.SITE_ROOT_URL.$item.'" type="text/css" />'."\n";
            }

            foreach($argArrData['js'] AS $item){
                $str .= '<script type="text/javascript" src="'.SITE_ROOT_URL.$item.'"></script>'."\n";
            }
            return $str;
	}
}