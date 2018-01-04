<div class="content">
	<div class="header-1">
		<h2>#FEED</h2>
		<p>Get up to date with the latest news & major trends in Bacolod City.</p>
	</div>
	<div class="content-wrapper">
		<div class="col1">
			<div class="filter-buttons">
				<label class="label-title">Filter By</label>
				<ul class="remove-bullet">
					<li><a class="remove-link" href="index.php">#All</a></li>
				<?php
						$list = $topic->get_category();

						foreach($list as $value){
						?>
							<li><a class="remove-link" href="index.php?filter=<?php echo $value['cat_id'];?>">#<?php echo $string = preg_replace('/\s+/', '', $value['cat_name']);?></a></li>
						<?php
						}
						?>
				</ul>
			</div>
			<div class="feed-controls">
				<form id="form1" name="form1" method="POST" action="process.php?action=search<?php if(isset($_GET['filter'])){?>&filter=<?php echo $_GET['filter'];}?> 	">
					<div class="search-col">
						<input type="text" name="search" class="input-search" placeholder="Search">
					</div>
				</form>
			</div>
			<div class="content-title">
				<h2>What's Happening</h2>
				<hr style="margin-top: -10px;">
			</div>
			<?php
			if(isset($_GET['filter'])){
				$list = $topic->get_topic_cat($_GET['filter']);
			}else{
				$list = $topic->get_all_topic();
			}

			if(isset($_GET['filter']) && isset($_GET['search'])){
				$list = $topic->get_topic_cat_s($_GET['filter'],$_GET['search']);
			}
			if(isset($_GET['search'])){
				$list = $topic->get_all_topic_s($_GET['search']);
			}
			
			if($list){
				foreach($list as $value){
			?>
			<div class="trend">
				<div class="trend-title">
					<h2><a href="index.php?topic=<?php echo $value['to_id'];?>" class="remove-link feed-title"><?php echo $value['to_title'];?></a></h2>
					<h5>Posted on <?php $date=date_create($value['to_datetime_added']);echo date_format($date,"M d, Y g:ia");?> By <a href="index.php?mod=profile&user=<?php echo $value['usr_id'];?>" class="remove-link" style="color: black; font-weight: 500; color: #474747;"><?php echo $user->get_name($value['usr_id']);?></a></h5>
				</div>
				<div class="trend-desc">
					<p><?php echo $value['to_description'];?></p>
				</div>
				<?php
				?>
				<div class="trend-controls">
					<span style="color: grey;"><?php echo $topic->count_likes($value['to_id']);?> likes</span>
					<span style="color: grey;"><?php echo $topic->count_comment($value['to_id']);?> comments</span>
				</div>

			</div><hr>
			<?php
				}
			}else{
				?>
				<span class="error-msg">No Posts Yet :(</span>
				<?php
			}
			?>
		</div>
		<div class="col2">
			<div class="top10-title">
				<?php
				$popular = $topic->get_top_popular();

				if($popular){
				?>
				<h2>Top 10 Most Liked</h2>
				<hr style="margin-top: -10px;">
				<ul class="remove-bullet top-10">
				<?php
					foreach($popular as $p){
				?>
					<li><a href="index.php?topic=<?php echo $p['to_id'];?>" class="remove-link top-10-link"><?php echo $p['to_title'];?></a></li>
				<?php
					}
				}
				?>
				</ul>
			</div>
			<div class="top10-title">
				<?php
				$issues = $topic->get_top_issues();

				if($issues){
				?>
				<h2>Top 10 Issues</h2>
				<hr style="margin-top: -10px;">
				<ul class="remove-bullet top-10">
				<?php
					foreach($issues as $i){
				?>
				<li><a href="index.php?topic=<?php echo $i['to_id'];?>" class="remove-link top-10-link"><?php echo $i['to_title'];?></a></li>
				<?php
					}
				}
				?>
			</ul>
			</div>
		</div>
	</div>
</div>
