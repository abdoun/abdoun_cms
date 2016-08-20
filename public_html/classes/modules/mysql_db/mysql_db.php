<?php if(!defined('_PHP_DOT_PRO') || _PHP_DOT_PRO!='ebdbf06090f7fcd532551060tfb9a5543'){exit;}
class mysql_db
{
	protected $link;
    function __construct($dbname=Allconstants::_DB_NAME,$server=Allconstants::_DB_SERVER,$username=Allconstants::_DB_USERNAME,$password=Allconstants::_DB_PASSWORD)
    {
        $this->link=mysql_connect($server,$username,$password);
        mysql_query("set charset utf8");
        mysql_query("SET character_set_client=utf8");
        mysql_query("SET character_set_connection=utf8");
        mysql_query("SET character_set_database=utf8");
        mysql_query("SET character_set_results=utf8");
        mysql_query("SET character_set_server=utf8");
        mysql_select_db($dbname) or die(mysql_error());
    }
    public function get_records($query)
    {
       //$query=mysql_real_escape_string($query);
       $re=mysql_query("$query")or print(mysql_error()." 19 ");
       if(mysql_num_rows($re)>0)
    	{
    		while($res=mysql_fetch_row($re))
    		{
    			for($i=0;$i<count($res);$i++)
    			{
    				$arr[$i][]=$res[$i];
    			}
    		}    	
    	return $arr;
    	}
    	else
    	{
    	 return false;
    	}
    }
    public function get_records_to_row($query)
    {
       //$query=mysql_real_escape_string($query);
       $re=mysql_query("$query")or print(mysql_error()." 19 ");
       if(mysql_num_rows($re)>0)
    	{
    		while($res=mysql_fetch_row($re))
    		{    			
    			$arr[$res['0']]=$res['1'];
    		}    	
            return $arr;
    	}
    	else
    	{
    	 return false;
    	}
    }
    public function get_records_by_key($query)
    {
        //print("$query<br />");
        //$query=mysql_real_escape_string($query);
        //$re=mysql_query($query)or print(mysql_error()." 40 <br />$query<br />");
        $re=mysql_query($query);
        if(mysql_num_rows($re)>0)
    	{
    		while($res=mysql_fetch_array($re))
    		{
    			foreach($res as $key=>$value)
    			{
    			     if($key!='body')
                     {
                        $value=clean::burn($value);
                     }
                     $arr[$key][]=$value;
    			}
    		}    	
    	return $arr;
    	}
    	else
    	{
    	 return false;
    	}
    }
    public function get_records_by_keys($query)
    {
        //print("$query<br />");
        //$query=mysql_real_escape_string($query);
        $re=mysql_query($query)or print(mysql_error()." 40 ");
        if(mysql_num_rows($re)>0)
    	{
    		while($res=mysql_fetch_array($re))
    		{
    			foreach($res as $key=>$value)
    			{
    			     if($key!='body')
                     {
                        $value=clean::burn($value);
                     }
    				$arr[][$key]=$value;
    			}
    		}    	
    	return $arr;
    	}
    	else
    	{
    	 return false;
    	}
    }
    public function maxx($table,$field,$query='')
    {
        $table=mysql_real_escape_string($table);
        $field=mysql_real_escape_string($field);
        $query=mysql_real_escape_string($query);
         $no=mysql_fetch_row(mysql_query("select max($field) from $table $query"));
         return $no[0]+1;
    }
    public function get_rec_no($table)
    {
        //$table=mysql_real_escape_string($table);
	   $resultrec=mysql_query("select count(*) from $table") or die(mysql_error());
	   $resrec=mysql_fetch_row($resultrec);
			if(!$resrec[0])
            {
                return 0;
			}
			else
            {
				return $resrec[0];
			} 
    }
    public function delete_rec($table,$id,$query='')
    {
        $table=mysql_real_escape_string($table);
        $id=mysql_real_escape_string($id);
        $query=mysql_real_escape_string($query);
        if(!empty($table) && !empty($id))
        {
            //print("delete from $table where id='$id' $query<br />");
            if(!mysql_query("delete from $table where id='$id' $query"))
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }
    public function add_edit_rec($table,$arr,$id='',$query='')
    {
        $table=mysql_real_escape_string($table);
        $id=mysql_real_escape_string($id);
        $query=mysql_real_escape_string($query);
        if(!empty($table))
        {
            if(!empty($id))
            {
                $sql='update';$where="where id='$id'";
                $arr=self::remove_from_array($arr,'id');
            }
            else
            {
                $sql='insert into ';$where="";
            }
            if(is_array($arr) && count($arr)>0)
            {
                $table.=' set ';
                foreach($arr as $key=>$value)
                {
                    $value=mysql_real_escape_string($value);
                    $table.="`$key`='".$value."',";
                }
            }
            $table=substr($table,0,-1);
            if(!mysql_query("$sql $table $where $query"))
            {
                //print("<br />$sql $table $where $query<br />");
                return "$sql $table $where $query";
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }
    public function add_edit_rec_($table,$arr,$id='',$query='')
    {
        $table=mysql_real_escape_string($table);
        $id=mysql_real_escape_string($id);
        $query=mysql_real_escape_string($query);
        if(!empty($table))
        {
            if(!empty($id))
            {
                $sql='update';
                $where="where id=$id";
                $arr=self::remove_from_array($arr,'id');
            }
            else
            {
                $sql='insert into ';
                $where="";
            }
            if(is_array($arr) && count($arr)>0)
            {
                $table.=' set ';
                foreach($arr as $key=>$value)
                {
                    $value=mysql_real_escape_string($value);
                    if($key!='body')
                     {
                        $value=clean::burn($value);
                     }
                    $table.="`$key`=".$value.",";
                }
            }
            $table=substr($table,0,-1);
            if(!mysql_query("$sql $table $where $query"))
            {
                //print("<br />$sql $table $where $query<br />");
                return "$sql $table $where $query";
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }        
    public function exec_query($query)
    {
        if(!empty($query))
        {
            //$query=mysql_real_escape_string($query);
            return mysql_query($query);
        }
        else
        {
            return false;
        }
    }
    public function remove_from_array($arr,$element)
    {
        if(is_array($arr) && !empty($element))
        {
            foreach($arr as $key=>$value)
            {
                if($key!=$element)
                {
                    $arra[$key]=$value;
                }                
            }
            return $arra;
        }
        else
        {
            return false;
        }
    }
    public function close()
    {
        mysql_close($this->link);
    }
    //function __destruct()
//    {
//        $this->close();
//    }
}
?>