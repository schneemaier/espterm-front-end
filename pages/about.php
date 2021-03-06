<div class="Box">
	<img src="/img/cvut.svg" id="logo" class="mq-tablet-min">
	<h2>ESP8266 Remote Terminal</h2>

	<img src="/img/cvut.svg" id="logo2" class="mq-phone" noprint>

	<p>
		&copy; Ondřej Hruška, 2016-2017
		&lt;<a href="mailto:ondra@ondrovo.com">ondra@ondrovo.com</a>&gt;
	</p>

	<p>
		<a href="http://measure.feld.cvut.cz/" target="blank">Katedra měření, FEL ČVUT</a><br>
		Department of Measurement, FEE CTU
	</p>
</div>

<div class="Box">
	<h2>Version</h2>
	<div class="tscroll">
	<table>
		<tr>
			<th>ESPTerm</th>
			<td>v%vers_fw%, built %date% at~%time%</td>
		</tr>
		<tr>
			<th>Git hash</th>
			<td>back-end: <a href="%githubrepo%/commit/%hash_backend%">%hash_backend%</a>,
				front-end: <a href="%githubrepo_front%/commit/%hash_frontend%">%hash_frontend%</td>
		</tr>
		<tr>
			<th>libesphttpd</th>
			<td>v%vers_httpd%</td>
		</tr>
		<tr>
			<th>ESP&nbsp;IoT&nbsp;SDK</th>
			<td>v%vers_sdk%</td>
		</tr>
	</table>
	</div>
</div>

<div class="Box">
	<h2>Issues</h2>
	<p>
		Please report any issues to our <a href="%githubrepo%/issues">bugtracker</a> or send them by e-mail.
	</p>
	<p>
		ESPTerm has a <a href="https://groups.google.com/forum/#!forum/espterm-dev">mailing list</a> for
		troubleshooting and release announcements.
	</p>
	<p>
		Firmware updates can be downloaded from the <a href="%githubrepo%/releases">releases page</a> and flashed
		with <a href="https://github.com/espressif/esptool">esptool.py</a>.
	</p>
</div>

<div class="Box">
	<h2>Contributing</h2>
	<p>
		<i class="icn-github"></i> You're welcome to submit your improvements and ideas to our <a href="%githubrepo%">GitHub repository</a>!
	</p>

	<p>
		<i class="icn-donate"></i> If you'd like to donate, please try <a href="https://paypal.me/mightypork">PayPal</a> or
		<a href="https://liberapay.com/MightyPork/">LiberaPay</a>.
	</p>
</div>

<div class="Box">
	<h2>Thanks</h2>
	<p><i>…for making this project possible, in no particular order, go to:</i></p>
	<ul style="padding-left: 20px">
		<li>
			*Jeroen "SpriteTM" Domburg,* for writing the <a href="https://github.com/Spritetm/esphttpd">esphttpd</a>
			server library we use (as a <a href="https://github.com/MightyPork/libesphttpd">fork</a>)
		</li>
		<li>
			*Kyle Barrow,* for writing the <a href="https://github.com/kylebarrow/chibi">chibi.js</a> library
			we use instead of jQuery
		</li>
		<li>
			*cpsdqs,* for rewriting the front-end to use HTML5 canvas and other JS improvements
		</li>
		<li>
			*Guenter Honisch,* for finding bugs and suggesting many improvements
		</li>
		<li>
			*doc. Jan Fischer,* who came up with the original idea
		</li>
	</ul>
</div>
