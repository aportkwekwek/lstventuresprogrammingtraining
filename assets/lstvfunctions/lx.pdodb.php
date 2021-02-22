<?php
    function PDO_InsertRecord(&$link_id,$tablename,$record_parameters,$debug=false){

        if(!is_array($record_parameters)){

            if ( $debug ){
                echo "No supplied parameters.<br>";
            }

            return false;
        }
        
        $arr_qry_params = array();
        $i=0;
        foreach($record_parameters as $field_value){
            if(get_magic_quotes_gpc()){
                $arr_qry_params[$i++]=stripslashes($field_value);                
            }else{
                $arr_qry_params[$i++]=$field_value;                           
            }
        }        
        
        $fields = " ";
        $values = " ";
        
        foreach($record_parameters as $field => $value){
            $fields.="$field,";
            $values.='?,';
        }
        
        $xlen = strlen($fields)-1;
        $fields[$xlen] = " ";
        $fields = trim($fields);        
        
        $xlen = strlen($values)-1;
        $values[$xlen] = " ";
        $values = trim($values);      

         //20190611 donita
        $fields = rtrim($fields,",");
        $values = rtrim($values,",");    
        
        $xqry = "INSERT INTO $tablename ($fields) VALUES($values);";
		// var_dump($xqry);
        $stmt = $link_id->prepare($xqry);
        $stmt->execute($arr_qry_params);
	
        if ( $debug ){
            echo '<hr><br>Statement : <br>';
            var_dump($stmt);
            echo '<br>Error Information<br>';
            var_dump($stmt->errorInfo());
            echo '<br>Parameters<br>';
            var_dump($arr_qry_params);
        }

        return true;

    }
    
    function PDO_UpdateRecord(&$link_id,$tablename,$record_parameters,$condition=' true ',$condition_parameters,$debug=false){
        
        $args = '';
        $i=0;
        
        $update_parameters = array();
        
        foreach($record_parameters as $field => $value){
        
            if(get_magic_quotes_gpc()){
                $update_parameters[$i++]=stripslashes($value);
            }else{
                $update_parameters[$i++]=$value;
            }
            $args.="$field=?,";
            
        }
        
        $xlen = strlen($args)-1;
        $args[$xlen] = " ";
        $args = trim($args);    

         //20190611 donita
        $args = rtrim($args,",");      

        if(is_array($condition_parameters)){
            foreach($condition_parameters as $field => $value){
            
                if(get_magic_quotes_gpc()){
                    $update_parameters[$i++]=stripslashes($value);
                }else{
                    $update_parameters[$i++]=$value;
                }
            }
        }        
       
        $xqry = "UPDATE $tablename SET $args WHERE $condition";

        $stmt = $link_id->prepare($xqry);
        $stmt->execute($update_parameters);

        if ( $debug ){
            echo '<hr><br>Statement : <br>';
            var_dump($stmt);
            echo '<br>Error Information<br>';
            var_dump($stmt->errorInfo());
            echo '<br>Parameters<br>';
            var_dump($update_parameters);
        }

        return true;
        
    }

//    function PDO_UserActivityLog2( $x_param_activity , $x_param_remarks , $x_param_webpage = '' )
//    {
//        global $link_id, $xg_appkey; //PDO Connection
//        @session_start();
//        //$link_id->debug=true;
//
//        if ( trim($x_param_webpage)=="" )
//        {
//            $x_param_webpage = $_SERVER['PHP_SELF'];
//        }
//
//        @session_start();
//
//        $x_param_webpage = strrchr($x_param_webpage,"/");
//
//        $x_param_webpage = trim($x_param_webpage);
//
//        $x_param_activity = trim($x_param_activity);
//
//        $x_param_remarks = trim($x_param_remarks);
//
//        //$rsPar=$link_id->Execute("SELECT * FROM system_parameters LIMIT 1;");
//        $xsql = "SELECT * FROM system_parameters LIMIT 1";
//        $stmt = $link_id->prepare($xsql);
//        $stmt->execute();
//
//        $xMaxRec = "99999999999";
//        if ( $rs = $stmt->fetch() )
//        {
//            $xMaxRec = $rs['userlogmaxrec'];
//        }        
//
//        $x_qry_log = 'INSERT INTO user_activities (usrcde,usrname,usrdte,usrtim,activity,remarks,webpage,module) ' .
//                     'VALUES (?,?,?,?,?,?,?,?);';
//
//        $xfullname = '';
//        $xusrcde = '';
//
//        if ( isset($_SESSION[$xg_appkey]['fullname']) )
//        {
//            $xfullname = trim($_SESSION[$xg_appkey]['fullname']);
//        }
//
//        if ( isset($_SESSION[$xg_appkey]['usrcde']) )
//        {
//            $xusrcde = trim($_SESSION[$xg_appkey]['usrcde']);
//        }
//
//        $arr_qry_params = array(
//                                  trim($xusrcde),
//                                  trim($xfullname),
//                                  date('Y-m-d H:i:s'),
//                                  time('H:i:s'),
//                                  $x_param_activity,
//                                  $x_param_remarks,
//                                  $x_param_webpage,
//                                  trim($xg_appkey)
//                                  );
//
//
//        $stmt_ual = $link_id->prepare( $x_qry_log );
//        $stmt_ual->execute( $arr_qry_params );        
//
//	$stmt_cnt = $link_id->prepare("select count(*) as xcount from user_activities WHERE module='" . trim($xg_appkey) .  "'");
//	$stmt_cnt->execute();
//	if ( $rs_cnt=$stmt_cnt->fetch() )
//	{
//	   if( $rs_cnt['xcount'] && $rs_cnt['xcount'] > $xMaxRec )
//	   {
//	       $xExcess= $rs_cnt["xcount"]-$xMaxRec;
//
//	       $xqry = "DELETE FROM user_activities WHERE module='" . trim($xg_appkey) .  "' ORDER BY id LIMIT $xExcess";
//
//	       $stmt_del = $link_id->prepare( $xqry );
//	       $stmt_del->execute();
//
//	       PDO_Refreshid("user_activities");
//
//	   }
//	}
//    }

    function PDO_setFieldDefaults()
    {
        
    }
	
    function PDO_Refreshid($par_tablename)
    {
        global $link_id;
        $xcount=0;

        $xqry = "SELECT recid FROM $par_tablename ORDER BY recid";
        $stmt = $link_id->prepare( $xqry );
        $stmt->execute();
        
        while( $rs = $stmt->fetch() )
        {
            $xcount=$xcount+1;

            $xqry = "UPDATE $par_tablename SET recid=? WHERE recid=? ";
            $stmt_upt = $link_id->prepare( $xqry );

            $arr_qry_params = array( $xcount , $rs['recid'] );

            $stmt_upt->execute( $arr_qry_params );
        }

        $xcount++;

        $xqry = "ALTER TABLE $par_tablename AUTO_INCREMENT = $xcount";
        $stmt_upt = $link_id->prepare( $xqry );
        $stmt_upt->execute();
        
    }
    
    
    function UserAct($xactivity,$xremarks, $xparam, $xwebpage)
    {
    	global $link_id,$xg_appkey;
    	
    	$xquery = "SELECT * FROM syspar2";

    	$xstmt = $link_id->prepare($xquery);
    	$xstmt->execute();
    	$xrs = $xstmt->execute();

    	$maxcount = $xrs['userlogmaxrec'];
    	if($maxcount == "")
    	{
    	    $maxcount = "10000";
    	}
    	$xarr_rec = array();
    	
    	$xqry_getname = "SELECT usrname FROM userfile WHERE usrcde = ?";
    	$xstmt_getname = $link_id->prepare($xqry_getname);
    	$xstmt_getname->execute(array($_SESSION[$xg_appkey]['usrcde']));
    	$xrs_getname = $xstmt_getname->fetch();
    	$xarr_rec['usrname'] = $xrs_getname['usrname'];
    	$xarr_rec['usrcde'] = $_SESSION[$xg_appkey]['usrcde'];
    	$xarr_rec['usrdte'] = date("Y-m-d H:i:s");
    	$xarr_rec['usrtim'] = date("g:i A");
    	$xarr_rec['trndte'] = $xarr_rec['usrdte'];
    	$xarr_rec['module'] = "PAY";
    	$xarr_rec['activity'] = $xactivity;
    	$xarr_rec['remarks'] = $xremarks;
    	$xarr_rec['parameter'] = $xparam;
    	$xarr_rec['webpage'] = $xwebpage;
    	// var_dump($xarr_rec);
    	PDO_InsertRecord( $link_id,'useractivitylogfile',$xarr_rec, false);
    	// var_dump("pass");
    	// $qry_chkcount = "SELECT count(*) as xcount FROM useractivitylogfile";
    	// $stmt_chkcount = $link_id->prepare($qry_chkcount);
    	// $stmt_chkcount->execute();
    	// $rs_chkcount = $stmt_chkcount->fetch();
    	// if($rs_chkcount>$maxcount)
    	// {
    	//     $xecess = $rs_chkcount['xcount'] - $maxcount;
    	//     $xqry_del = "DELETE FROM useractivitylogfile LIMIT $xecess";
    	//     $xstmt_del = $link_id->prepare($xqry_del);
    	//     $xstmt_del->execute();
    	//     PDO_Refreshid("useractivitylogfile");
    	// }
    }
    
    function PDO_HRIS_ActivityLog($link_id,$params,$xusrcde)
    {
		// PDO_InsertRecord( $link_id,'activitylog',$params, false);
		// $xqry="select userlogmaxrec from syspar";
		// $xstmt=$link_id->prepare($xqry);
		// $xstmt->execute();
		// $xrow=$xstmt->fetch();
		// $maxcount = $xrow['userlogmaxrec'];
		// $qry_chkcount = "SELECT count(*) as xcount,min(recid) as minid FROM activitylog";
		// $stmt_chkcount = $link_id->prepare($qry_chkcount);
		// $stmt_chkcount->execute();
		// $rs_chkcount = $stmt_chkcount->fetch();
		// if($rs_chkcount['xcount']==$xrow['userlogmaxrec'])
		// {
			// $xminid=$rs_chkcount['minid']-1;
			// $xlstdelid=$xminid+1001;
			// $xqry_del = "DELETE FROM activitylog where recid between ? and ?";
			// $xstmt_del = $link_id->prepare($xqry_del);
			// $xstmt_del->execute(array($xminid,$xlstdelid));
			// PDO_Refreshid("activitylog");
		// }
		PDO_InsertRecord($link_id,"activitylog",$params,false);
		// var_dump($params);
		// die();
        $xsql = "SELECT * FROM syspar";
        $stmt = $link_id->prepare($xsql);
        $stmt->execute();

        $xMaxRec = "1000";
        if ( $rs = $stmt->fetch() )
        {
            $xMaxRec = $rs['userlogmaxrec'];
        }

        $stmt_cnt = $link_id->prepare("select count(*) as xcount,min(recid) as minid from activitylog");
         $stmt_cnt->execute();
         if ( $rs_cnt=$stmt_cnt->fetch() )
         {
            if( $rs_cnt['xcount'] && $rs_cnt['xcount'] > $xMaxRec )
            {
                $xminid= $rs_cnt["minid"]-1;
                $xlastdeleteid= $xminid+1000;
                $xqry = "DELETE FROM activitylog WHERE recid between ? and ? and usrcde= ?";

                $stmt_del = $link_id->prepare( $xqry );
                $arr_qry_params = array( $xminid , $xlastdeleteid, $xusrcde);
                $stmt_del->execute($arr_qry_params);

                PDO_Refreshid("activitylog");

            }
         }
    }
    
   function PDO_UserActivityLog($link_id, $xtablename , $xfullname1 , $xusrcde , $xactivity , $xremarks, $xwebpage , $xaction , $xprog_module , $xsuccess = true ,$xnewval='',$xoldval='',$xfield='')
    {
        $xquery = "SELECT userlogmaxrec FROM syspar2";
        $xstmt = $link_id->prepare($xquery);
        $xrs = $xstmt->execute();

        $maxcount = $xrs['userlogmaxrec'];
        if($maxcount == "")
        {
            $maxcount = "10000";
        }
        //~ var_dump($maxcount);die();
        $xarr_rec = array();
        $xarr_rec['usrname'] = $xusrcde;
        $xarr_rec['empcode'] = $xusrcde;
        $xarr_rec['usrcde'] = $xusrcde;
        $xarr_rec['fullname'] = $xfullname1;
        $xarr_rec['usrdte'] = date("Y-m-d");
        $xarr_rec['logdte_client'] = date("Y-m-d H:i:s");
        $xarr_rec['logdte_server'] = date("Y-m-d H:i:s");
        $xarr_rec['usrtim'] = date("H:i:s");
        $xarr_rec['module'] = $xprog_module;
        $xarr_rec['activity'] = $xactivity;
        $xarr_rec['remarks'] = $xremarks;
        $xarr_rec['status'] = $xsuccess == true ? "Success" : "Failed";
        $xarr_rec['log_tablename'] = $xtablename;
        $xarr_rec['osversion'] = php_uname();
        $xarr_rec['ipaddress'] = $_SERVER['REMOTE_ADDR'];
        $xarr_rec['pagename'] = $xwebpage;
        $xarr_rec['newval'] = $xnewval;
        $xarr_rec['oldval'] = $xoldval;
        $xarr_rec['fields'] = $xfield;
        PDO_InsertRecord($link_id,'useractivitylogfile',$xarr_rec, false);
        // die();
        
        // $qry_chkcount = "SELECT count(*) as xcount FROM useractivitylogfile";
        // $stmt_chkcount = $link_id->prepare($qry_chkcount);
        // $stmt_chkcount->execute();
        // $rs_chkcount = $stmt_chkcount->fetch();
        // if($rs_chkcount>$maxcount)
        // {
        //     $xecess = $rs_chkcount['xcount'] - $maxcount;
        //     $xqry_del = "DELETE FROM useractivitylogfile LIMIT $xecess";
        //     $xstmt_del = $link_id->prepare($xqry_del);
        //     $xstmt_del->execute();
        //     PDO_Refreshid("useractivitylogfile");
        // }
    }
?>
