<?php
if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class membership 
{
    public function get_id($username='')
    {
        if($username=='')
        {
            $username=$_SESSION['username'];
        }
        if($username!='')
        {
            $res=mysql_fetch_array(mysql_query("select id from members where username='$username'"));
            if(!empty($res['id']))
            {
                return $res['id'];
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    public function content_member($content,$username='')
    {//print($_SESSION['username'].'<br />');
        if($username=='')
        {
            $username=$_SESSION['username'];
        }
        $member=self::get_id($username);
        if($username!='' && $content!='')
        {
            $member_groups=mysql_query("select groups from groups_members where members='$member'");
            while($member_group=mysql_fetch_array($member_groups))
            {
                $content_groups=mysql_query("select news from groups_news where groups='".$member_group['groups']."'");
                while($content_group=mysql_fetch_array($content_groups))
                {
                    //print($content_group['news'].":".$content."<br />");
                    if($content==$content_group['news'])
                    {
                        return true;
                        break;
                    }
                }                
            }
        }
        return false;
    }
    public function forms_member($form,$username='')
    {//print($_SESSION['username'].'<br />');
        if($username=='')
        {
            $username=$_SESSION['username'];
        }
        $member=self::get_id($username);
        if($username!='' && $form!='')
        {
            $member_groups=mysql_query("select groups from groups_members where members='$member'");
            while($member_group=mysql_fetch_array($member_groups))
            {
                $form_groups=mysql_query("select forms from groups_forms where groups='".$member_group['groups']."'");
                while($form_group=mysql_fetch_array($form_groups))
                {
                    //print($content_group['news'].":".$content."<br />");
                    if($form==$form_group['forms'])
                    {
                        return true;
                        break;
                    }
                }                
            }
        }
        return false;
    }
}?>