<?php echo
'<section class="option-bar">
			Witaj '.$_SESSION['user'].' !
			<a href="#user"><i class="fas fa-users-cog"></i></a>
			<a href="#notifications"><i class="fas fa-bell"></i></a>
			<a href="logout"><i class="fas fa-sign-out-alt"></i></a>
			'.(isset($option_bar) ? $option_bar : '').'
		</section>
		<section class="side-bar">
			<div class="menu-button">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<nav class="menu">
				<ul>
					<li><a href="dashboard"><i class="fas fa-desktop"></i></a></li>
					<li><a href="articles"><i class="fas fa-file-alt"></i></a></li>
					<li><a href="preview"><i class="far fa-eye"></i></a></li>
					<li><a href="personalization"><i class="fas fa-palette"></i></a></li>
					<li><a href="activity"><i class="fas fa-book"></i></a></li>
					<li><a href="settings"><i class="fas fa-cog"></i></a></li>
					<li><a href="users"><i class="fas fa-users-cog"></i></a></li>
					<li><a href="pages"><i class="fas fa-file"></i></a></li>
				</ul>
			</nav>
		</section>
';