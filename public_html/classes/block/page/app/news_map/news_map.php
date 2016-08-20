<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2010
 * @class news_map
 **/
class news_map
{
    protected $params="";
    protected $case="";
    protected $post="";
    
    public function __construct($arr='',$post='')
    {
        $this->params=$arr;
        $this->post=$post;        
        if(!empty($this->params['event']))
        {
            $this->$arr['event']();
        }
        else
        {
            $this->browse();
        }
    }
    protected function template_include()
    {
        return inclusion::get_include_file(substr(__FILE__,0,-strlen(basename(__FILE__))).'/template/tpl.html');
    }
    protected function get_url($folder='')
    {
        $path=str_replace('\\','/',substr(__FILE__,0,-strlen(basename(__FILE__))).$folder.'/');
        $arr=explode('classes',$path);
        return 'classes/'.$arr[1];
    }
    protected function browse()
    {
        $html=$this->template_include();
        ob_start();
        $this->view();
        $content = ob_get_contents();
        ob_end_clean();
        echo str_replace('<content_tag />',($content),$html);
    }
    protected function view($iid='',$nbsp=-1)
    {
        ?><script type="text/javascript" src="http://rlcdamascus.com/map/jquery.maphilight.min.js.pagespeed.ce.lKjsi2gANH.js"></script>
        <script type="text/javascript">
            _(function() {
    		_('.map').maphilight();
        	});
        </script></p>
<p>إضغط على المكان لاستعراض آخر الأخبار</p>
<p><img class="map" src="http://rlcdamascus.com/map/Dammap_Web.jpg" usemap="#FPMap0" /></p>
<p>
<map name="FPMap0">
<area coords="616, 347, 612, 187, 623, 191, 718, 139, 721, 150, 728, 155, 646, 359" href="javascript://" shape="polygon" title="جوبر" id="jobar" />
<area coords="646, 360, 629, 410, 616, 421, 606, 421, 565, 350, 575, 337, 593, 343, 606, 343, 621, 351" href="javascript://" shape="polygon" title="دويلعة" id="dwaila" />
<area coords="557, 433, 587, 431, 599, 429, 608, 435, 614, 434, 622, 445, 652, 456, 648, 461, 630, 471, 609, 471, 596, 465, 579, 461, 569, 450" href="javascript://" shape="polygon" title="القزاز" id="qazzaz" />
<area coords="557, 434, 524, 428, 521, 470, 556, 472, 574, 520, 578, 545, 633, 539, 604, 469, 594, 467, 581, 464, 572, 457, 563, 443" href="javascript://" shape="polygon" title="دف الشوك" id="daf_shok" />
<area coords="576, 547, 500, 487, 503, 481, 513, 479, 521, 470, 556, 470, 569, 505, 576, 525" href="javascript://" shape="polygon" title="التضامن" id="tadhamon" />
<area coords="574, 549, 586, 563, 566, 570, 556, 586, 540, 587, 521, 557, 558, 551, 565, 541" href="javascript://" shape="polygon" title="حي الزهور" id="zouhour" />
<area coords="501, 487, 565, 539, 561, 549, 524, 557, 517, 544" href="javascript://" shape="polygon" title="مخيم فلسطين" id="palestine" />
<area coords="477, 490, 477, 551, 488, 551, 491, 486" href="javascript://" shape="polygon" title="شارع الثلاثين" id="thirty_st" />
<area coords="491, 485, 490, 552, 495, 559, 522, 557, 516, 546, 502, 489" href="javascript://" shape="polygon" title="مخيم اليرموك" id="yarmouk" />
<area coords="473, 587, 482, 580, 480, 568, 488, 554, 496, 560, 522, 558, 541, 587" href="javascript://" shape="polygon" title="الحجر الأسود" id="black_stone" />
<area coords="128, 586, 169, 510, 379, 505, 347, 587" href="javascript://" shape="polygon" title="داريا"  id="daria" />
<area coords="189, 510, 225, 439, 311, 432, 321, 396, 336, 397, 349, 356, 374, 319, 397, 324, 460, 387, 455, 421, 404, 426, 415, 444, 359, 483, 364, 501, 378, 504" href="javascript://" shape="polygon" title="كفرسوسة" id="kafarsouseh" />
<area coords="403, 586, 403, 574, 409, 558, 428, 520, 440, 505, 451, 496, 413, 587" href="javascript://" shape="polygon" title="العسالي" id="esaly" />
<area coords="402, 586, 404, 572, 414, 549, 412, 550, 426, 521, 445, 501, 455, 489, 461, 470, 452, 464, 451, 453, 456, 423, 439, 443, 430, 456, 417, 488, 407, 518, 400, 541, 397, 562, 385, 587" href="javascript://" shape="polygon" title="القدم" id="qadam" />
<area coords="225, 440, 168, 442, 178, 400, 216, 372, 200, 365, 193, 347, 242, 327, 267, 325, 280, 326, 293, 308, 334, 301, 391, 303, 398, 322, 375, 320, 351, 351, 338, 394, 325, 397, 310, 432" href="javascript://" shape="polygon" title="المزة" id="mazzeh" />
<area coords="180, 249, 172, 258, 158, 265, 156, 255, 141, 267, 128, 270, 112, 267, 83, 287, 71, 280, 67, 266, 79, 247, 91, 230, 148, 196, 202, 168, 217, 168, 221, 212, 213, 216, 210, 224, 185, 236" href="javascript://" shape="polygon" title="مشروع دمر" id="dummar_ project" />
<area coords="255, 177, 273, 160, 277, 138, 265, 130, 247, 140, 207, 139, 195, 155, 202, 168, 218, 169, 220, 216, 221, 221, 235, 228, 245, 220, 250, 220, 257, 173" href="javascript://" shape="polygon" title="دمر البلد" id="dummar" />
<area coords="236, 247, 219, 246, 203, 251, 188, 255, 182, 249, 185, 238, 210, 228, 212, 217, 218, 212, 222, 216, 222, 219, 237, 226, 243, 222, 247, 228, 244, 239" href="javascript://" shape="polygon" title="وادي المشاريع" id="projects_valley" />
<area coords="148, 133, 134, 106, 126, 81, 109, 73, 89, 83, 83, 147, 98, 169, 125, 188, 147, 198, 201, 165, 196, 155, 191, 157, 188, 156, 179, 137, 163, 133, 156, 142" href="javasript://" shape="polygon" title="قدسيا" id="qudsaya" />
<area coords="0, 121, 13, 116, 25, 129, 53, 102, 85, 105, 86, 141, 64, 178, 0, 227" href="javascript://" shape="polygon" title="ضاحية قدسيا" id="qudsaya_suburb" />
<area coords="145, 0, 181, 49, 150, 132, 136, 114, 127, 85, 125, 78, 110, 71, 81, 57, 32, 61, 0, 54, 0, 0" href="javascript://" shape="polygon" title="الهامة" id="hameh" />
<area coords="717, 139, 736, 117, 740, 105, 704, 79, 675, 70, 636, 72, 632, 84, 613, 105, 611, 182, 622, 188" href="javascript://" shape="polygon" title="القابون" id="qabun" />
<area coords="612, 103, 633, 83, 636, 72, 675, 71, 685, 46, 663, 10, 639, 9, 632, 63, 608, 89" href="javascript://" shape="polygon" title="حي تشرين" id="teshreen" />
<area coords="525, 7, 552, 28, 571, 58, 578, 61, 599, 66, 607, 88, 634, 59, 638, 11, 620, 2, 546, 0" href="javascript://" shape="polygon" title="برزة" id="barzeh" />
<area coords="605, 92, 613, 108, 612, 158, 575, 165, 563, 149, 530, 133" href="javascript://" shape="polygon" title="مساكن برزة" id="masaken_barzeh" />
<area coords="510, 198, 507, 242, 549, 225, 612, 184, 612, 159, 576, 162, 574, 162, 565, 149, 529, 132, 522, 180" href="javascript://" shape="polygon" title="بساتين أبو جرش" id="abu_jarash" />
<area coords="518, 109, 432, 186, 453, 199, 457, 210, 471, 213, 495, 199, 509, 197, 523, 179, 529, 134" href="javascript://" shape="polygon" title="ركن الدين" id="rukn_addin" />
<area coords="347, 586, 381, 505, 361, 499, 358, 484, 417, 443, 405, 426, 455, 422, 432, 454, 419, 481, 401, 532, 397, 564, 387, 587" href="javascript://" shape="polygon" title="نهر عيشة" id="aisheh" />
<area coords="505, 388, 493, 485, 501, 486, 502, 483, 517, 481, 522, 471, 525, 391, 512, 394" href="javascript://" shape="polygon" title="الزاهرة" id="zahera" />
<area coords="474, 383, 461, 470, 461, 489, 494, 482, 505, 389" href="javascript://" shape="polygon" title="الميدان" id="miedan" />
<area coords="460, 381, 473, 381, 463, 471, 451, 463" href="javascript://" shape="polygon" title="شارع خالد بن الوليد" id="khaled_waleed" />
<area coords="300, 261, 308, 274, 327, 276, 350, 270, 368, 265, 374, 267, 399, 261, 418, 265, 425, 257, 443, 245, 428, 238, 414, 208, 397, 216, 365, 242, 337, 253" href="javascript://" shape="polygon" title="المهاجرين" id="muhajreen" />
<area coords="414, 207, 431, 186, 454, 200, 460, 210, 454, 234, 444, 245, 429, 238" href="javascript://" shape="polygon" title="الصالحية" id="salhyeh" />
<area coords="350, 272, 381, 302, 391, 302, 400, 262, 376, 268, 366, 265" href="javascript://" shape="polygon" title="المالكي" id="malki" />
<area coords="447, 305, 417, 264, 402, 261, 391, 301, 395, 310" href="javascript://" shape="polygon" title="أبو رمانة" id="abu_rummaneh" />
<area coords="448, 329, 457, 329, 463, 338, 460, 382, 397, 323, 395, 309, 445, 306" href="javascript://" shape="polygon" title="البرامكة" id="baramkeh" />
<area coords="475, 352, 474, 382, 461, 382, 462, 354" href="javascript://" shape="polygon" title="قبر عاتكة" id="qabr_atka" />
<area coords="504, 383, 568, 354, 574, 364, 525, 390, 509, 394" href="javascript://" shape="polygon" title="الصناعة" id="senaa" />
<area coords="476, 319, 477, 350, 463, 351, 462, 339" href="javascript://" shape="polygon" title="الفحامة" id="fahameh" />
<area coords="474, 304, 479, 319, 463, 338, 457, 329, 446, 327, 443, 309" href="halbouni" shape="polygon" title="الحلبوني" id="halbouni" />
<area coords="506, 363, 475, 366, 474, 382, 505, 387" href="javascript://" shape="polygon" title="المجتهد" id="mujtahed" />
<area coords="497, 327, 476, 327, 475, 365, 506, 361, 506, 351, 504, 341" href="qanawat" shape="polygon" title="القنوات" id="qanawat" />
<area coords="476, 328, 478, 320, 474, 305, 500, 306, 500, 325, 476, 324, 475, 322" href="javascript://" shape="polygon" title="باب سريجة" id="bab_sryjeh" />
<area coords="565, 350, 506, 383, 505, 349" href="shaghour" shape="polygon" title="الشاغور" id="shaghour" />
<area coords="506, 242, 509, 199, 494, 203, 474, 212, 471, 223, 480, 238" href="javascript://" shape="polygon" title="الفيحاء" id="faiha" />
<area coords="455, 236, 457, 212, 475, 211, 471, 224, 482, 238, 468, 253" href="javascript://" shape="polygon" title="الميسات" id="misat" />
<area coords="458, 243, 450, 260, 444, 247, 454, 237" href="javascript://" shape="polygon" title="الجسر الأبيض" id="white_bridge" />
<area coords="460, 245, 467, 252, 453, 264, 451, 259" href="javascript://" shape="polygon" title="الطلياني" id="telyani" />
<area coords="430, 283, 419, 265, 442, 246, 452, 265" href="javascript://" shape="polygon" title="الروضة" id="rawda" />
<area coords="610, 186, 571, 212, 547, 226, 552, 233, 556, 273, 580, 250, 606, 212, 613, 187" href="javascript://" shape="polygon" title="التجارة" id="tejarah" />
<area coords="612, 191, 606, 215, 589, 237, 582, 249, 584, 267, 613, 255, 614, 187" href="javascript://" shape="polygon" title="العباسيين" id="abbasyeen" />
<area coords="615, 349, 608, 344, 594, 342, 579, 335, 579, 316, 588, 286, 585, 267, 615, 256" href="javascript://" shape="polygon" title="الزبلطاني" id="zablatani" />
<area coords="580, 250, 551, 280, 588, 288" href="javascript://" shape="polygon" title="القصاع" id="qassaa" />
<area coords="555, 273, 556, 230, 550, 224, 508, 242, 504, 266" href="javascript://" shape="polygon" title="العدوي" id="adawi" />
<area coords="502, 267, 500, 274, 549, 281, 558, 275" href="javascript://" shape="polygon" title="شارع بغداد" id="baghdad" />
<area coords="585, 289, 549, 281, 533, 279, 533, 297, 583, 299, 589, 286" href="javascript://" shape="polygon" title="باب السلام" id="bab_assalam" />
<area coords="505, 244, 501, 273, 480, 270, 468, 254, 483, 239" href="javascript://" shape="polygon" title="المزرعة" id="mazraa" />
<area coords="451, 269, 430, 284, 448, 305, 475, 303, 475, 293, 465, 280, 460, 284" href="javascript://" shape="polygon" title="الشعلان" id="shalan" />
<area coords="473, 293, 465, 282, 460, 283, 448, 269, 466, 253, 478, 269, 476, 293" href="javascript://" shape="polygon" title="بوابة الصالحية" id="salhyeh_gate" />
<area coords="475, 272, 476, 304, 500, 305, 500, 273, 480, 269, 478, 270, 478, 276, 479, 270" href="javascript://" shape="polygon" title="ساروجة" id="sarouja" />
<area coords="578, 331, 580, 337, 565, 351, 562, 350, 562, 331" href="javascript://" shape="polygon" title="باب شرقي" id="bab_sharqi" />
<area coords="582, 308, 579, 315, 581, 330, 562, 332, 560, 309" href="javascript://" shape="polygon" title="باب توما" id="bab_touma" />
<area coords="561, 309, 562, 330, 537, 331, 535, 321, 523, 321, 522, 308" href="javascript://" shape="polygon" title="القيمرية" id="qaimaryeh" />
<area coords="532, 299, 586, 299, 583, 305, 520, 309, 520, 320, 533, 319, 535, 331, 560, 332, 562, 350, 507, 349, 506, 343, 498, 327, 499, 306, 500, 273, 533, 277" href="javascript://" shape="polygon" title="دمشق القديمة" id="old_city" />
<area coords="569, 54, 519, 108, 528, 131, 608, 88, 602, 64, 574, 57, 572, 53" href="javascript://" shape="polygon" title="حاميش" id="hamish" />
<area coords="253, 209, 273, 215, 282, 220, 287, 225, 292, 232, 293, 242, 295, 244, 303, 252, 324, 256, 312, 257, 303, 262, 308, 271, 313, 274, 324, 276, 338, 273, 348, 272, 382, 300, 364, 299, 343, 300, 319, 303, 301, 305, 296, 282, 285, 280, 272, 276, 266, 270, 255, 262, 254, 258, 253, 249, 244, 237, 248, 226, 245, 219, 251, 212" href="javascript://" shape="polygon" title="الربوة" id="rabweh" />
<area coords="604, 434, 597, 429, 592, 429, 587, 431, 560, 433, 524, 427, 523, 392, 575, 363, 604, 418, 609, 419, 608, 431, 607, 433" href="javascript://" shape="polygon" title="بستان الدور" id="bustan_addour" /></map></p>
<div dir="ltr<?=_DIR;?>" style="padding: 5px;text-align: <?_ALIGN_?>;" id="news_div"></div>
<script type="text/javascript">
_('area').click(function(){
    _('#news_div').html('<div style=\'width:30%;margin-right:auto;margin-left:auto;text-align:center\'><img src=\'http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>upload/ajax_loader_gray_64.gif\' border=\'0\'/></div>');
});
_('#daria').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=99&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#barzeh,#hamish').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=41&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#teshreen').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=42&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#qabun').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=43&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#jobar').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=44&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#masaken_barzeh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=45&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#abujarash').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=46&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#tejarah').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=47&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#abbasyeen').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=48&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#adawi').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=49&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#rukn_addin').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=50&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#zablatani').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=51&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#qassaa').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=52&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#dwaila').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=53&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#faiha').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=54&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#baghdad').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=55&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#mazraa').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=56&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#salhyeh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=57&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#misat').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=58&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#bab_assalam').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=59&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#qaimaryeh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=60&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#touma').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=61&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#old_city').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=62&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#bustan_addour').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=63&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#qazzaz').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=64&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#senaa').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=65&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#shaghour').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=66&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#qanawat').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=67&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#mujtahed').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=68&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#muhajreen').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=69&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#telyani').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=70&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#malki').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=71&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#abu_rummaneh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=72&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#salhyeh_gate').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=73&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#white_bridge').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=74&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#daf_shok').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=75&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#zahera').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=76&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#miedan').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=77&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#khaled_waleed').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=79&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#bab_sryjeh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=80&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#sarouja').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=81&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#qabr_atka').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=82&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#fahameh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=83&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#shalan').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=84&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#rawda').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=85&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#baramkeh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=86&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#halbouni').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=87&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#kafarsouseh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=88&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#mazzeh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=89&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#aisheh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=90&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#qadam').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=91&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#tadhamon').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=92&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#zouhour').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=93&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#black_stone').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=94&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#thirty_st').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=95&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#yarmouk').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=96&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#palestine').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=97&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#esaly').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=98&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#rabweh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=100&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#projects_valley').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=101&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#dummar').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=102&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#dummar_project').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=103&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#qudsaya').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=104&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#qudsaya_suburb').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=105&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#hameh').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=106&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
_('#bab_sharqi').click(function(){
    _.get('http://<?=$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,-strlen(_INDEX_PAGE));?>classes/block/page/ajax.php?d='+new Date().getTime()+'&l=2&id=371&type=news&page=content&event=0&q_sec=&town=107&news_type=&_date_from=&_date_to=',function(data){_('#news_div').html(data);});    
});
</script>
<?php
    }
}?>