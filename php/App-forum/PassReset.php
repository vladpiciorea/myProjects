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
		</li>
	</ul>



	<a id="start_here" class="anchor"></a>
	<div id="page-body" class="page-body" role="main">




		<form action="http://www.planetstyles.net/demo/h2o/3.2/3/ucp.php?mode=sendpassword" method="post" id="remind">

			<div class="panel">
				<div class="inner">

					<div class="content">
						<h2>Reseteaza parola</h2>

						<fieldset>
							
							<dl>
								<dt>
									<label for="email">Email address:</label>
									<br />
									<span>Introduceti adresa de e-mail asociată contului dvs. </span>
								</dt>
								<dd>
									<input class="inputbox narrow" type="email" name="email" id="email" size="25" maxlength="100" />
								</dd>
							</dl>
							<dl>
								<dt>&nbsp;</dt>
								<dd>
									<a href="index.php">Inapoi</a>
									<input type="submit" name="submit" id="submit" class="button1" value="Submit" tabindex="2" style=" float: right;" />&nbsp;
									
								</dd>
							</dl>
							<input type="hidden" name="creation_time" value="1529602028" />
							<input type="hidden" name="form_token" value="a89221918d9e59585ca0e2b74905a436433bf4f1" />

						</fieldset>
					</div>

				</div>
			</div>
		</form>



	</div>


</div>
<?php require_once './inc/footer.php'?>
