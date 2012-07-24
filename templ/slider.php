<span class="wel"><p>歡迎光臨 <?= $_SESSION['user-info']['nickname']?></p></span>

<div id="dash">
	
	<span class="profile"><p><a href="edit_profile.php"><img src="<?=get_gravatar($_SESSION['user-info']['email'],180)?>" alt="" width="180px"/><br />[修改個人資料]</a></p></span>
	<span class="note">
		<p>剩餘點數：<?=$_SESSION['user-info']['total_limit'] ?></p>
		<p>上次登入：<?=@$_SESSION['user-info']['previous_login']?></p>
	</span>
</div>
