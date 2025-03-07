<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudFlixx 🚀 | Explore Cloudscape</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="w-full h-auto min-h-screen flex flex-col">
        <!-- Header Section -->
        @include('header')

        <!-- Banner Section -->
        <div class="w-full h-[512px] flex flex-col relative bg-black">
            <!-- Banner Data -->
            @foreach($banner as $bannerItem)
            @php
            $bannerImage = "{$imageBaseURL}/original{$bannerItem->backdrop_path}";
            @endphp

            <div class="flex flex-row items-center w-full h-full relative slide">

                <!-- Image -->
                <img src="{{$bannerImage}}" class="absolute w-full h-full object-cover" />

                <!-- Overlay -->
                <div class="w-full h-full absolute bg-black bg-opacity-40"></div>

                <div class="w-10/12 flex flex-col ml-28 z-10">
                    <span class="font-bold font-poppins text-4xl text-white pl-10">{{$bannerItem->title}}</span>
                    <span class="font-poppins text-xl text-white w-1/2 line-clamp-2 pl-10">{{$bannerItem->overview}}</span>

                    <a href="/movie/{{$bannerItem->id}}" class="w-fit bg-develobe-500 text-white pl-2 pr-4 py-2 mt-5 ml-10 font-poppins text-sm flex flex-row rounded-full items-center hover:drop-shadow-lg duration-200">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.525 18.025C9.19167 18.2417 8.854 18.254 8.512 18.062C8.17067 17.8707 8 17.575 8 17.175V6.82499C8 6.42499 8.17067 6.12899 8.512 5.93699C8.854 5.74566 9.19167 5.75832 9.525 5.97499L17.675 11.15C17.975 11.35 18.125 11.6333 18.125 12C18.125 12.3667 17.975 12.65 17.675 12.85L9.525 18.025Z" fill="white"></path>
                        </svg>
                        <span>Detail</span>
                    </a>
                </div>
            </div>
            @endforeach

            <!-- Prev Button -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1/12 flex justify-center " onclick="moveSlide(-1)">
                <button class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200 ">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.85 2.9C17.1 3.15 17.225 3.446 17.225 3.788C17.225 4.12933 17.1 4.425 16.85 4.675L9.525 12L16.875 19.35C17.1083 19.5833 17.225 19.875 17.225 20.225C17.225 20.575 17.1 20.875 16.85 21.125C16.6 21.375 16.304 21.5 15.962 21.5C15.6207 21.5 15.325 21.375 15.075 21.125L6.675 12.7C6.575 12.6 6.504 12.4917 6.462 12.375C6.42066 12.2583 6.4 12.1333 6.4 12C6.4 11.8667 6.42066 11.7417 6.462 11.625C6.504 11.5083 6.575 11.4 6.675 11.3L15.1 2.875C15.3333 2.64167 15.6207 2.525 15.962 2.525C16.304 2.525 16.6 2.65 16.85 2.9Z" fill="black"></path>
                    </svg>
                </button>
            </div>

            <!-- Next Button -->
            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1/12 flex justify-center" onclick="moveSlide(1)">
                <button class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200 rotate-180">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.85 2.9C17.1 3.15 17.225 3.446 17.225 3.788C17.225 4.12933 17.1 4.425 16.85 4.675L9.525 12L16.875 19.35C17.1083 19.5833 17.225 19.875 17.225 20.225C17.225 20.575 17.1 20.875 16.85 21.125C16.6 21.375 16.304 21.5 15.962 21.5C15.6207 21.5 15.325 21.375 15.075 21.125L6.675 12.7C6.575 12.6 6.504 12.4917 6.462 12.375C6.42066 12.2583 6.4 12.1333 6.4 12C6.4 11.8667 6.42066 11.7417 6.462 11.625C6.504 11.5083 6.575 11.4 6.675 11.3L15.1 2.875C15.3333 2.64167 15.6207 2.525 15.962 2.525C16.304 2.525 16.6 2.65 16.85 2.9Z" fill="black"></path>
                    </svg>
                </button>
            </div>

            <!-- Indikator -->
            <div class="absolute bottom-0 w-full mb-8">
                <div class="w-full flex flex-row items-center justify-center">
                    @for($pos = 1; $pos
                    <= count($banner); $pos++) <div class="w-2.5 h-2.5 rounded-full mx-5 cursor-pointer dot" onclick="currentSlide({{$pos}})" />
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Top 10 Movies Section -->
    <div class="mt-12">
        <span class=" ml-20 font-poppins font-bold text-xl">Top 10 Movies</span>

        <div class="w-auto flex flex-row overflow-x-auto pl-20 pt-6 pb-10">
            @foreach($topMovies as $movieItem)

            @php
            $original_date = $movieItem->release_date;
            $timestamp = strtotime($original_date);
            $movieYear = date("Y", $timestamp);

            $movieID = $movieItem->id;
            $movieTitle = $movieItem->title;
            $movieRating = $movieItem->vote_average * 10;
            $movieImage = "{$imageBaseURL}/w500{$movieItem->poster_path}"
            @endphp

            <a href="movie/{{$movieID}}" class="group">
                <div class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                    <div class="overflow-hidden rounded-[32px]">
                        <img class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200" src="{{$movieImage}}" />
                    </div>

                    <span class="font-poppins font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">{{$movieTitle}}</span>
                    <span class="font-poppins text-sm mt-1">{{$movieYear}}</span>

                    <div class="flex flex-row mt-1 items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 21H8V8L15 1L16.25 2.25C16.3667 2.36667 16.4627 2.525 16.538 2.725C16.6127 2.925 16.65 3.11667 16.65 3.3V3.65L15.55 8H21C21.5333 8 22 8.2 22.4 8.6C22.8 9 23 9.46667 23 10V12C23 12.1167 22.9873 12.2417 22.962 12.375C22.9373 12.5083 22.9 12.6333 22.85 12.75L19.85 19.8C19.7 20.1333 19.45 20.4167 19.1 20.65C18.75 20.8833 18.3833 21 18 21ZM6 8V21H2V8H6Z" fill="#38B6FF"></path>
                        </svg>
                        <span class="font-inter text-sm ml-1">{{$movieRating}}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- Top 10 Tv Shows Section -->
    <div>
        <span class=" ml-20 font-poppins font-bold text-xl">Top 10 TV Shows</span>

        <div class="w-auto flex flex-row overflow-x-auto pl-20 pt-6 pb-10">
            @foreach($topTVShow as $tvShowItem)
            @php
            $original_date = $tvShowItem->first_air_date;
            $timestamp = strtotime($original_date);
            $tvShowYear = date("Y", $timestamp);

            $tvShowID = $tvShowItem->id;
            $tvShowTitle = $tvShowItem->name;
            $tvShowRating = $tvShowItem->vote_average * 10;
            $tvShowImage = "{$imageBaseURL}/w500{$tvShowItem->poster_path}"
            @endphp

            <a href="tv/{{$tvShowID}}" class="group">
                <div class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                    <div class="overflow-hidden rounded-[32px]">
                        <img class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200" src="{{$tvShowImage}}" />
                    </div>

                    <span class="font-poppins font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">{{$tvShowTitle}}</span>
                    <span class="font-poppins text-sm mt-1">{{$tvShowYear}}</span>

                    <div class="flex flex-row mt-1 items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 21H8V8L15 1L16.25 2.25C16.3667 2.36667 16.4627 2.525 16.538 2.725C16.6127 2.925 16.65 3.11667 16.65 3.3V3.65L15.55 8H21C21.5333 8 22 8.2 22.4 8.6C22.8 9 23 9.46667 23 10V12C23 12.1167 22.9873 12.2417 22.962 12.375C22.9373 12.5083 22.9 12.6333 22.85 12.75L19.85 19.8C19.7 20.1333 19.45 20.4167 19.1 20.65C18.75 20.8833 18.3833 21 18 21ZM6 8V21H2V8H6Z" fill="#38B6FF"></path>
                        </svg>
                        <span class="font-inter text-sm ml-1">{{$tvShowRating}}</span>
                    </div>
                </div>
            </a>
            @endforeach

        </div>
    </div>

    <!-- Footer Section -->
    @include('footer')






    <script>
        //default active slide
        let slideIndex = 1;
        showSlide(slideIndex);


        function showSlide(position) {
            let index;
            const slides = document.getElementsByClassName("slide");
            const dotsArray = document.getElementsByClassName("dot");

            //Looping effect
            if (position > slides.length) {
                slideIndex = 1;
            }

            if (position < 1) {
                slideIndex = slides.length;
            }

            //Hidden all slides
            for (index = 0; index < slides.length; index++) {
                slides[index].classList.add('hidden');
            }

            //show active slide
            slides[slideIndex - 1].classList.remove('hidden');

            //Remove active status
            for (index = 0; index < dotsArray.length; index++) {
                dotsArray[index].classList.remove('bg-develobe-500');
                dotsArray[index].classList.add('bg-white');

            }

            //set active status
            dotsArray[slideIndex - 1].classList.remove('bg-white');
            dotsArray[slideIndex - 1].classList.add('bg-develobe-500');
        }

        function moveSlide(moveStep) {
            showSlide(slideIndex += moveStep)
        }

        function currentSlide(position) {
            showSlide(slideIndex = position);
        }
    </script>

</body>

</html>