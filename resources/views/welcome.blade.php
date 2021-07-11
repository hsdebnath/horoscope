<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

    
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ config('app.name', 'RMS') }}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('asset/favicon.ico') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('asset/css/styles.css') }}" rel="stylesheet" />

        <script type="text/javascript">
            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
                })
          </script>

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="https://static.thenounproject.com/png/1942107-200.png" width="50"/>&nbsp;Horscope</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#about">About {{$Dates[0]->year}}</a></li>
                    </ul>
                </div>
            </div>
        </nav>
             
        <!-- Masthead-->
        <header class="masthead bg-default text-white text-center page-section portfolio" id="portfolio">

            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">See Your Zodiac Calender </h2>                
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                @php
                    $best_month =array();
                    $sign_best_month = 0;
                @endphp
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
            </div>
            {{-- @php dd($best_year); @endphp  --}}
        </header>

        <!-- Contact Section-->
        <section class="page-section" id="about">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">This Year <span class="text-success">{{$best_year }}'s</span> are the luckiest </h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        {!! Form::open(['action' => ['App\Http\Controllers\Controller@year_filter'] , 'class'=> 'form-inline', 'method' => 'POST']) !!} 
                        @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control" name ="year" id="year" type="text"/>
                                <label for="year">Enter Year (YYYY) Of Which You Wish To Khow About :</label>
                            </div>
                        {{Form::submit('Find Out !', ['class'=>'btn btn-primary btn-xl'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Your Website 2021</small></div>
        </div>   


        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('asset/js/scripts.js') }}"></script>

    </body>
</html>
