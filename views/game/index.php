<style>
				* {
					font-size: 10px;
				}
				table tr td {
					width: <?php echo $this->cell_size;?>;
					height: <?php echo $this->cell_size;?>;
					font-size: 1px;
				}
	</style>


			<div id='game_content'>
				<?php print_r($this->content);?>
			</div>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
			<script>
				function refresh_game_content() {
					var new_html = jQuery.ajax({
						url: '<?=URL;?>game/refresh',
						type: 'html',
						async: false
					}).responseText;
					jQuery('#game_content').html(new_html);
				}
				setInterval('refresh_game_content()', 1000);
			</script>