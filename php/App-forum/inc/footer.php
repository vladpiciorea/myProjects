<div id="page-footer" class="page-footer base" role="contentinfo">
			<div class="navbar_footer" role="navigation">
				<div class="inner">

					<ul id="nav-footer" class="nav-footer linklist" role="menubar">
						<li class="breadcrumbs"></li>
						<span class="crumb">
							<a href="http://www.planetstyles.net/" data-navbar-reference="home">
								<i class="icon fa-home fa-fw" aria-hidden="true"></i>
								<span>Home</span>
							</a>
						</span>
						</li>

						<li class="rightside" data-last-responsive="true">
							<a href="memberlist4bfd.html?mode=team" role="menuitem">
								<i class="icon fa-shield fa-fw" aria-hidden="true"></i>
								<span>The team</span>
							</a>
						</li>
						<li class="rightside" data-last-responsive="true">
							<a href="memberlist8733.html?mode=contactadmin" role="menuitem">
								<i class="icon fa-envelope fa-fw" aria-hidden="true"></i>
								<span>Contact us</span>
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="social_links_footer">

				<a href="#" class="h2o_facebook">
					<span class="fa fa-facebook"></span>
				</a>
				<a href="#" class="h2o_blue">
					<span class="fa fa-twitter"></span>
				</a>
				<a href="#" class="h2o_red">
					<span class="fa fa-youtube"></span>
				</a>
			</div>


			<div id="darkenwrapper" class="darkenwrapper" data-ajax-error-title="AJAX error" data-ajax-error-text="Something went wrong when processing your request."
			    data-ajax-error-text-abort="User aborted request." data-ajax-error-text-timeout="Your request timed out; please try again."
			    data-ajax-error-text-parsererror="Something went wrong with the request and the server returned an invalid reply.">
				<div id="darken" class="darken">&nbsp;</div>
			</div>

			<div id="phpbb_alert" class="phpbb_alert" data-l-err="Error" data-l-timeout-processing-req="Request timed out.">
				<a href="#" class="alert_close">
					<i class="icon fa-times-circle fa-fw" aria-hidden="true"></i>
				</a>
				<h3 class="alert_title">&nbsp;</h3>
				<p class="alert_text"></p>
			</div>
			<div id="phpbb_confirm" class="phpbb_alert">
				<a href="#" class="alert_close">
					<i class="icon fa-times-circle fa-fw" aria-hidden="true"></i>
				</a>
				<div class="alert_text"></div>
			</div>
		</div>



		<div class="copyright_bar base">
			Powered by
			<a href="http://www.phpbb.com/">Xextreme</a>&trade;
			<span class="planetstyles_credit">&bull; Design by
				<a href="http://www.planetstyles.net/">Picioare Vladut Andrei</a>
			</span>


		</div>

	</div>
	<!-- /#wrap -->

	<div style="display: none;">
		<a id="bottom" class="anchor" accesskey="z"></a>
	</div>

	<script type="text/javascript" src="assets/javascript/jquery.mind36d.js?assets_version=80"></script>


	<script type="text/javascript" src="assets/javascript/cored36d.js?assets_version=80"></script>







	<script type="text/javascript" src="styles/H2O/template/tooltipster.bundle.mind36d.js?assets_version=80"></script>
	<script type="text/javascript" src="styles/H2O/template/jquery.collapsed36d.js?assets_version=80"></script>
	<script type="text/javascript" src="styles/H2O/template/jquery.collapse_storaged36d.js?assets_version=80"></script>
	<script type="text/javascript" src="styles/H2O/template/forum_fnd36d.js?assets_version=80"></script>
	<script type="text/javascript" src="styles/prosilver/template/ajaxd36d.js?assets_version=80"></script>


	<script type="text/javascript">
		/* Major bug: Online, this JS runs before the logo has a chance to load, so the height is missing from header adjustment */

		/* Identify the height of headerbar */
		var headerbar_height = $('.headerbar_overlay_container').height();

		/* Match particle container height to headerbar. Creates window for canvas */
		$('.particles_container').css({
			'height': headerbar_height
		});

		/* Dynamically apply width to site desc container, maximising clickable area behind it. We only need this to happen when particles are enabled. */
		var logo_width = $('.site-description').width();
		var logo_width_fix = (logo_width + 2); /* Caters for retina devices where the width is defined as a decimal. Obvs we can't set a decimal pixel width */
		$('.site-description').css({
			'width': logo_width_fix
		});
	</script>

	<script src="styles/H2O/template/particles.js"></script>
	<script src="styles/H2O/template/particles.app.js"></script>

	<script type="text/javascript">
		/* Reposition the canvas so it aligns with headerbar */
		$('canvas.particles-js-canvas-el').css({
			'margin-top': -headerbar_height
		});
	</script>

	<!-- Subforums in columns -->
	<script type="text/javascript">
		$(function ($) {
			var num_cols = 3,
				container = $('.sub-forumlist'),
				listItem = 'li',
				listClass = 'sub-list';
			container.each(function () {
				var items_per_col = new Array(),
					items = $(this).find(listItem),
					min_items_per_col = Math.floor(items.length / num_cols),
					difference = items.length - (min_items_per_col * num_cols);
				for (var i = 0; i < num_cols; i++) {
					if (i < difference) {
						items_per_col[i] = min_items_per_col + 1;
					} else {
						items_per_col[i] = min_items_per_col;
					}
				}
				for (var i = 0; i < num_cols; i++) {
					$(this).append($('<ul ></ul>').addClass(listClass));
					for (var j = 0; j < items_per_col[i]; j++) {
						var pointer = 0;
						for (var k = 0; k < i; k++) {
							pointer += items_per_col[k];
						}
						$(this).find('.' + listClass).last().append(items[j + pointer]);
					}
				}
			});
		});
	</script>

	<!-- Add a number before each category on index forumlist -->
	<script type="text/javascript">
		$("span.forum_id").each(function (i) {
			$(this).html('0' + (i + 1));
		});
	</script>






	<!-- Demo -->
	<link href="#" rel="stylesheet" class="preset_stylesheet">

	<script type="text/javascript">
		$(document).ready(function () {
			$("a.switch").click(function () {
				$("link.preset_stylesheet").attr("href", $(this).attr('rel'));
				return false;
			});
		});
	</script>

	<style type="text/css">
		#demo_swatch {
			position: fixed;
			background: #FFFFFF;
			top: 10%;
			z-index: 9999999;
			width: 100px;
			box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.25);
			padding: 15px;
		}

		#demo_swatch_picker {
			color: #222222;
		}

		#demo_swatch_trigger {
			width: 40px;
			height: 40px;
			line-height: 40px;
			background: #00ACFF;
			position: absolute;
			right: -40px;
			/* width of trigger */
			top: 0;
			/* padding */
			color: #FFFFFF;
			text-align: center;
		}

		#demo_swatch_purchase {
			width: 40px;
			height: 33px;
			line-height: 10px;
			padding-top: 7px;
			background: #76B852;
			position: absolute;
			right: -40px;
			/* width of trigger */
			top: 45px;
			/* padding */
			color: #FFFFFF;
			text-align: center;
		}

		span.demo_swatch_buy_text {
			font-size: 10px;
		}

		#demo_swatch_picker {
			font-size: 10px;
		}

		#demo_swatch_presets {}

		#demo_swatch_presets a {
			display: block;
			text-align: center;
			padding: 5px;
			color: rgba(255, 255, 255, 0.8);
			font-weight: 500;
			text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
		}

		#demo_swatch_presets a:hover {
			color: rgba(255, 255, 255, 1);
		}

		.switch_red {
			background: #ff2e16;
		}

		.switch_orange {
			background: #FE9900;
		}

		.switch_yellow {
			background: #FEED19;
		}

		.switch_green {
			background: #89C541;
		}

		.switch_blue {
			background: #47c4ff;
		}

		.switch_purple {
			background: #9D1DB2;
		}

		.switch_pink {
			background: #EC1562;
		}

		.switch_nuke {
			background: #43ea8f;
		}
	</style>


</body>


</html>