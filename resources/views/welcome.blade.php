<x-app-layout pageName="Country Reports | Home" title="Country Reports">
</x-app-layout>
<div class="row">
    <div class="col-md-4 json-data">
        <h2>JSON Data</h2>
        <div>
            @if(!empty($countryReport))
                @foreach($countryReport as $report)
                    <?php 
                    $json = json_decode($report->data); 
                    echo "<pre class='json-disply'>";print_r(json_encode($json,JSON_PRETTY_PRINT)); ?>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-md-7 title">
        <h2>Add Country Report</h2>
        <form method="post" class="form-horizontal upload" action="{{route('country.countryReportData')}}" name="upload" id="upload" enctype="multipart/form-data">
            {!! csrf_field() !!}
                <div class="col-sm-5 col-md-5">
                    <label class="control-label">Country Name*</label>
                    <select class="form-control" id="country_name" name="country_name">
                        <option value="0">Select Country</option>
                        @foreach($countryNames as $country)
                            <option value="{{$country->name}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                    <div id="country_name_err" class="error"></div>                                 
                </div>
                <div class="col-sm-5 col-md-5">
                    <label class="control-label">Language*</label>
                    <input type="text" class="form-control" id="language" name="language" value="" placeholder="Enter Language">
                    <div id="language_err" class="error"></div>                                
                </div>

                <div class="row chapters">
                    <div class="col-sm-5 col-md-5">
                        <label class="control-label chapter-label">Chapters*</label>
                    </div>
                    <div class="col-sm-1 col-md-1"><button type="button" data-chaptercount="1"  class="chapter-add btn btn-primary">+</button></div>
                </div>
                <div class="chapterData"></div>
            
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-success submit-btn">Submit</button>
                    </div>
                </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{!! asset('js/toastr/toastr.min.js') !!}"></script>
<script type="text/javascript">
        
        //add new chapter
        $(document).on('click', '.chapter-add', function(){
            var chapterCount = $(this).attr('data-chaptercount');
            $(this).attr('data-chaptercount', parseInt(chapterCount)+1);
            //alert(chapterCount)
            $.ajax({
                url: "{{ route('country.chapterData') }}",
                type:'POST',
                headers:{ 'X-CSRF-Token' : "{!! csrf_token() !!}" },
                data: {chapterCount:chapterCount},
                dataType: "json",
                success: function(data)
                {
                    $('.chapterData').prepend(data.html);
                }
            });
        });

        //add new section
        $(document).on('click', '.section-add', function(){
            var sectionCount = $(this).attr('data-sectioncount');
            var chapterCount = $(this).attr('data-chaptercount');
            var newSectionCount = parseInt(sectionCount)+1;
            $(this).attr('data-sectioncount', newSectionCount);
            $.ajax({
                url: "{{ route('country.sectionData') }}",
                type:'POST',
                headers:{ 'X-CSRF-Token' : "{!! csrf_token() !!}" },
                data: {sectionCount:sectionCount,chapterCount:chapterCount},
                dataType: "json",
                success: function(data)
                {
                    $('.sectionData_'+chapterCount).prepend(data.html);
                }
            });
        });

        //scroll up/down in each section vertically, the other section must scroll up/down
        function OnScroll(div) 
        {
          $('[id^="chapter_"]').each(function(){
            if(div.id != this.id){
               this.scrollTop = div.scrollTop;
             }
          });
        }
   
</script>