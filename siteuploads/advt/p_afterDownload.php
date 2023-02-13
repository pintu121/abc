<div>
			<?php if($files->extension=='MP3' || $files->extension=='WAV' || $files->extension=='MID'): ?>
			
<object type="application/x-shockwave-flash" data="/player2.swf" width="300" height="20">
    <param name="movie" value="/player2.swf" />
    <param name="bgcolor" value="#ffffff" />
    <param name="FlashVars" value="mp3=/files/download/id/<?=$files->id;?>&showstop=1&showvolume=1&bgcolor1=189ca8&bgcolor2=085c68" />
</object>
</div>
<?php endif; ?>
