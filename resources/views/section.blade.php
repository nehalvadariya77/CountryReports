<!-- Start section area -->
<div class="col-md-12 section-area">
	<div class="row">
		<div class="col-sm-5 col-md-5"></div>
		<div class="col-sm-5 col-md-5">
			<label class="control-label">Section Title</label>
			<input type="text" class="form-control" name="section_title[{{$chapterCount}}][{{$sectionCount}}]" value="" placeholder="Enter Section Title">
			<div id="section_title_err" class="error">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5 col-md-5"></div>
		<div class="col-sm-5 col-md-5">
			<label class="control-label">Section Data</label>
			<textarea class="form-control" name="section_data[{{$chapterCount}}][{{$sectionCount}}]" rows="3"></textarea>
			<div id="section_data_err" class="error">
			</div>
		</div>
	</div>
</div>
<!-- End Section Area -->