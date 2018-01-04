<div class="content">
	<div class="content-wrapper">
		<div style="margin-top: 30px;" class="view-col">
			<?php
			$list = $topic->get_topic_details($_GET['topic']);

			foreach($list as $value);
			?>
			<div class="trend">
				<div class="trend-title">
					<h2><?php echo $value['to_title'];?></h2>
					<h5>Posted on <?php $date=date_create($value['to_datetime_added']);echo date_format($date,"M d, Y g:ia");?></br> By <span style="font-weight: bold;"><?php echo $user->get_name($value['usr_id']);?></span></h5>
				</div>
				<div class="trend-desc">
					<p><?php echo $value['to_description'];?></p>
				</div>
				<?php
				?>
				<div class="trend-controls">
					<?php
					$checklike = $topic->check_like($_GET['topic'],$_SESSION['userid']);
					if($checklike){
					?>
					<span style="float: left; padding: 8px;"><a href="#" class="remove-link like-button" onclick="sendLike()">&#x2729; Like</a></span>
					<?php
					}else{?>
					<span style="float: left; padding: 8px;"><a style="color: blue;" class="remove-link">&#9733; Liked</a></span>
					<?php
					}
					?>
					<span style="float: left; padding: 8px;"><a href="#" class="remove-link report-button" onclick="sendLike()"> &#x26A0; Report</a></span>
					<span style="float: left; padding: 8px;"><a href="#" class="remove-link delete-button" onclick="sendLike()">&#x2716; Delete</a></span>
					<span style="color: grey;"><?php echo $topic->count_likes($_GET['topic']);?> likes</span>
					<span style="color: grey;"><?php echo $topic->count_comment($_GET['topic']);?> comments</span>
				</div>
			</div><hr>
			<div class="comment-section col50">
				<h4>Comments (<?php echo $topic->count_comment($_GET['topic']);?>)</h4>
				<form id="form1" name="form1" method="POST" action="process.php?&topic=<?php echo $_GET['topic'];?>&action=comment">
					<textarea name="comment" id="textarea" class="input-textarea" cols="62" rows="5"></textarea>
					<input style="float: right;" class="input-button" type="submit" value="Submit">
				</form>
				<div class="user-comments-wrapper">
				<?php
				$com = $topic->get_comments($_GET['topic']);
				if($com){
					foreach($com as $value){
				?>
					<div class="user-comments">
						<h4><a class="remove-link" style="color: blue;" href="index.php?mod=profile&user=<?php echo $value['usr_id'];?>"><?php echo $user->get_name($value['usr_id']);?></a></h4>
						<h5><?php $date=date_create($value['comment_datetime_added']);echo date_format($date,"M d, Y g:ia");?></h5>
						<p><?php echo $value['tr_comment'];?></p>
						<hr>
					</div>
				<?php
					}
				}else{
					?><div class="user-comments">
						<h4>Do you have something to share?</h4>
						<h5></h5>
						<p>Please post a comment below</p>
						<hr>
					</div>
					<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function sendLike(){
	window.location.assign("process.php?action=like&topic="+<?php echo $_GET['topic'];?>);
}
</script>