<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class uri
{
    public function replace_after_q_mark($uri)
    {
        if(empty($uri))
        {
            return '';
        }
        else
        {
            $arr=explode('?',$uri);
            $arra=explode('&',$arr[1]);
            foreach($arra as $key=>$value)
            {
                $array=explode('=',$value);
                $url.=$array[1].'/';
            }
            //$url=substr($url,0,-1);
            //print($arr[0]);
            if($arr[0]!='index.php' && $arr[0]!='backup.php' && $arr[0]!=_INDEX_PAGE && $arr[0]!='')
            {
                
                return $uri;
            }
            else
            {
                $uri='http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].$url; 
            }
            $uri=str_replace('index.php','',$uri);
            $uri=str_replace('backup.php','',$uri);
            $uri=str_replace(_INDEX_PAGE,'',$uri);            
            $uri=str_replace('?','',$uri);
            return $uri;
        }
    }
    function get_text_uri($string,$pattern='/<a .* href="(.*)"/sU') 
    {
        //preg_match_all ('/<a\s+href[^>]+>([^<]+)<\/a>/', $string, $Matches);    
        preg_match_all ($pattern, $string, $Matches);
        for ($i=0;$i<count($Matches[1]);$i++) 
        {
            $string = str_replace($Matches[1][$i],self::replace_after_q_mark($Matches[1][$i]), $string);
        }
        return $string;
    }
}?>