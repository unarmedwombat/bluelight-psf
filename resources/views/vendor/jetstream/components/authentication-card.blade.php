<div class="flex w-full">
    <div class="min-h-screen flex flex-col justify-between items-center pt-16 pr-8 bg-grad w-full sm:w-1/2 md:w-5/12 xl:w-1/4">
        <div class="w-5/6">
            <div>
                {{ $logo }}
            </div>

            <div class="w-full sm:max-w-md mt-6 py-4">
                {{ $slot }}
            </div>
        </div>
        <div class="mt-6 text-white text-sm w-5/6">
            {{ $action ?? '' }}
        </div>
    </div>
    <div class="min-h-screen hidden md:flex flex-col md:w-7/12 xl:w-3/8">
        <div class="w-full h-[45%] bg-cover bg-center bg-[url('/img/auth-11.jpg')]"></div>
        <div class="w-full h-[30%] py-12 pr-8 text-white text-xl flex flex-col justify-around content-start" style="min-height:250px;">
            <p>This tool is to be used in conjunction with the Construction Playbook & Constructing the Gold Standard.</p>
            <p>We have built this tool to provide you with detailed Framework information that will save time and help you to understand the complex national framework landscape.</p>
        </div>
        <div class="w-full h-[25%] bg-cover bg-center bg-[url('/img/auth-21.jpg')]"></div>
    </div>
    <div class="min-h-screen hidden xl:flex flex-col xl:w-3/8">
        <div class="w-full h-[45%] bg-cover bg-center bg-[url('/img/auth-12.jpg')]"></div>
        <div class="w-full h-[55%] bg-cover bg-top bg-[url('/img/auth-22.jpg')]"></div>
    </div>
{{--    <div class="h-min-screen hidden sm:block sm:min-w-1/2 md:w-7/12 xl:w-3/4" style="background-image: url(/img/sign-in-bg.jpg);background-size: cover;"> </div>--}}

</div>
