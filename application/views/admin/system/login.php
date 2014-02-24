<div id="login">
	<h1>Administrator Panel</h1>
    <div class="bar">

        <div class="text">Login</div>
        <div class="cr"></div>
    </div>
    <div class="box">
    <form method="post" action="<?=base_url()?>admin/validate">
    	<dl class="three"><dt>Username</dt><dd><input type="text" class="textfield rounded" name="username" /></dd></dl>
        <dl class="three"><dt>Password</dt><dd><input type="password" class="textfield rounded" name="password" /></dd></dl>
        <dl class="three"><dt>&nbsp;</dt><dd><input type="submit" class="button rounded" value="Login" /></dd></dl>
        <?php if($this->session->flashdata('error')) { ?>
        <dl class="three"><dt>&nbsp;</dt><dd class="error">Authorization failed: wrong combination of username/password</dd></dl>
        <?php } ?>
    </form>
    </div>    
    <dl></dl>
    <br /><br />
</div>