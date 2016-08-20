<?php
	if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class js
{
    function script()
    {
        ob_start();?>
        <script language="javascript" src="js/scripts/jquery.js" ></script>
        <script type="text/javascript">	
        	var _=jQuery.noConflict();
        </script>
        <script>var cssPath ="themes/"</script>
        <link href="js/themes/default.css" rel="stylesheet" type="text/css" /> 
        <link href="js/themes/alphacube.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/scripts/ajax_windows/prototype.js"></script>
        <script type="text/javascript" src="js/scripts/ajax_windows/effects.js"></script>
        <script type="text/javascript" src="js/scripts/ajax_windows/window.js"></script>
        <script type="text/javascript" src="js/scripts/ajax_windows/window_effects.js"></script>
        <script type="text/javascript" src="js/scripts/ajax_windows/debug.js"></script>
        <script type="text/javascript" src="js/scripts/ajax_windows/configrations.js"></script>
        <script language="javascript" src="js/scripts/Httprequest.class.js" ></script>
        <script language="javascript" src="js/scripts/js.js" ></script>
        <script language="javascript" src="js/scripts/javaScript.js" ></script>
        <script language="javascript" src="js/scripts/jscript.js" ></script>
        <?php
        $content=ob_get_contents();
        ob_end_clean();
        return $content;
    }
    function __construct()
    {
        $this->script();
    }
}?>