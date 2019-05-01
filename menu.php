<?php
/*
	Main menu

	Configuration varaibles:

		$menu_section : webpage section hight lighted ['index' 'team' 'leagal' 'contact'  'about']
		$menu_search_icon : [TRUE, FALSE]

*/
if(!isset($menu_section))
{
	$menu_section='index';
}
if(!isset($menu_search_icon))
{
	$menu_search_icon = FALSE;
}

?>

<header>
	<script>
		$(document).ready(function() {
			if(<?php echo "'".$menu_section."'"?> == 'index') $(".menu-logo").fadeTo(0,0);

			$(window).scroll(function() 
			{
				if(<?php echo "'".$menu_section."'"?> == 'index')
				{
				    if($(window).scrollTop() > $(".easy-autocomplete").height())
				    {
				    	if ($(".menu-logo").css('opacity') == 0) $(".menu-logo").stop().fadeTo(300,1);
				    }
				    else 
				    {
				    	if ($(".menu-logo").css('opacity') == 1) $(".menu-logo").stop().fadeTo(200,0);
				    }
				}
			});
		});
	</script>

	<div class="logo">
		<a href="/index"><img class="menu-logo" src="/img/vegetacat-favicon.png"></img></a>
		<a href="/index" style="text-decoration: none;"><h1>VEGETA.cat</h1></a>
	</div>
	
	<div id="menu_icon"></div>
	<?php
	if($menu_search_icon)
	{
		echo '<div id="search_icon"></div>';
	}
	?>
	<nav style="margin-bottom:100px;">
		<ul>
			<li><a href="/index" <?php if($menu_section=='index'){echo 'class="selected"';} ?> >Inici</a></li>
			<li><a href="/series" <?php if($menu_section=='series'){echo 'class="selected"';} ?> >S&egraveries A-Z</a></li>
			<li><a href="/random" <?php if($menu_section=='random'){echo 'class="selected"';} ?> >S&egraverie aleat&ograveria</a></li>
			<li><a href="/contact" <?php if($menu_section=='contact'){echo 'class="selected"';} ?> >Contacta'ns</a></li>
			<li><a href="/about" <?php if($menu_section=='about'){echo 'class="selected"';} ?>>Sobre vegeta.cat</a></li>
		</ul>
	</nav>

	<div class="footer clearfix">
		<div class="rights">
			<p>Copyright © 2019 Vegeta.cat</p>
			<a href="/legal" <?php if($menu_section=='legal'){echo 'class="selected"';} ?> >Nota legal</a>
		</div>
	</div >
</header>
