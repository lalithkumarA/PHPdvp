	<?php
  class UsersController {
  
	public function index() {
		
		if(isset($_GET['uid']) && isset($_GET['pid'])){
			
			$username =  $_GET['uid']; //line 2	
			//$txt_password =  $_GET['pid']; //line 2	
			$password =  base64_decode($_GET['pid']); //line 2	
		
		} else if(isset($_POST['username']) && isset($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];	
		} else {
			$username =  ""; //line 2	
			$password =  ""; //line 2		
		} 
		
	 	/*echo $txt_username;*/
		  if(isset($_SESSION['username'])){	  	
			header("Location: ?controller=companies&action=index");	
		  } else if($username!="" && $password!=""){
			$db = Db::getInstance();
			
			$memberss = $db->query("SELECT * FROM members WHERE BINARY memberno ='".$username."' and pinnumber = '".$password."' and admin_status='Approved' and member_status!='I'");

			$members = $memberss->fetchAll();
			$total = 0;
			foreach($members as $member) {

				if($member['memberno'] == $username && $member['pinnumber'] == $password){
					$tblmembers = $db->query("SELECT count(*) as total FROM members WHERE memberno ='".$username."' and pinnumber = '".$password."' and admin_status='Approved' and member_status!='I'");

					foreach($tblmembers->fetchAll() as $tbl) {
						echo $total = $tbl['total'];
					}
				}else{
					$total = 0;
				}
			}	
			
			if($total>0){	
				$admin = $db->query("SELECT admin,membername,id,roll_id FROM members WHERE memberno ='".$username."' and pinnumber = '".$password."' and admin_status='Approved' and member_status!='I' ");		
				foreach($admin->fetchAll() as $ad) {
					$adminid 		= $ad['admin'];
					$adminname  	= $ad['membername'];
					$member_id  	= $ad['id'];
					$company_id  	= $ad['company_id'];
					$role_id	  	= $ad['roll_id'];
				}
				
				$created = date("Y-m-d H:i:s");		
				$db->query("insert logs(`created`,`user_id`,`url`,`controller`)values('$created', '$member_id','log masuk','user_controller') "); 	
				
				$_SESSION['admin']			= $adminid; 
				$_SESSION['company_id'] 	= $company_id;				
				$_SESSION['adminview'] 		= $adminview; 
				$_SESSION['adminname']		= $adminname;
				$_SESSION['memusername']	= $username;
				$_SESSION['mempassword'] 	= $password;	
				$_SESSION['mem'] 			= "members";
				$_SESSION['member_id'] 		= $member_id;
				$_SESSION['role_id'] 		= $role_id;		
				
				header("Location: ?controller=members&action=homeview");	
			} else {
				header("Location: ?controller=users&action=logout");	
			}
		}	else {
			require_once('views/users/login.php');
		}
	  	  	 	  
    }
	
	
	// register
	public function register() {
		
		$db = Db::getInstance();
					  
		$departments = $db->query("SELECT id,department_code,department_name FROM memdepartment_master WHERE status=1");		
		foreach($departments->fetchAll() as $dep) {
			$departmentlist[] = $dep;
		}


		$mailing = $db->query("SELECT id,department_code,department_name FROM memmail_master WHERE status=1");		
		foreach($mailing->fetchAll() as $mail) {
			$mailingaddress[] = $mail;
		}

		$centers = $db->query("SELECT id,center_code,center_name FROM memcenter_master WHERE status=1");		
		foreach($centers->fetchAll() as $cent) {
			$centerlists[] = $cent;
		}
		
		$states = $db->query("SELECT * FROM mem_state order by id asc");		
		foreach($states->fetchAll() as $st) {
			$statelist[] 	= $st; 	
     	}

		/*$banks = $db->query("SELECT id,bankcode,bankname FROM membank_master ORDER BY id asc");		
		foreach($banks->fetchAll() as $bk) {
			$banklists[] = $bk;
		}*/
		
		$banks = $db->query("SELECT id,bank_name as bankname FROM bank_lists ORDER BY id asc");		
		foreach($banks->fetchAll() as $bk) {
			$banklists[] = $bk;
		}
		

		$race = $db->query("SELECT id,racecode,racedescription FROM memrace_master WHERE racecode IN ('M','C','I','O') and status=1 ORDER BY id asc");		
		foreach($race->fetchAll() as $rac) {
			$racelists[] = $rac;
		}
		
		$religion = $db->query("SELECT id,religion_code,religion_name FROM memreligion_master WHERE status=1 ORDER BY id asc");		
		foreach($religion->fetchAll() as $reg) {
			$religionlists[] = $reg;
		}
		
		$city = $db->query("SELECT id,postcodefrom,postcodeto,city,state FROM mempostcode_master WHERE status=1 ORDER BY city,state asc");		
		foreach($city->fetchAll() as $cit) {
			$townlists[] = $cit;
		}
		
		$station = $db->query("SELECT stationcode,stationname FROM memstation_master WHERE status=1 ORDER BY id asc");		
		foreach($station->fetchAll() as $stat) {
			$stationlists[] = $stat;
		}
		
		$setup = $db->query("SELECT company_no,employer_name FROM  memcategory_master WHERE status=1 ORDER BY id asc");		
		foreach($setup->fetchAll() as $set) {
			$setuplists[] = $set;
		}
		
		if(isset($_POST['submit'])){
			$registered_date  				= date("Y-m-d");		
				
			$applicant_name					= strtoupper(addslashes($_POST['applicant_name']));	
			$nic1							= strtoupper($_POST['newic_no1']);
			$nic2							= strtoupper($_POST['newic_no2']);
			$nic3							= strtoupper($_POST['newic_no3']);
						
			//$nric_no						= $nic1.'-'.$nic2.'-'.$nic3;
			$nric_no						= strtoupper($nic1);
			$oldicno						= strtoupper($_POST['old_no']);
			$department_id					= strtoupper($_POST['department_id']);
			$mailing_id						= strtoupper($_POST['mailing_id']);
			$address						= strtoupper(addslashes($_POST['address']));
			$postcode						= $_POST['postcode'];	
			$towncode						= $_POST['town_id'];
			$home_telephone 				= $_POST['home_telephone'];
			$email							= $_POST['email'];
			$date_of_birth					= date("Y-m-d", strtotime($_POST['date_of_birth']));
			
			$email							= $_POST['email'];
			$staff_no						= strtoupper($_POST['staff_no']);
			$occupation						= strtoupper($_POST['occupation']);
			$income							= $_POST['income'];
			$gender							= strtoupper($_POST['gender']);	
			$marital_status					= strtoupper($_POST['marital_status']);	
			$religion						= strtoupper($_POST['religion']);
			$race 	    					= strtoupper($_POST['race']);
			$center_id						= strtoupper($_POST['center_id']);	

			$bank_id						= strtoupper($_POST['bank_id']);	
			$account_no						= strtoupper($_POST['account_no']);	
			
			$kurang_upaya					= strtoupper($_POST['kurang_upaya']);	
			$div_id							= strtoupper($_POST['div_id']);		
			$special_info					= strtoupper($_POST['special_info']);	
			
			
			$station_id						= strtoupper($_POST['station_id']);
			$emergency_name					= strtoupper($_POST['emergency_name']);
			$emergency_contact				= strtoupper($_POST['emergency_contact']);
			$emergency_address				= strtoupper($_POST['emergency_address']);
			$emergency_relation				= strtoupper($_POST['emergency_add1']);
			
			
			
			$start_date						= date('Y-m-d',strtotime($_POST['start_date']));
			
			
			$company_number					= $_POST['company_number'];
			
			
			$handphone						= $_POST['hand_phone'];	
			$memberimg						= $_POST['member_img'];
			$kremarks						= strtoupper($_POST['kurang_remarks']);
			
			$emergency_address1	    		= strtoupper($_POST['emergency_add1']);	
			$mailingaddress					= strtoupper($_POST['mailingaddress']);
			//$altemail						= $_POST['altemail'];
			$department						= strtoupper($_POST['department']);	
			$assign_id						= strtoupper($_POST['assign_id']);
			$gred						    = strtoupper($_POST['gred']);
			
			$curentmonth					= $_POST['curentmonth'];
			$curentyear						= $_POST['curentyear'];	
			$endmonth						= $_POST['endmonth'];
			$endyear					    = $_POST['endyear'];
			
			$apostcode						= $_POST['apostcode'];	
			$atown_id						= $_POST['atown_id'];
			
			$altemail						= $_POST['alter_email'];	
			$other_race				      = strtoupper($_POST['other_race']);
			
			$allowance						= $_POST['allowance'];

			if($_FILES['member_img']['name'] !=''){
				$ext = explode('.',$_FILES['member_img']['name']);
    			$extension = $ext[1];
				$newname = $ext[0];
				$file_path = "public/member_image/".$newname.'_'.time().'.'.$extension;
				$ins_path = $newname.'_'.time().'.'.$extension;
				if(move_uploaded_file($_FILES['member_img']['tmp_name'], $file_path.''.$file_name)) {
					$memberpath=$file_path;
    			}
			}

			
			
						
			$data							= $_POST['data'];
			$svcdate						= date("Y-m-d", strtotime($_POST['svcdate']));	
			$tblmember = $db->query("SELECT count(*) as total FROM members WHERE newic_no ='".$nric_no."'");		
			foreach($tblmember->fetchAll() as $tblmem) {
				$total = $tblmem['total'];
			}
			
			if($total==0){
				$schemeid	= 100;
				$schemeamt	= 10;
			}else if($total>0){
				$schemeid	= 101;
				$schemeamt	= 50;
			}

			$saham_amount					= $_POST['saham_amount'];
			$process_amount					= $_POST['process_amount'];
			$deduct_amount					= $_POST['deduct_amount'];
			$tkk_amount						= 10.00;
			$other_amount					= $_POST['other_amount'];
			
			$stateid						= $_POST['state_id'];
			$astateid						= $_POST['astate_id'];
			
			$db->query("insert into members(membername,oldic_no,newic_no,rspcode,mailcode,race,gender,religion,marital_status,date_of_birth,date_of_join,occupation,income,address1,postcode,towncode,homeno,email,divyn,bankcode,bankaccountno,upaya,pinnumber,sprem,staff_no,scheme_id,scheme_amt,station_id,emergency_name,emergency_contact,emergency_address,emergency_address1,saham_amount,process_amount,start_date,deduct_amount,tkk_amount,other_amount,companyno,svcdate,hp_no,member_image,kurang_remarks,mailingaddress,altemail,department,assign_id,gred,curentmonth,curentyear,endmonth,endyear,apostcode,atown_id,other_race,state_id,astate_id,allowance) values ('".$applicant_name."','".$oldicno."','".$nric_no."','".$department_id."','".$mailing_id."','".$race."','".$gender."','".$religion."','".$marital_status."','".$date_of_birth."','".$registered_date."','".$occupation."','".$income."','".$address."','".$postcode."','".$towncode."','".$home_telephone."','".$email."','".$div_id."','".$bank_id."','".$account_no."','".$kurang_upaya."','".$nric_no."','".$special_info."','".$staff_no."','".$schemeid."','".$schemeamt."','".$station_id."','".$emergency_name."','".$emergency_contact."','".$emergency_address."','".$emergency_relation."','".$saham_amount."','".$process_amount."','".$start_date."','".$deduct_amount."','".$tkk_amount."','".$other_amount."','".$company_number."','".$svcdate."','".$handphone."','".$memberpath."','".$kremarks."','".$mailingaddress."','".$altemail."','".$department."','".$assign_id."','".$gred."','".$curentmonth."','".$curentyear."','".$endmonth."','".$endyear."','".$apostcode."','".$atown_id."','".$other_race."','".$stateid."',,'".$astateid."','".$allowance."')");
		   $member_id = $db->lastInsertId();
		   if($saham_amount>0){
		   	$db->query("insert into memstandardpayment(member_id,scheme_id,scheme_amount,start_date,type) values ('".$member_id."','10','".$saham_amount."','".$registered_date."','standard')");
		   }
		   if($process_amount>0){
		   	$db->query("insert into memstandardpayment(member_id,scheme_id,scheme_amount,start_date,type) values ('".$member_id."','100','".$process_amount."','".$registered_date."','onetime')");
		   }
		   if($tkk_amount>0){
		   	$db->query("insert into memstandardpayment(member_id,scheme_id,scheme_amount,start_date,type) values ('".$member_id."','61','".$tkk_amount."','".$registered_date."','standard')");
		   }
		   if($other_amount>0){
		   	$db->query("insert into memstandardpayment(member_id,scheme_id,scheme_amount,start_date,type) values ('".$member_id."','101','".$other_amount."','".$registered_date."','onetime')");
		   }

		    $data1	= $_POST['data2'];
		    foreach($data1 as $dt1){
		   	  	//$nomineeic = $dt1['newnic_no1'].'-'.$dt1['newnic_no2'].'-'.$dt1['newnic_no3'];
				/*echo "insert into memnominee(member_id,nominee_name,nominee_ic,nominee_percent,nominee_address,nominee_phoneno) values ('".$member_id."','".strtoupper($dt1['nominee_name'])."','".$nomineeic."','".$dt1['nominee_percent']."','".strtoupper($dt1['nominee_address'])."','".$dt1['nominee_phone']."')";*/

				/*$nomineeic = $dt1['newnic_no'];
		   		$db->query("insert into memnominee(member_id,nominee_name,nominee_ic,nominee_percent,nominee_address,nominee_phoneno) values ('".$member_id."','".strtoupper($dt1['nominee_name'])."','".$nomineeic."','".$dt1['nominee_percent']."','".strtoupper($dt1['nominee_address'])."','".$dt1['nominee_phone']."')");*/

				$nomineeic = $dt1['newnic_no'];
		   		$db->query("insert into memnominee(member_id,nominee_name,nominee_ic,nominee_percent,relation,nominee_phoneno) values ('".$member_id."','".strtoupper($dt1['nominee_name'])."','".$nomineeic."','".$dt1['nominee_percent']."','".strtoupper($dt1['nominee_address'])."','".$dt1['nominee_phone']."')");
		   		
		   }
			if(!empty($_FILES['img_file']['name'])){ 
				foreach($_FILES['img_file']['name'] as $dt=>$key){
					$f_name[] = $_FILES["img_file"]["name"][$dt];
					$tmp_name = $_FILES["img_file"]["tmp_name"][$dt];
					$name = $_FILES["img_file"]["name"][$dt];
					move_uploaded_file($tmp_name, "public/img/documents/".$name);
									
				}
			}
						
			$a = 0;
			foreach($data as $dt){
				
				$describe	  = $dt['description'];	
				$path		  = $f_name[$a];
				$image_path   = "public/img/documents/".$path;
				$upload_date = date('Y-m-d');
				
				$db->query("insert into memdocuments(member_id,document_name,updated_date,imagepath) values ('".$member_id."','".$describe."','".$upload_date."','".$image_path."')");
				$a++;
			}
						
			if($_FILES['member_ic']['name'] !=''){
				$ext = explode('.',$_FILES['member_ic']['name']);
				$extension = $ext[1];
				$newname = $ext[0];
				$file_path = "public/documents/".$newname.'_'.time().'.'.$extension;
				$ins_path = $newname.'_'.time().'.'.$extension;
				if(move_uploaded_file($_FILES['member_ic']['tmp_name'], $file_path.''.$file_name)) {
					$memberpath=$file_path;
				}
			}

				$describe	  = strtoupper($_POST['kurang_remarks']);	
				$upload_date = date('Y-m-d');
				$db->query("insert into memdocuments(member_id,document_name,updated_date,imagepath) values ('".$member_id."','".$describe."','".$upload_date."','".$memberpath."')");
		?>
			<script>alert("You have successfully registered for member");	
			<?php	
				echo 'window.location= "?controller=users&action=index"';
				echo '</script>';	
			//header("Location: ?controller=users&action=index");	
		}	
		require_once('views/users/register.php'); 
	}
	
	// forget
	public function forget() {
		require_once('views/users/forget.php'); 
    }
	
		
	// logout
	public function logout() {
		$db = Db::getInstance();
		session_start();
		error_reporting(0);
		if(isset($_SESSION['username']) && isset($_SESSION['password'])){
			$created = date("Y-m-d H:i:s");
			$member_id = $_SESSION['member_id'];	
			$db->query("insert logs(`created`,`user_id`,`url`,`controller`)values('$created', '$member_id','log keluar','user_controller') "); 		
			session_destroy();
			header("Location: ?controller=users&action=logout");	
		}else{
			header("Location: ?controller=users&action=index");	
		}		
    }
	
    public function error() {
      	require_once('views/users/error.php');
    }
	
}
?>	
