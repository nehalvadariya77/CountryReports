<!-- Start chapter area -->
<div class="col-md-12">
	<div class="chapter-area" id="chapter_{{$chapterCount}}" onscroll="OnScroll(this)">
		<div class="row">
			<div class="col-sm-3 col-md-3"></div>
			<div class="col-sm-5 col-md-5">
				<label class="control-label">Chapter Title</label>
				<input type="text" class="form-control" name="chapter_title[{{$chapterCount}}]" value="" placeholder="Enter Chapter Title">
				<div id="chapter_title_err" class="error">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3 col-md-3"></div>
			<div class="col-sm-5 col-md-5">
				<label class="control-label">Chapter Data</label>
				<textarea class="form-control" name="chapter_data[{{$chapterCount}}]" rows="3"></textarea>
				<div id="chapter_data_err" class="error">
				</div>
			</div>
		</div>
		<div class="row sections">
			<div class="col-sm-3 col-md-3"></div>
	        <div class="col-sm-5 col-md-5">
	            <label class="control-label section-label">Sections</label>
	        </div>
	        <div class="col-sm-1 col-md-1"><button type="button" id="section_{{$chapterCount}}" data-sectioncount="1" data-chaptercount="{{$chapterCount}}" class="section-add btn btn-primary">+</button></div>
	    </div>
    	<div class="sectionData_{{$chapterCount}}"></div>
    </div>
</div>
<!-- End Chapter area -->