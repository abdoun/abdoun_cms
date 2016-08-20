<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
/**
 * @author 
 * @copyright  2012
 * @class results
 */
class results 
{
    protected $get="";
    protected $case="";
    protected $post="";
    protected $type = Array(1=>'مقالي',2=>'موضوعي');
    protected $status = Array(1=>'تعطيل',2=>'تفعيل');
    
    function __construct($arr='',$post='')
    {
        $this->get=$arr;
        $this->post=$post;
        if(!empty($this->get['event']))
        {
            $this->$arr['event']();
        }
        else
        {
            $this->browse();
        }
    }
    protected function get_members($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,name from members where active>1 order by name asc");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,name from members where id=$id");
            return $re[name][0];
        }        
    }
    protected function get_questions($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,question from questions where enabled>1 order by ordered asc");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,question from questions where id=$id");
            return $re['question'][0];
        }        
    }
    protected function get_answers($id='')
    {
        if($id=='')
        {
            $re=mysql_db::get_records_to_row("select id,answer from answers where enabled>1 order by ordered asc");
            return $re;
        }
        else
        {
            $re=mysql_db::get_records_by_key("select id,answer from answers where id=$id");
            return $re['answer'][0];
        }        
    }
    protected function get_type_question($id='')
    {
        if($id!='')
        {
            $re=mysql_db::get_records_by_key("select `type` from questions where id=$id");
            return $re['type'][0];
        }
        else
        {
            return 1;
        }
    }
    protected function get_member($id)
    {
        $re=mysql_db::get_records_by_key("select member from sessions where id=$id");
        return $this->get_members($re['member'][0]);
    }
    protected function get_spokesman($id)
    {
        $re=mysql_db::get_records_by_key("select spokesman from sessions where id=$id");
        return $this->get_members($re['spokesman'][0]);
    }
    protected function browse()
    {
        print('<h1 align="right">نتائج الاستبانات</h1>');
        //print('<p align="right"><a href="'.box::popup("page=".$this->get['page']."&class=".$this->get['class']."&event=form&from=".$this->post['form']).'">إضافة</a></p>');
        if(empty($this->post['session'])){$this->post['session']=$this->get['session'];}
        if($this->post['session']!=''){$sql.=" and `session`='".$this->post['session']."'";}
        //if($this->post['rec']>0){if($this->post['pages']==''){$this->post['pages']=0;}$limit.=" limit ".$this->post['rec']*$this->post['pages'].",".$this->post['rec']."";}
        $re=mysql_db::exec_query("select * from ".$this->get['page']." where 1=1 $sql order by id asc $limit")or print(mysql_error().print("select * from ".$this->get['page']." where 1=1 $sql order by id asc $limit")); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        $rec=mysql_db::exec_query("select id from ".$this->get['page']." where 1=1 $sql")or print(mysql_error().print("select * from ".$this->get['page']." where 1=1 $sql order by id asc $limit")); //mysql_query("select * from ".$this->get['page']." ")or print(mysql_error());
        print('<table style="border-style:solid;border-color:#c6;border-width: 1px;" dir="rtl" align="right">');
        print('<tr bgcolor="#a0a0a0"><td>المقيم</td><td>الناطق</td></tr>');
        print('<tr bgcolor="#f0f0f0"><td>'.$this->get_member($this->post['session']).'</td><td>'.$this->get_spokesman($this->post['session']).'</td></tr>');
        print('<tr bgcolor="#a0a0a0"><td colspan="2">&nbsp;</td></tr>');
        print('<tr bgcolor="#a0a0a0"><td>السؤال</td><td>الجواب</td></tr>');
        while($res=mysql_fetch_array($re))
        {
            if($this->get_type_question($res['question'])>1){$res['answer']=$this->get_answers($res['answer']);}
            print('<tr bgcolor="#f0f0f0"><td>'.$this->get_questions($res['question']).'</td><td>'.$res['answer'].'</td></tr>');
        }
    }
    protected function export_xls()
    {
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment;Filename=results.xls");
        header("Content-type: application/download");
        $re=mysql_db::get_records_by_key("select id from sessions where forms='".$this->get['form']."'");
        //$q=mysql_db::get_records_to_key("select id,question from questions where form='".$this->get['form']."' order by ordered");
        $q=mysql_db::get_records_by_key("select question from results where session='".$re['id'][0]."' order by id");
        echo'<table style="border: solid #333 1px;"><tr><td style="border: solid #333 1px;">-</td>';
        for($i=0;$i<count($q['question']);$i++)
        {
            echo '<td style="border: solid #333 1px;" bgcolor="#f0f0f0">'.$this->get_questions($q['question'][$i]).'</td>';
        }
        echo '</tr>';
        for($j=0;$j<count($re['id']);$j++)
        {
            echo '<tr><td style="border: solid #333 1px;">'.$re['id'][$j].'</td>';
            $res[$j]=mysql_db::get_records_by_key("select * from results where session='".$re['id'][$j]."' order by id");
            for($k=0;$k<count($res[$j]['id']);$k++)
            {
                if($this->get_type_question($res[$j]['question'][$k])>1){$res[$j]['answer'][$k]=$this->get_answers($res[$j]['answer'][$k]);}
                echo '<td style="border: solid #333 1px;">'.$res[$j]['answer'][$k].'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
    protected function act()
    {
        //print($this->get[page]);
        //print_r($this->post);
        if(empty($this->post['question']))
        {
            box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'عذراً لم تملأ الحقول الضرورية');
        }
        else
        {
            $this->post=mysql_db::remove_from_array($this->post,'submit');
            
            if(!mysql_db::add_edit_rec($this->get['page'],$this->post,$this->post['id']))
            {
                box::showSuccesMessage('main.php','&page='.$this->get['page'].'&class='.$this->get["class"],mysql_error());
            }
            else
            {
                box::showSuccesMessage('main.php','&page='.$this->get['page'].'&class='.$this->get["class"],'شكراً');
            }            
        }        
    }
    protected function delete()
    {
        if(!empty($this->get[id]))
        {
            if(!@mysql_query("delete from ".$this->get['page']." where id='".$this->get[id]."'"))
            {
                box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'عذراً لم يتم الحذف');
                //print(mysql_error());
            }
            else
            {
                box::showSuccesMessage('main.php','&page='.$this->get[page].'&class='.$this->get["class"],'شكراً تم الحذف بنجاح');
            }
        }        
        //$this->browse();        
    }
}?>