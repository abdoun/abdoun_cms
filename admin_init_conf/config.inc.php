<?php if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}?>
<?
/**
 * Allconstants
 * 
 * @package   
 * @author 
 * @copyright Admin
 * @version 2010
 * @access public
 */
class Allconstants
{
    const _DB_NAME='framework';
    const _DB_SERVER='localhost';
    const _DB_USERNAME='root';
    const _DB_PASSWORD='';
    
    // FTP Setting
    const _FTP_SERVICE='';
    const _FTP_SERVER='';
    const _FTP_USER_NAME='';
    const _FTP_USER_PASS='';
    
}
/**
 * inclusion
 * 
 * @package   
 * @author 
 * @copyright Admin
 * @version 
 * @access public
 */
class inclusion
{
    function get_name_classes_folder($fold)
    {
        $folder=dir($fold);
        while($files=$folder->read())
        {
            if($files!="." && $files!=".." && $files!=".htaccess" && is_dir("$fold/".$files))
            {
              $arr["$files"]="$files";
            }
        }
        if(count($arr)>0)
        {
            return $arr;
        }
    }
    function include_classes_folder($fold)
    {
        $folder=dir($fold);
        while($files=$folder->read())
        {
            if($files!="." && $files!=".." && $files!=".htaccess" && is_dir("$fold/".$files))
            {
              require_once($fold.'/'.$files.'/'.$files.'.php');
            }
        }
    }
    function construct_classes_folder($fold)
    {
        $folder=dir($fold);
        while($files=$folder->read())
        {
            if($files!="." && $files!=".." && $files!=".htaccess" && is_dir("$fold/".$files))
            {
              require_once($fold.'/'.$files.'/'.$files.'.php');
              if(class_exists("$files"))
              {
                $obj[$files]= new $files();
                //global $$files= new $files();
              }
            }
        }
        return $obj;
    }
    function get_include_contents($filename) 
    {
        if (is_file($filename)) {
            ob_start();
            include $filename;
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;
        }
        return false;
    }
    function get_include_file($filename) 
    {
        if(is_file($filename))
        {
            return file_get_contents($filename);
        }
        return false;
    }
    function construct_class_file($filename,$get,$post='')
    {
        include_once($filename);
        if(class_exists($get['class']))
        {
            if(!$post)
            {
                return New $get['class']($get);
            }
            else
            {
                return New $get['class']($get,$post);
            }
        }        
    }
    function construct_class_file_config($folder,$filename,$get,$post='')
    {
        include_once($folder.'/'.$filename.'/config.php');
        $perm=perm::get_perm_user(perm::get_id_user());
        if($perm===false)
        {
            $perm='user';
        }
        if(in_array($perm,$app_perm))
        {
            self::construct_class_file($folder.'/'.$filename.'/'.$filename.'.php',$get,$post);
        }
        else
        {
            print('you have not a permission');
        }
                
    }	
}
?>