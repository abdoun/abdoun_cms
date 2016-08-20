<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class block_
{
    function box_caption($title='',$body='')
    {
        ?><div class="art-block">
            <div class="art-block-tl"></div>
            <div class="art-block-tr"></div>
            <div class="art-block-bl"></div>
            <div class="art-block-br"></div>
            <div class="art-block-tc"></div>
            <div class="art-block-bc"></div>
            <div class="art-block-cl"></div>
            <div class="art-block-cr"></div>
            <div class="art-block-cc"></div>
            <div class="art-block-body">
                        <div class="art-blockheader">
                            <div class="l"></div>
                            <div class="r"></div>
                            <h3 class="t"><?=$title;?></h3>
                        </div>
                        <div class="art-blockcontent">
                            <div class="art-blockcontent-body">
                        <?=$body;?>                
                                        		<div class="cleared"></div>
                            </div>
                        </div>
        		<div class="cleared"></div>
            </div>
        </div><?php
    }
    function box_border($body='')
    {
        ?><div class="art-block">
            <div class="art-block-tl"></div>
            <div class="art-block-tr"></div>
            <div class="art-block-bl"></div>
            <div class="art-block-br"></div>
            <div class="art-block-tc"></div>
            <div class="art-block-bc"></div>
            <div class="art-block-cl"></div>
            <div class="art-block-cr"></div>
            <div class="art-block-cc"></div>
            <div class="art-block-body">
                        <div class="art-blockcontent">
                            <div class="art-blockcontent-body">
                        <?=$body;?>                
                                        		<div class="cleared"></div>
                            </div>
                        </div>
        		<div class="cleared"></div>
            </div>
        </div><?php
    }
}?>