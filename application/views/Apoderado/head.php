<?php   
    if(isset($_SESSION['rol'])){
        if ($_SESSION['rol']=="APODERADO") {
            $admin="APODERADO";
        }else{
            $admin="NO ADMIN";
        }        
    }else{
        $admin="NO SET";
    }
    if($admin=="NO SET")
        header("Location: ".base_url());
    if($admin=="NO ADMIN")
        header("Location: ".base_url()."index.php/principalAPODERADO/error");
    if($admin=="APODERADO")
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap-theme.css">

	<script src="<?php echo base_url();?>js/boostrap.min.js"></script>
	<script src="<?php echo base_url();?>js/npm.js"></script>
	<script src="<?php echo base_url();?>js/jquery-3.1.0.min.js"></script>
</head>	
