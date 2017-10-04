<!DOCTYPE html>
<html>
<body>
<br><br>

<form  method="post">
<?php
if(isset($msg)){
	echo "<br><b>$msg</b><br><br>";
}
?>
 <label for="login">Login</label>
 <input type="text" name="login">
 <br><br>
 <label for="password">Senha</label>
 <input type="password" name="senha">
 <br><br>
 <input type="submit"  value="login" name="btnLogin">
</fieldset>
</form>
</body>
</html>