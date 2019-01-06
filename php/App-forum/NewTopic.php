<?php require_once './inc/header.php'?>
<?php require_once './inc/navbar.php'?>
		<div class="base animated fadeIn" id="inner-wrap">



			<ul id="nav-breadcrumbs" class="nav-breadcrumbs linklist navlinks" role="menubar">
				<li class="breadcrumbs">
					<span class="crumb" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">
						<a href="http://www.planetstyles.net" itemprop="url" data-navbar-reference="home">
							<i class="icon fa-home fa-fw" aria-hidden="true"></i>
							<span itemprop="title">Home</span>
						</a>
					</span>

					<span class="crumb" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="" data-forum-id="4">
						<a href="./viewforum.php?f=4" itemprop="url">
							<span itemprop="title">Category Three</span>
						</a>
					</span>
					<span class="crumb" itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="" data-forum-id="16">
						<a href="./viewforum.php?f=16" itemprop="url">
							<span itemprop="title">Nume Topic</span>
						</a>
					</span>
				</li>

			</ul>



			<a id="start_here" class="anchor"></a>
			<div id="page-body" class="page-body" role="main">

				</div>



				<h2 class="posting-title">
					<a href="ViewForum.php">Nume topic</a>
				</h2>

				<form id="postform" method="post" action="./posting.php?mode=post&amp;f=16">
					<div class="panel" id="postingbox">
						<div class="inner">

							<h3>Posteaza un nou subiect</h3>

							<fieldset class="fields1">


								<dl style="clear: left;">
									<dt>
										<label for="username">Nume postare:</label>
									</dt>
									<dd>
										<input type="text" tabindex="1" name="username" id="username" size="25" value="" class="inputbox autowidth" />
									</dd>
								</dl>


								<dl style="clear: left;">
									<dt>
										<label for="subject">Subject:</label>
									</dt>
									<dd>
										<input type="text" name="subject" id="subject" size="45" maxlength="120" tabindex="2" value="" class="inputbox autowidth"
										/>
									</dd>
								</dl>

								<dl>
									<dt>
										<label>Cod de confiramare:</label>
										<br />
										<span>Într-un efort de a împiedica postarile automate, vă cerem să confirrmati ca nu sunteti robot.</span>
									</dt>
									<dd class="captcha">
										<noscript>
											<div>Please enable JavaScript in your browser to load the challenge.</div>
										</noscript>
										<script src="http://www.google.com/recaptcha/api.js?hl=en" async defer></script>
										<div class="g-recaptcha" data-sitekey="6LfR9xMUAAAAAE0ukjmcBov4xQM2Y_UCGYk8Wyp_" data-tabindex="3"></div>
									</dd>
								</dl>




								<script type="text/javascript">
									// <![CDATA[
									var form_name = 'postform';
									var text_name = 'message';
									var load_draft = false;
									var upload = false;

									// Define the bbCode tags
									var bbcode = new Array();
									var bbtags = new Array('[b]', '[/b]', '[i]', '[/i]', '[u]', '[/u]', '[quote]', '[/quote]', '[code]', '[/code]',
										'[list]', '[/list]', '[list=]', '[/list]', '[img]', '[/img]', '[url]', '[/url]', '[flash=]', '[/flash]',
										'[size=]', '[/size]', '[longlist]', '[/longlist]', '[spoiler]', '[/spoiler]');
									var imageTag = false;

									// Helpline messages
									var help_line = {
										b: 'Bold\x20text\x3A\x20\x5Bb\x5Dtext\x5B\x2Fb\x5D',
										i: 'Italic\x20text\x3A\x20\x5Bi\x5Dtext\x5B\x2Fi\x5D',
										u: 'Underline\x20text\x3A\x20\x5Bu\x5Dtext\x5B\x2Fu\x5D',
										q: 'Quote\x20text\x3A\x20\x5Bquote\x5Dtext\x5B\x2Fquote\x5D',
										c: 'Code\x20display\x3A\x20\x5Bcode\x5Dcode\x5B\x2Fcode\x5D',
										l: 'List\x3A\x20\x5Blist\x5D\x5B\x2A\x5Dtext\x5B\x2Flist\x5D',
										o: 'Ordered\x20list\x3A\x20e.g.\x20\x5Blist\x3D1\x5D\x5B\x2A\x5DFirst\x20point\x5B\x2Flist\x5D\x20or\x20\x5Blist\x3Da\x5D\x5B\x2A\x5DPoint\x20a\x5B\x2Flist\x5D',
										p: 'Insert\x20image\x3A\x20\x5Bimg\x5Dhttp\x3A\x2F\x2Fimage_url\x5B\x2Fimg\x5D',
										w: 'Insert\x20URL\x3A\x20\x5Burl\x5Dhttp\x3A\x2F\x2Furl\x5B\x2Furl\x5D\x20or\x20\x5Burl\x3Dhttp\x3A\x2F\x2Furl\x5DURL\x20text\x5B\x2Furl\x5D',
										a: 'Inline\x20uploaded\x20attachment\x3A\x20\x5Battachment\x3D\x5Dfilename.ext\x5B\x2Fattachment\x5D',
										s: 'Font\x20colour\x3A\x20\x5Bcolor\x3Dred\x5Dtext\x5B\x2Fcolor\x5D\x20or\x20\x5Bcolor\x3D\x23FF0000\x5Dtext\x5B\x2Fcolor\x5D',
										f: 'Font\x20size\x3A\x20\x5Bsize\x3D85\x5Dsmall\x20text\x5B\x2Fsize\x5D',
										y: 'List\x3A\x20Add\x20list\x20element',
										d: 'Flash\x3A\x20\x5Bflash\x3Dwidth,height\x5Dhttp\x3A\x2F\x2Furl\x5B\x2Fflash\x5D',
										cb_22: '',
										cb_24: ''
									}

									function change_palette() {
										phpbb.toggleDisplay('colour_palette');
										e = document.getElementById('colour_palette');

										if (e.style.display == 'block') {
											document.getElementById('bbpalette').value = 'Hide\x20font\x20colour';
										} else {
											document.getElementById('bbpalette').value = 'Font\x20colour';
										}
									}

									// ]]>
								</script>

								<div id="colour_palette" style="display: none;">
									<dl style="clear: left;">
										<dt>
											<label>Font colour:</label>
										</dt>
										<dd id="color_palette_placeholder" class="color_palette_placeholder" data-orientation="h" data-height="12" data-width="15"
										    data-bbcode="true"></dd>
									</dl>
								</div>

								<div id="format-buttons" class="format-buttons">
									<button type="button" class="button button-icon-only bbcode-b" accesskey="b" name="addbbcode0" value=" B " onclick="bbstyle(0)"
									    title="Bold text: [b]text[/b]">
										<i class="icon fa-bold fa-fw" aria-hidden="true"></i>
									</button>
									<button type="button" class="button button-icon-only bbcode-i" accesskey="i" name="addbbcode2" value=" i " onclick="bbstyle(2)"
									    title="Italic text: [i]text[/i]">
										<i class="icon fa-italic fa-fw" aria-hidden="true"></i>
									</button>
									<button type="button" class="button button-icon-only bbcode-u" accesskey="u" name="addbbcode4" value=" u " onclick="bbstyle(4)"
									    title="Underline text: [u]text[/u]">
										<i class="icon fa-underline fa-fw" aria-hidden="true"></i>
									</button>
									<button type="button" class="button button-icon-only bbcode-quote" accesskey="q" name="addbbcode6" value="Quote" onclick="bbstyle(6)"
									    title="Quote text: [quote]text[/quote]">
										<i class="icon fa-quote-left fa-fw" aria-hidden="true"></i>
									</button>
									<button type="button" class="button button-icon-only bbcode-code" accesskey="c" name="addbbcode8" value="Code" onclick="bbstyle(8)"
									    title="Code display: [code]code[/code]">
										<i class="icon fa-code fa-fw" aria-hidden="true"></i>
									</button>
									<button type="button" class="button button-icon-only bbcode-list" accesskey="l" name="addbbcode10" value="List" onclick="bbstyle(10)"
									    title="List: [list][*]text[/list]">
										<i class="icon fa-list fa-fw" aria-hidden="true"></i>
									</button>
									<button type="button" class="button button-icon-only bbcode-list-" accesskey="o" name="addbbcode12" value="List=" onclick="bbstyle(12)"
									    title="Ordered list: e.g. [list=1][*]First point[/list] or [list=a][*]Point a[/list]">
										<i class="icon fa-list-ol fa-fw" aria-hidden="true"></i>
									</button>
									<button type="button" class="button button-icon-only bbcode-asterisk" accesskey="y" name="addlistitem" value="[*]" onclick="bbstyle(-1)"
									    title="List item: [*]text">
										<i class="icon fa-asterisk fa-fw" aria-hidden="true"></i>
									</button>
									<button type="button" class="button button-icon-only bbcode-img" accesskey="p" name="addbbcode14" value="Img" onclick="bbstyle(14)"
									    title="Insert image: [img]http://image_url[/img]">
										<i class="icon fa-image fa-fw" aria-hidden="true"></i>
									</button>
									<button type="button" class="button button-icon-only bbcode-url" accesskey="w" name="addbbcode16" value="URL" onclick="bbstyle(16)"
									    title="Insert URL: [url]http://url[/url] or [url=http://url]URL text[/url]">
										<i class="icon fa-link fa-fw" aria-hidden="true"></i>
									</button>
									<button type="button" class="button button-icon-only bbcode-color" name="bbpalette" id="bbpalette" value="Font colour" onclick="change_palette();"
									    title="Font colour: [color=red]text[/color] or [color=#FF0000]text[/color]">
										<i class="icon fa-tint fa-fw" aria-hidden="true"></i>
									</button>
									<select name="addbbcode20" class="bbcode-size" onchange="bbfontstyle('[size=' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + ']', '[/size]');this.form.addbbcode20.selectedIndex = 2;"
									    title="Font size: [size=85]small text[/size]">
										<option value="50">Tiny</option>
										<option value="85">Small</option>
										<option value="100" selected="selected">Normal</option>
										<option value="150">Large</option>
										<option value="200">Huge</option>
									</select>


									<button type="button" class="button button-secondary bbcode-longlist" name="addbbcode22" value="longlist" onclick="bbstyle(22)"
									    title="">
										longlist
									</button>
									<button type="button" class="button button-secondary bbcode-spoiler" name="addbbcode24" value="spoiler" onclick="bbstyle(24)"
									    title="">
										spoiler
									</button>
								</div>

								<div id="smiley-box" class="smiley-box">
									<strong>Smilies</strong>
									<br />
									<a href="#" onclick="insert_text(':D', true); return false;">
										<img src="./images/smilies/icon_e_biggrin.gif" width="15" height="17" alt=":D" title="Very Happy" />
									</a>
									<a href="#" onclick="insert_text(':)', true); return false;">
										<img src="./images/smilies/icon_e_smile.gif" width="15" height="17" alt=":)" title="Smile" />
									</a>
									<a href="#" onclick="insert_text(';)', true); return false;">
										<img src="./images/smilies/icon_e_wink.gif" width="15" height="17" alt=";)" title="Wink" />
									</a>
									<a href="#" onclick="insert_text(':(', true); return false;">
										<img src="./images/smilies/icon_e_sad.gif" width="15" height="17" alt=":(" title="Sad" />
									</a>
									<a href="#" onclick="insert_text(':o', true); return false;">
										<img src="./images/smilies/icon_e_surprised.gif" width="15" height="17" alt=":o" title="Surprised" />
									</a>
									<a href="#" onclick="insert_text(':shock:', true); return false;">
										<img src="./images/smilies/icon_eek.gif" width="15" height="17" alt=":shock:" title="Shocked" />
									</a>
									<a href="#" onclick="insert_text(':?', true); return false;">
										<img src="./images/smilies/icon_e_confused.gif" width="15" height="17" alt=":?" title="Confused" />
									</a>
									<a href="#" onclick="insert_text('8-)', true); return false;">
										<img src="./images/smilies/icon_cool.gif" width="15" height="17" alt="8-)" title="Cool" />
									</a>
									<a href="#" onclick="insert_text(':lol:', true); return false;">
										<img src="./images/smilies/icon_lol.gif" width="15" height="17" alt=":lol:" title="Laughing" />
									</a>
									<a href="#" onclick="insert_text(':x', true); return false;">
										<img src="./images/smilies/icon_mad.gif" width="15" height="17" alt=":x" title="Mad" />
									</a>
									<a href="#" onclick="insert_text(':P', true); return false;">
										<img src="./images/smilies/icon_razz.gif" width="15" height="17" alt=":P" title="Razz" />
									</a>
									<a href="#" onclick="insert_text(':oops:', true); return false;">
										<img src="./images/smilies/icon_redface.gif" width="15" height="17" alt=":oops:" title="Embarrassed" />
									</a>
									<a href="#" onclick="insert_text(':cry:', true); return false;">
										<img src="./images/smilies/icon_cry.gif" width="15" height="17" alt=":cry:" title="Crying or Very Sad" />
									</a>
									<a href="#" onclick="insert_text(':evil:', true); return false;">
										<img src="./images/smilies/icon_evil.gif" width="15" height="17" alt=":evil:" title="Evil or Very Mad" />
									</a>
									<a href="#" onclick="insert_text(':twisted:', true); return false;">
										<img src="./images/smilies/icon_twisted.gif" width="15" height="17" alt=":twisted:" title="Twisted Evil" />
									</a>
									<a href="#" onclick="insert_text(':roll:', true); return false;">
										<img src="./images/smilies/icon_rolleyes.gif" width="15" height="17" alt=":roll:" title="Rolling Eyes" />
									</a>
									<a href="#" onclick="insert_text(':!:', true); return false;">
										<img src="./images/smilies/icon_exclaim.gif" width="15" height="17" alt=":!:" title="Exclamation" />
									</a>
									<a href="#" onclick="insert_text(':?:', true); return false;">
										<img src="./images/smilies/icon_question.gif" width="15" height="17" alt=":?:" title="Question" />
									</a>
									<a href="#" onclick="insert_text(':idea:', true); return false;">
										<img src="./images/smilies/icon_idea.gif" width="15" height="17" alt=":idea:" title="Idea" />
									</a>
									<a href="#" onclick="insert_text(':arrow:', true); return false;">
										<img src="./images/smilies/icon_arrow.gif" width="15" height="17" alt=":arrow:" title="Arrow" />
									</a>
									<a href="#" onclick="insert_text(':|', true); return false;">
										<img src="./images/smilies/icon_neutral.gif" width="15" height="17" alt=":|" title="Neutral" />
									</a>
									<a href="#" onclick="insert_text(':mrgreen:', true); return false;">
										<img src="./images/smilies/icon_mrgreen.gif" width="15" height="17" alt=":mrgreen:" title="Mr. Green" />
									</a>
									<a href="#" onclick="insert_text(':geek:', true); return false;">
										<img src="./images/smilies/icon_e_geek.gif" width="17" height="17" alt=":geek:" title="Geek" />
									</a>
									<a href="#" onclick="insert_text(':ugeek:', true); return false;">
										<img src="./images/smilies/icon_e_ugeek.gif" width="17" height="18" alt=":ugeek:" title="Uber Geek" />
									</a>
									<div class="bbcode-status">
										<hr />
										<a href="/demo/h2o/3.2/3/app.php/help/bbcode">BBCode</a> is
										<em>ON</em>
										<br /> [img] is
										<em>ON</em>
										<br /> [flash] is
										<em>OFF</em>
										<br /> [url] is
										<em>ON</em>
										<br /> Smilies are
										<em>ON</em>
									</div>
								</div>


								<div id="message-box" class="message-box">
									<textarea name="message" id="message" rows="15" cols="76" tabindex="4" onselect="storeCaret(this);" onclick="storeCaret(this);"
									    onkeyup="storeCaret(this);" onfocus="initInsertions();" class="inputbox"></textarea>
								</div>

							</fieldset>


						</div>
					</div>

					<div class="panel bg2">
						<div class="inner">
							<fieldset class="submit-buttons">
								<input type="submit" accesskey="s" tabindex="6" name="post" value="Submit" class="button1 default-submit-action" />&nbsp;

							</fieldset>

						</div>
					</div>
					</div>

				</form>
			</div>
		</div>
		<!-- /#inner-wrap -->
<?php require_once './inc/footer.php'?>
		