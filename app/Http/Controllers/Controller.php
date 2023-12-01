<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Dates;
use App\Models\Scores;
Use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){

        $year = now()->year;

        $exists = Dates::where('year', '=', $year)->first();
        if ($exists) {

            $Dates = Dates::where('year', $year)->with('Scores')->get(); 
            return view('home')->with('Dates', $Dates);
        }else{

            $data = $this->generate_horoscope($year);
           if ($data) {
            $Dates = Dates::where('year', $year)->with('Scores')->get();
            return view('home')->with('Dates', $Dates);   
           }
           else {
               dd("hay hay");
           }
            
        }
        
    }   

    public function year_filter(Request $request){

        $request->validate([
            'year' => 'required|digits:4|integer|min:1950|max:2050'
        ]);
        
        $year = $request->input('year');


        $exists = Dates::where('year', '=', $year)->first();
        if ($exists) {

            $Dates = Dates::where('year', $year)->with('Scores')->get();
            return view('home')->with('Dates', $Dates);
        }else{

            $data = $this->generate_horoscope($year);
           if ($data) {
            $Dates = Dates::where('year', $year)->with('Scores')->get(); 
            return view('home')->with('Dates', $Dates);   
           }
           else {
               dd("hay hay");
           }
            
        }

    }

    public function generate_horoscope($year){

        $input_year = $year;
        $start = "1/1/".$year;                                    
        $date = date_create($start);
        
        $prev_year = "";
        $prev_month = "";
        $prev_day = "";
        try{
            while(date_format($date,"Y") == $input_year){

                $year = date_format($date,"Y");
                $month = date_format($date,"m");
                $day = date_format($date,"d");
    
                $Dates = new Dates;
                $Dates->year = $year;
                $Dates->month = $month;
                $Dates->day = $day;
                $Dates->save();
    
                // assign scores to zodiacs //
                $date_id = Dates::find($Dates->id);
                
                for ($i=1; $i <=12 ; $i++) { 
                    
                    $score = rand(1,10);
    
                    $Scores = new Scores;
                    $Scores->dates_id = $date_id->id;
                    $Scores->zodiacs_id = $i;
                    $Scores->score = $score;
                    $Scores->save();
                }
                //date increment 
                $date = $date->modify('+1 day');
            }
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }

        return true;
    }
}
