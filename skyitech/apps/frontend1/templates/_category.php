<?php
	$category = skyMysqlQuery("select id, category_name, child, flag_new, flag_updated, flag_hot, files, url from category where status='A' and parents='|' order by ord asc");
	myUser::getc('RGlzcGxheSBjYXRlZ29yeSBsaXN0',1);
?>
<div id="cateogry">
	<h2>Select Categories</h2>
	<div class="catList">
		<?php while($value = mysql_fetch_object($category)):?>
		<div class="catRow">
			<?php 
				if($value->child=='D'):
					echo '<a href="'.url_for('/category/list/?parent='.$value->id.'&fname='.myUser::slugify($value->category_name)).'"><div>';
				//	echo '&raquo;&nbsp;';
					echo $value->category_name.' '.($value->files?'['.$value->files.']':'');
				elseif($value->child=='U'):
					echo '<a href="'.$value->url.'"><div>';
				//	echo '&raquo;&nbsp;';
					echo $value->category_name;
				else:
					echo '<a href="'.url_for('/files/list/?parent='.$value->id.'&fname='.myUser::slugify($value->category_name)).'"><div>';
				//	echo '&raquo;&nbsp;';
					echo $value->category_name.' '.($value->files?'['.$value->files.']':'');
				endif;
			?>
			<?php
				if($value->flag_new)
					echo image_tag('new.gif');
				if($value->flag_updated)
					echo image_tag('updated.gif');
				if($value->flag_hot)
					echo image_tag('hot.gif');
			?></div></a>
		</div>
		<?php endwhile;?>
	</div>
</div>
