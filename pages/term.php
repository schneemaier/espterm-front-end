<?php if (!DEBUG): ?>
<script>
	// Workaround for badly loaded page
	setTimeout(function() {
		if (typeof termInit == 'undefined') {
			console.error("Page load failed, refreshing…")
			location.reload(true)
		}
	}, 3000);
</script>
<?php endif; ?>

<div class="Modal light hidden" id="fu_modal">
	<div id="fu_form" class="Dialog">
		<div class="fu-content">
			<h2><?= tr('upload.title') ?></h2>
			<p>
				<label for="fu_file"><?= tr('upload.prompt') ?></label>
				<input type="file" id="fu_file" accept="text/*" /><br>
				<textarea id="fu_text"></textarea>
			</p>
			<p>
				<label for="fu_crlf"><?= tr('upload.endings') ?></label>
				<select id="fu_crlf">
					<option value="CR"><?= tr('upload.endings.cr') ?></option>
					<option value="CRLF"><?= tr('upload.endings.crlf') ?></option>
					<option value="LF"><?= tr('upload.endings.lf') ?></option>
				</select>
			</p>
			<p>
				<label for="fu_delay"><?= tr('upload.chunk_delay') ?></label>
				<input id="fu_delay" type="number" value=1 min=0>
			</p>
			<p>
				<label for="fu_chunk"><?= tr('upload.chunk_size') ?></label>
				<input id="fu_chunk" type="number" value=0 min=0 max=100>
			</p>
		</div>
		<div class="fu-buttons">
			<button id="term-fu-start" class="icn-ok x-fu-go"><?= tr('start') ?></button>&nbsp;
			<button id="term-fu-close" class="icn-cancel x-fu-cancel"><?= tr('cancel') ?></button>&nbsp;
			<i class="fu-prog-box"><?= tr('upload.progress') ?> <span id="fu_prog"></span></i>
		</div>
	</div>
</div>

<h1 id="screen-title">ESPTerm</h1>
<a href="#" id="term-fit-screen" class="mq-tablet-max"><i id="resize-button-icon" class="icn-resize-small"></i></a>

<div id="term-wrap">
	<div id="screen">
		<input id="softkb-input" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<div id="touch-select-menu">
			<button id="touch-select-copy-btn"><?= tr('copy') ?></button>
		</div>
		<div class="screen-margin top"></div>
		<div class="screen-margin left"></div>
		<div class="screen-margin right"></div>
		<div class="screen-margin bottom"></div>
	</div>

	<div id="action-buttons" class="hidden"><!-- JS, buttons --></div>
</div>

<nav id="term-nav">
	<a href="#" id="term-kb-open" class="mq-tablet-max"><i class="icn-keyboard"></i><span><?= tr('term_nav.keybd') ?></span></a><!--
	--><a href="#" id="term-fu-open"><i class="icn-download"></i><span><?= tr('term_nav.upload') ?></span></a><!--
	--><a href="<?= url('cfg_term') ?>" class="x-term-conf-btn"><i class="icn-configure"></i><span><?= tr('term_nav.config') ?></span></a><!--
	--><a href="<?= url('cfg_wifi') ?>" class="x-term-conf-btn"><i class="icn-wifi"></i><span><?= tr('term_nav.wifi') ?></span></a><!--
	--><a href="<?= url('help') ?>" class="x-term-conf-btn"><i class="icn-help"></i><span><?= tr('term_nav.help') ?></span></a><!--
	--><a href="<?= url('about') ?>" class="x-term-conf-btn"><i class="icn-about"></i><span><?= tr('term_nav.about') ?></span></a>
</nav>

<script>
  try {
    window.noAutoShow = true;
    termInit({ allFn: !!+'%want_all_fn%', });
  } catch (e) {
    console.error(e);
	  <?php if (!DEBUG): ?>
    console.error("Fail, reloading in 3s…");
    setTimeout(function () {
      location.reload(true);
    }, 3000);
	  <?php endif; ?>
  }
</script>
