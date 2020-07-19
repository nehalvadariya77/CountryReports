<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CountryReports;
use App\User;
use DB;
use File;
use Session;

class CountryController extends Controller
{
	public function index(Request $request)
    {  
    	$countryNames = DB::table('countries')->get();
    	$countryReport = CountryReports::orderBy('id','desc')->get();

    	return view('welcome',['countryNames' => $countryNames,'countryReport' => $countryReport]);
    }

    public function chapterData(Request $request)
    {
    	$chapterCount = $request->input('chapterCount');
    	$dataHtml = view("chapter",compact('chapterCount'))->render();
    	return response()->json(['html'=>$dataHtml]);
    }

    public function sectionData(Request $request)
    {
    	$sectionCount = $request->input('sectionCount');
    	$chapterCount = $request->input('chapterCount');
    	$dataHtml = view("section",compact('sectionCount','chapterCount'))->render();
    	return response()->json(['html'=>$dataHtml]);
    }

    public function countryReportData(Request $request)
    {
    	try 
        {
        	$validator = app('validator')->make($request->input(), [
                'country_name' => 'required|max:100',
                'language' => 'required|max:100'
            ], []);

            if ($validator->fails())
            {
                $flashArr = array(
                    'msg' => $validator->errors()->first(),
                    'status' => 'fail'
                );
                return $flashArr;
            }else{
            	$countryDataLast = DB::table('countries')->where('name',$request->input('country_name'))->first();
            	if(!empty($countryDataLast)){
            		$id = strtolower($countryDataLast->code);
            	}
           		$country_id = $id.'_001';
            	$country_name = $request->input('country_name');
            	$language = $request->input('language');
            	$count = count($request->input('chapter_title'));
            	
            	$chapter = array();
            	if(!empty($request->input('chapter_title')))
            	{
	            	if(count($request->input('chapter_title')) > 0)
	            	{
	            		for($i=1; $i<=$count;$i++)
		                {
		                    $chapter[$i] = array(
		                    	'ID' => $id.'_cpt_'.sprintf("%03d", $i),
		                    	'Title' => $request->input('chapter_title')[$i], 
		                    	'Data' => $request->input('chapter_data')[$i] 
		                    );
		                    
		                    if(!empty($request->input('section_title')[$i]))
            				{
			                    if(count($request->input('section_title')[$i]) > 0)
			                    {
			                    	for($j=1; $j<=count($request->input('section_title')[$i]);$j++)
		                			{
				                    	$chapter[$i]['Sections'][$j] = array(
				                    		'ID' => $id.'_cpt'.sprintf("%02d", $j).'_sec_'.sprintf("%03d", $j),
				                    		'Title' => $request->input('section_title')[$i][$j], 
				                    		'Data' => $request->input('section_data')[$i][$j]
				                    	);
				                    }
			                    }
			                }
		                }
            		}
            	}

            	$data = array(
            		'ID' => $country_id,
            		'Country' => $country_name, 
            		'Language' => $language, 
            		'Chapters' => $chapter
            	);

            	$details = new CountryReports([
    							'data' => json_encode($data),
    							'created_at' => date("Y-m-d H:i:s")
    						]);

            	$details->save();

            	$countryNames = DB::table('countries')->get();

            	return redirect()->route('country.index',['countryNames' => $countryNames]);
            }
        }catch(\Exception $e) {
            \Log::error("Failed to store country report: ".$e->getMessage());            
        }

    }
}