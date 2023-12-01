<!-- Portfolio Grid Items-->

<div class="row justify-content-center">
    
    @foreach (Config::get('zodiac.zodiacs') as $zodizc)                   
    <div class="col-md-6 col-lg-4 mb-5">
        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#modal-{{$zodizc['id']}}">
            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                <div class="portfolio-item-caption-content text-center text-white"><img src="{{$zodizc['icon']}}" width="50" />&nbsp; {{$zodizc['name']}}</div>
                </div>
            <img src="{{$zodizc['img']}}" class="img-fluid" alt="{{$zodizc['name']}}" width="100" />
        </div>
    </div>
    <!-- Calander Modal -->
    <div class=" modal fade" id="modal-{{$zodizc['id']}}" tabindex="-1" aria-labelledby="modal-{{$zodizc['id']}}" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body text-center pb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <h3 class="text-dark"> <img src="{{$zodizc['img']}}" class="img-fluid" alt="{{$zodizc['name']}}" width="100" /> Horoscope Calender  [{{$Dates[0]->year}}]</h3>
                                <small class="text-warning">Hover Over Dates To See Fortune Statements</small>
                                <table class="table table-sm table-bordered ">
                                    <tr>
                                        
                                        @php 
                                            $month_counter = 0;  
                                            $month_avg = array();
                                            $month_total_score = 0; 
                                            $day_count = 0 ; 
                                        @endphp
                                        @foreach ($Dates->unique('month') as $monthsData)
                                            <td>    
                                            <table class="table table-sm">
                                            <tr>
                                                <th colspan="7">{{date_format(date_create($monthsData->month.'/1/2021'),'F')}}</th>
                                            </tr>
                                            <tr>
                                                <td>Sun</td>
                                                <td>Mon</td>
                                                <td>tue</td>
                                                <td>Wed</td>
                                                <td>Thus</td>
                                                <td>Fri</td>
                                                <td>sat</td>
                                            </tr>
                                            @php $week_counter =0; @endphp
                                            <tr>
                                            @foreach ($Dates as $dates_data)
                                                @if ($dates_data->month == $monthsData->month)
                                                    @php
                                                        $sentance= Config::get('sentance.common_sentances.'.rand(1,4)).' '.Config::get('sentance.score_sentances.'.$dates_data->Scores[$zodizc['id']-1]->score.'.'.rand(0,2)); 
                                                    @endphp
                                                    @if ($dates_data->day == '01')
                                                        
                                                        @php $n = (date_format(date_create($dates_data->month.'/'.$dates_data->day.'/'.$Dates[0]->year),'w')); @endphp

                                                        @while (--$n >= 0)
                                                            <td></td> 
                                                            @php
                                                             $week_counter ++; 
                                                             @endphp
                                                            
                                                        @endwhile
                                                        
                                                        <td ><button style="background-color:{{Config::get('zodiac.colors.'.$dates_data->Scores[$zodizc['id']-1]->score)}}" data-toggle="tooltip" data-placement="top" title="{{$sentance}}">{{$dates_data->day}} </button>
                                                        
                                                        </td> @php $week_counter ++; @endphp 
                                                        {{-- {{Config::get('sentance.score_sentances'.$dates_data->Scores[$zodizc['id']-1]->score.rand(1,3))}} --}}
                                                        
                                                    @else
                                                        <td ><button style="background-color:{{Config::get('zodiac.colors.'.$dates_data->Scores[$zodizc['id']-1]->score)}}" data-toggle="tooltip" data-placement="top" title="{{$sentance}}">{{$dates_data->day}} </button>
                                                        </td> @php $week_counter ++; @endphp
                                                    @endif    
                                                    
                                                    @if ($week_counter >= 7)
                                                        </tr><tr>
                                                        @php $week_counter =0; @endphp                                                        
                                                    @endif

                                                    @php 
                                                        $month_total_score += $dates_data->Scores[$zodizc['id']-1]->score; 
                                                        $day_count ++ ; 
                                                    @endphp                                                        
                                                    
                                                @endif
                                            @endforeach   
                                            
                                            @php 
                                                $month_total_score += $dates_data->Scores[$zodizc['id']-1]->score; 
                                                $day_count ++ ; 

                                                $month_avg += [intval($monthsData->month) => $month_total_score/$day_count]
                                            @endphp         

                                            </table>
                                             </td>
                                            @php $month_counter ++; @endphp
                                            
                                            @if($month_counter >= 4)
                                                @php $month_counter = 0; @endphp    
                                            </tr>
                                            <tr>
                                            @endif 
                                        @endforeach
                                        <h5 class="text-primary">This Year <span class="text-success">{{date_format(date_create($sign_best_month.'/1/'.$monthsData->year),'F')}}</span> is the Luckiest month for {{$zodizc['name']}} </h5>
                                        @php    
                                        $sign_best_month = array_search(max($month_avg), $month_avg);
                                        $best_month += [$zodizc['name'] => $sign_best_month];
                                        @endphp
                                        </td> 
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @php    
    $best_month += [$zodizc['name'] => $sign_best_month];
    $best_year = array_search(max($best_month), $best_month);
    @endphp
</div>