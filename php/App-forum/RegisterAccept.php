<?php require_once './inc/header.php'?>
<?php require_once './inc/navbar.php'?>

<div class="base animated fadeIn" id="inner-wrap">
	<ul id="nav-breadcrumbs" class="nav-breadcrumbs linklist navlinks" role="menubar">
		<li class="breadcrumbs">
			<span class="crumb" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
				<a href="http://www.planetstyles.net/" itemprop="url" data-navbar-reference="home">
					<i class="icon fa-home fa-fw" aria-hidden="true"></i>
					<span itemprop="title">Home</span>
				</a>
			</span>
			<span class="crumb" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
				<a href="index-2.html" itemprop="url" accesskey="h" data-navbar-reference="index">
					<span itemprop="title">Board index</span>
				</a>
			</span>

		</li>

		<li class="rightside responsive-search">
			<a href="search.html" title="View the advanced search options" role="menuitem">
				<i class="icon fa-search fa-fw" aria-hidden="true"></i>
				<span class="sr-only">Search</span>
			</a>
		</li>
	</ul>

	<a id="start_here" class="anchor"></a>
	<div id="page-body" class="page-body" role="main">





		<script type="text/javascript">
			// <![CDATA[
			/**
			 * Change language
			 */
			function change_language(lang_iso) {
				document.cookie = 'phpbb3_mr5p5_lang=' + lang_iso + '; path=/';
				document.forms['register'].change_lang.value = lang_iso;
				document.forms['register'].submit();
			}

			// ]]>
		</script>

		<form method="post" action="http://www.planetstyles.net/demo/h2o/3.2/3/ucp.php?mode=register" id="register">
			<p class="rightside">
				<label for="lang">Language:</label>
				<select name="lang" id="lang" onchange="change_language(this.value); return false;" title="Language">
					<option value="en" selected="selected">English</option>
					<option value="ar">العربية</option>
				</select>
				<input type="hidden" name="change_lang" value="" />

			</p>
		</form>

		<div class="clear"></div>


		<form method="post" action="http://www.planetstyles.net/demo/h2o/3.2/3/ucp.php?mode=register" id="agreement">

			<div class="panel">
				<div class="inner">
					<div class="content">
						<h2 class="sitename-title">PlanetStyles Test Forum - Registration</h2>
						<p>By accessing “PlanetStyles Test Forum” (hereinafter “we”, “us”, “our”, “PlanetStyles Test Forum”, “http://www.planetstyles.net/demo/h2o/3.2/3”),
							you agree to be legally bound by the following terms. If you do not agree to be legally bound by all of the following
							terms then please do not access and/or use “PlanetStyles Test Forum”. We may change these at any time and we’ll do
							our utmost in informing you, though it would be prudent to review this regularly yourself as your continued usage
							of “PlanetStyles Test Forum” after changes mean you agree to be legally bound by these terms as they are updated and/or
							amended.
							<br />
							<br /> Our forums are powered by phpBB (hereinafter “they”, “them”, “their”, “phpBB software”, “www.phpbb.com”, “phpBB Limited”,
							“phpBB Teams”) which is a bulletin board solution released under the “
							<a href="http://opensource.org/licenses/gpl-2.0.php">GNU General Public License v2</a>” (hereinafter “GPL”) and can be downloaded from
							<a href="https://www.phpbb.com/">www.phpbb.com</a>. The phpBB software only facilitates internet based discussions; phpBB Limited is not responsible
							for what we allow and/or disallow as permissible content and/or conduct. For further information about phpBB, please
							see:
							<a href="https://www.phpbb.com/">https://www.phpbb.com/</a>.
							<br />
							<br /> You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-orientated or any
							other material that may violate any laws be it of your country, the country where “PlanetStyles Test Forum” is hosted
							or International Law. Doing so may lead to you being immediately and permanently banned, with notification of your
							Internet Service Provider if deemed required by us. The IP address of all posts are recorded to aid in enforcing these
							conditions. You agree that “PlanetStyles Test Forum” have the right to remove, edit, move or close any topic at any
							time should we see fit. As a user you agree to any information you have entered to being stored in a database. While
							this information will not be disclosed to any third party without your consent, neither “PlanetStyles Test Forum”
							nor phpBB shall be held responsible for any hacking attempt that may lead to the data being compromised.
						</p>
					</div>
				</div>
			</div>

			<div class="panel">
				<div class="inner">
					<fieldset class="submit-buttons">
						<input type="submit" name="agreed" id="agreed" value="I agree to these terms" class="button1" />&nbsp;
						<input type="submit" name="not_agreed" value="I do not agree to these terms" class="button2" />
						<input type="hidden" name="change_lang" value="" />

						<input type="hidden" name="creation_time" value="1529601997" />
						<input type="hidden" name="form_token" value="f9ff9a2bbb59217c604f2159a3d852586580a211" />

					</fieldset>
				</div>
			</div>
		</form>




	</div>


</div>
<?php require_once './inc/footer.php'?>