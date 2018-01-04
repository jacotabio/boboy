<div class="content">
	<div class="header-2">
		<h2>CREATE</h2>
		<p>Submit any kind of information that can help the filipino community.</p>
	</div>
	<div class="content-wrapper">
		<div class="view-col">
			<div class="guidelines">
				<p style="font-weight: bold; margin-bottom: 0;">Forum Guidelines:</p></br>
				1.) Remember that this is a social media, be mindful when posting.</br>
				2.)	Always use English as much as possible.</br>
				3.) No hoax/fake news or trends, we have no time for stupidity.</br>
				4.)	Don't post any personal information of any person.</br>
				5.) Once your post has been reported up to five (5) times, you will be automatically banned from this site.</br>
				6.) Please follow proper post format:</br>
				<div class="guidelines-format">
					-Title</br>
					-Description</br>
					-Signature</br>
					OPTIONAL: State area/location</br>
				</div>

			</div>
			<div class="content-title">
				<h2>Fill-up Form</h2>
				<hr style="margin-top: -10px;">
			</div>
			<div class="trend">
				<form id="form1" name="form1" method="post" action="process.php?action=submit">
					<div style="display: inline-block;" class="col50">
						<label class="label-title">Title</label></br>
						<input type="text" class="input-text" name="title" placeholder="Title" required>
					</div>
					<div style="display: inline-block; margin-left: 15px;" class="col20">
						<label class="label-title">Category</label></br>
						<select class="input-text" name="cat">
						<?php
						$list = $topic->get_category();

						foreach($list as $value){
						?>
							<option value="<?php echo $value['cat_id'];?>"><?php echo $value['cat_name'];?></option>
						<?php
						}
						?>
						</select>
					</div>
					
					<div class="col50">
						<textarea name="desc" id="textarea" class="input-textarea" cols="128" rows="10" placeholder="Write your description here.."></textarea>
					</div>
					<input style="float:right;" class="input-button" type="submit" name="button" id="button" value="Submit" />
				</form>
			</div>
		</div>
	</div>
</div>