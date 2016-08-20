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

    

    //cache

    const _CACHE=1;

    

}

/**

 * inclusion

 * 

 * @package   

 * @author 

 * @copyright Admin

 * @version 2010

 * @access public

 */

class inclusion

{

    function get_conf_classes_folder($fold)

    {

        $folder=dir($fold);

        while($files=$folder->read())

        {

            if($files!="." && $files!=".." && $files!=".htaccess" && is_dir("$fold/".$files))

            {

                include_once("$fold/".$files.'/config.php');

                if($enable=='yes')

                {

                    $arr[$sort]="$files";

                }

                //$arr[]="$files";

            }

        }

        ksort($arr);

        if(count($arr)>0)

        {

            return $arr;

        }

    }

    function get_name_classes_folder($fold)

    {

        $folder=dir($fold);

        while($files=$folder->read())

        {

            if($files!="." && $files!=".." && $files!=".htaccess" && is_dir("$fold/".$files))

            {

              $arr[]="$files";

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

            include_once($filename);

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

        if(class_exists($get['type']))

        {

            if(!$post)

            {

                return New $get['type']($get);

            }

            else

            {

                return New $get['type']($get,$post);

            }

        }        

    }

    function construct_class_file_to_string($filename,$get,$post='')

    {

        include_once($filename);

        if(class_exists($get['type']))

        {

            ob_start();

            if(!$post)

            {

                $obj= New $get['type']($get);

            }

            else

            {

                $obj= New $get['type']($get,$post);

            }

            $content = ob_get_contents();

            ob_end_clean();

            return $content;

        }        

    }	

}

?>