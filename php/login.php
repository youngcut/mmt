<h3 class="txt_fail"><? echo $failtext; ?></h3>

<form action="index.php" method="post">                
    <label for="username"><? echo $config['text']['german']['login']['input'][0]; ?></label>
    <input type="text" name="username" id="username" value="<? echo (isset($_SESSION["usr_name"])) ? $_SESSION["usr_name"] : ""; ?>">
    <label for="password"><? echo $config['text']['german']['login']['input'][1]; ?></label>
    <input type="password" data-clear-btn="false" name="passwort" id="passwort" value="" autocomplete="off">
    <br />
    <fieldset data-role="controlgroup">
        <legend><? echo	$config['text']['german']['login']['switch'][0]; ?></legend>
        <input type="radio" name="forward" id="mmt" value="mmt" checked="checked">
        <label for="mmt"><? echo	$config['text']['german']['login']['switch'][1]; ?></label>
        <input type="radio" name="forward" id="mma" value="mma">
        <label for="mma"><? echo	$config['text']['german']['login']['switch'][2]; ?></label>
    </fieldset>
    <br />
    <input type="submit" value=<? echo	$config['text']['german']['login']['button']; ?>>
</form>