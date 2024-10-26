<?php 
session_start();
        if(isset($_POST['txtUsername'])){
                  include("connect/conn.php");
                  $username 	= $_POST['txtUsername'];
                  $md5password 	= md5($_POST['txtPassword']);
				  $password 	= $_POST['txtPassword'];

                  $sqllogin	=	"SELECT * FROM userhospital 
				  				WHERE  Username ='".$username."' 
                  				AND  Password = '".$password."' ";
                  $resultlogin 	= mysqli_query($con, $sqllogin);
				  $rowlogin 	= mysqli_fetch_array($resultlogin);
				  //$CountQuery	= count($resultlogin);
			
				  $HospitalID 	= $rowlogin["HospitalID"];
			
				  $sqlTYPESERVICE 		= "SELECT TYPE_SERVICE,HOS_TYPE,HOS_NAME,CODE_HMOO,CODE_PROVINCE,NO_DISTRICT,Affiliation FROM hospitalnew WHERE CODE5 = '$HospitalID';" ;
				  $resultTYPESERVICE 	= mysqli_query($con, $sqlTYPESERVICE);
				  $rowTYPESERVICE 		= mysqli_fetch_array($resultTYPESERVICE);
			
				  $TYPESERVICE 	= $rowTYPESERVICE["TYPE_SERVICE"];
				  $HosType 		= $rowTYPESERVICE["HOS_TYPE"];
				  $HospitalName	= $rowTYPESERVICE["HOS_NAME"];
				  $HostHMOO		= $rowTYPESERVICE["CODE_HMOO"];
			      $codeprovince = $rowTYPESERVICE["CODE_PROVINCE"];	
				  $NO_DISTRICT  = $rowTYPESERVICE["NO_DISTRICT"];		
				  $Affiliation  = $rowTYPESERVICE["Affiliation"];

				  
                  if(mysqli_num_rows($resultlogin)==1){
				  //if($CountQuery == 1){
					  
					  if($rowlogin["stausloginfirst"] == '1'){
							$_SESSION["UserID"] 		= $rowlogin["UserID"];
							$_SESSION["TypeUser"] 		= $rowlogin["TypeUser"];
							$_SESSION["HospitalID"] 	= $HospitalID;
						 	$_SESSION["TypeService"] 	= $TYPESERVICE;
						   	$_SESSION["HosType"] 		= $HosType;
						    $_SESSION["HostHMOO"] 		= $HostHMOO;
						    $_SESSION["codeprovince"] 	= $codeprovince;
							$_SESSION["NO_DISTRICT"] 	= $NO_DISTRICT;
							$_SESSION["HOS_NAME"]		= $HospitalName;
							$_SESSION["Affiliation"]	= $Affiliation;

							$sqllogon 		= "UPDATE userhospital SET `lock` = '1' WHERE UserID = '".$rowlogin["UserID"]."';" ;
							$resultlogon  	= mysqli_query($con, $sqllogon);
							

							

							if($_SESSION["TypeUser"] !=""){ 

							  //Header("Location: detail-1.php");
								/*if($_SESSION["HosType"] == 'กรมสุขภาพจิต'){
									Header("Location: tables-preall2.php");
								}elseif($_SESSION["HosType"] == 'ศูนย์วิชาการ'){
									Header("Location: tables-preall2.php");
								}else
								*/
								if($_SESSION["HosType"] == 'สำนักงานสาธารณสุขจังหวัด'){
									Header("Location: tables-preall.php");
								}elseif($_SESSION["HosType"] == 'สำนักงานสาธารณสุขอำเภอ'){
									Header("Location: tables-preall.php");	
								}else{
									Header("Location: detail-1.php");
								}
							}

					  }else{

						  
							$_SESSION["UserID"] 		= $rowlogin["UserID"];
							$_SESSION["TypeUser"] 		= $rowlogin["TypeUser"];
							$_SESSION["HospitalID"] 	= $HospitalID;
						  	$_SESSION["TypeService"] 	= $TYPESERVICE;
						    $_SESSION["HosType"]		= $HosType;
						    $_SESSION["HOS_NAME"]		= $HospitalName;
						  	$_SESSION["HostHMOO"] 		= $HostHMOO;
						    $_SESSION["codeprovince"] 	= $codeprovince;
							$_SESSION["NO_DISTRICT"] 	= $NO_DISTRICT;
							$_SESSION["Affiliation"]	= $Affiliation;

							if($_SESSION["TypeUser"]!=""){ 

							  Header("Location: register.php");
							}
						  
					  }
					  
                  }else{
					  
                    echo "<script>";
                        echo "alert(\" Username หรือ Password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";
 
                  }
        }else{

             Header("Location: form_login.php"); //user & password incorrect back to login again
 
        }
?>