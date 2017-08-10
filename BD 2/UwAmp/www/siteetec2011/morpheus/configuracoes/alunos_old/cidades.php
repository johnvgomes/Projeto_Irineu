	<style>
	.ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
	#city { width: 25em; }
	</style>
	<script>
	$(function() {
		var availableTags = [
			         			"ActionScript",
			         			"AppleScript",
			         			"Asp",
			         			"BASIC",
			         			"C",
			         			"C++",
			         			"Clojure",
			         			"Scheme"
			         		];
			         		$( "#tags" ).autocomplete({
			         			source: availableTags
			         		});

		
	});
	</script>
	
		<div class="ui-widget">
	<label for="tags">Tags: </label>
	<input id="tags" />
</div>