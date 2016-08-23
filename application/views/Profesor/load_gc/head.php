<?php   
    if(isset($_SESSION['rol'])){
        if ($_SESSION['rol']=="PROFESOR") {
            $admin="PROFESOR";
        }else{
            $admin="NO ADMIN";
        }        
    }else{
        $admin="NO SET";
    }
    if($admin=="NO SET")
        header("Location: ".base_url());
    if($admin=="NO ADMIN")
        header("Location: ".base_url()."index.php/principalPROFESOR/error");
    if($admin=="PROFESOR")
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php
    foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php endforeach; ?>
    <?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
</head>
