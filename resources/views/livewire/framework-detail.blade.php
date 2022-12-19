<div x-data="{ tab: 'overview' }" id="framework-detail" class="flex">
@if($framework)
    <div class="border-4 border-primary bg-white bg-opacity-10">
        <div class="w-144 2xl:w-160 bg-primary text-gray-700 px-4 pb-2 pt-1 text-xl">
            {{ $framework->fullTitle }}
        </div>
        <div class="w-144 2xl:w-160 divide-y divide-gray-500">
            <div class="flex divide-x divide-gray-500">
                <div class="w-1/5 text-white aspect-square flex items-center text-center p-4 hover:bg-primary-400 transition cursor-pointer" :class="tab == 'overview' ? 'active-tab' : ''" @click="tab = 'overview'">
                    <div class="w-full">Organisation overview</div>
                </div>
                <div class="w-1/5 text-white aspect-square flex items-center text-center p-4 hover:bg-primary-400  transition cursor-pointer" :class="tab == 'social' ? 'active-tab' : ''" @click="tab = 'social'">
                    <div class="w-full">Approach to social value</div>
                </div>
                <div class="w-1/5 text-white aspect-square flex items-center text-center p-4 hover:bg-primary-400  transition cursor-pointer" :class="tab == 'benefits' ? 'active-tab' : ''" @click="tab = 'benefits'">
                    <div class="w-full">Benefits & Notes</div>
                </div>
                <div class="w-1/5 text-white aspect-square flex items-center text-center p-4 hover:bg-primary-400  transition cursor-pointer" :class="tab == 'contact' ? 'active-tab' : ''" @click="tab = 'contact'">
                    <div class="w-full">Contact details</div>
                </div>
                <div class="w-1/5 text-white aspect-square flex items-center text-center p-4 hover:bg-primary-400  transition cursor-pointer" :class="tab == 'lots' ? 'active-tab' : ''" @click="tab = 'lots'">
                    <div class="w-full">Value bands</div>
                </div>
            </div>

            <div class="flex divide-x divide-gray-500">
                <div class="w-1/5 text-white aspect-square flex items-center text-center p-4 hover:bg-primary-400  transition cursor-pointer" :class="tab == 'award' ? 'active-tab' : ''" @click="tab = 'award'">
                    <div class="w-full">Contract award notice</div>
                </div>
                <div class="w-1/5 text-white aspect-square flex items-center text-center p-4 hover:bg-primary-400  transition cursor-pointer" :class="tab == 'expiry' ? 'active-tab' : ''" @click="tab = 'expiry'">
                    <div class="w-full">Framework expiry date</div>
                </div>
                <div class="w-1/5 text-white aspect-square flex items-center text-center p-4 hover:bg-primary-400  transition cursor-pointer" :class="tab == 'extension' ? 'active-tab' : ''" @click="tab = 'extension'">
                    <div class="w-full">Extension options</div>
                </div>
                <div class="w-1/5 text-white aspect-square flex items-center text-center p-4 hover:bg-primary-400  transition cursor-pointer" :class="tab == 'calloff' ? 'active-tab' : ''" @click="tab = 'calloff'">
                    <div class="w-full">Call off route</div>
                </div>
                <div class="w-1/5 text-white aspect-square flex items-center text-center p-4 hover:bg-primary-400  transition cursor-pointer" :class="tab == 'contract' ? 'active-tab' : ''" @click="tab = 'contract'">
                    <div class="w-full">Contract types</div>
                </div>
            </div>

            <div class="flex divide-x divide-gray-500">
                <div class="w-2/5 flex justify-center px-8 py-6 text-white flex hover:bg-primary-400  transition cursor-pointer" :class="tab == 'suppliers' ? 'active-tab' : ''" @click="tab = 'suppliers'">
                    <div>Approved suppliers</div>
                </div>
                <div class="w-1/5 flex justify-center px-8 py-6 text-white hover:bg-primary-400  transition cursor-pointer" :class="tab == 'download' ? 'active-tab' : ''" @click="tab = 'download'" wire:click="download">Download</div>
                <div class="w-2/5 flex justify-center px-8 py-6 text-white flex hover:bg-primary-400  transition cursor-pointer" :class="tab == 'website' ? 'active-tab' : ''" @click="tab = 'website'">
                    <a class="flex" href="{{ $framework->url }}" target="_blank">Framework website <svg class="w-3 ml-4 -translate-y-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400"><path fill="currentColor" d="M306.25,250c-10.35,0-18.75,8.4-18.75,18.75v87.5c0,3.44-2.81,6.25-6.25,6.25H43.75c-3.44,0-6.25-2.81-6.25-6.25v-237.5c0-3.44,2.81-6.25,6.25-6.25h87.5c10.39,0,18.75-8.36,18.75-18.75S141.64,75,131.25,75h-87.5C19.63,75,0,94.61,0,118.75v237.5C0,380.39,19.63,400,43.75,400h237.5c24.13,0,43.75-19.63,43.75-43.75v-87.5C325,258.44,316.64,250,306.25,250z M381.25,0H250c-10.35,0-18.75,8.4-18.75,18.75S239.69,37.5,250,37.5h86.02L142.97,230.47c-7.32,7.32-7.32,19.19,0,26.52c3.67,3.72,8.44,5.52,13.28,5.52s9.59-1.83,13.26-5.49L362.5,64.02V150c0,10.35,8.4,18.75,18.75,18.75S400,160.39,400,150V18.75C400,8.4,391.64,0,381.25,0z"/></svg>
                    </a>
                </div>
            </div>

            <div class="px-8 py-6 text-gray-200 text-xl overflow-y-auto" id="simplebar">
                <div x-show="tab == 'overview'">
                    {!! nl2br($framework->organisation->overview) !!}
                </div>
                <div x-cloak x-show="tab == 'social'">
                    {!! nl2br($framework->organisation->social_values) !!}
                </div>
                <div x-cloak x-show="tab == 'benefits'">
                    {!! nl2br($framework->organisation->benefits) !!}
                </div>
                <div x-cloak x-show="tab == 'contact'">
                    <p class="pb-4"><span class="w-40 inline-block">Primary contact:</span> {{ $framework->organisation->contact }}</p>
                    <p class="pb-4"><span class="w-40 inline-block">Job title:</span> {{ $framework->organisation->job_title }}</p>
                    <p class="pb-4"><span class="w-40 inline-block">Telephone:</span> {{ $framework->organisation->phone }}</p>
                    <p class="pb-4"><span class="w-40 inline-block">Email:</span> <a href="mailto:{{ $framework->organisation->email }}">{{ $framework->organisation->email }}</a></p>
                </div>
                <div x-cloak x-show="tab == 'lots'">
                @foreach($lots as $lot)
                    <p class="pb-4">{{ $lot->fullTitle }}</p>
                @endforeach
                @if (count($otherLots))
                    <p class="text-gray-400">Other Value Bands</p>
                    <p class="text-base text-gray-400">
                    @foreach($otherLots as $lot)
                        {{ $lot }}<br>
                    @endforeach
                        </p>
                @endif
                </div>
                <div x-cloak x-show="tab == 'award'">
                @if($framework->award_notice_url)
                    <a class="flex items-start underline decoration-dotted underline-offset-2 hover:text-primary-300 hover:decoration-solid" href="{{ $framework->award_notice_url }}" target="_blank">{{ $framework->award_notice_title }}
                        <svg class="w-3 ml-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400">
                            <path fill="currentColor" d="M306.25,250c-10.35,0-18.75,8.4-18.75,18.75v87.5c0,3.44-2.81,6.25-6.25,6.25H43.75c-3.44,0-6.25-2.81-6.25-6.25v-237.5c0-3.44,2.81-6.25,6.25-6.25h87.5c10.39,0,18.75-8.36,18.75-18.75S141.64,75,131.25,75h-87.5C19.63,75,0,94.61,0,118.75v237.5C0,380.39,19.63,400,43.75,400h237.5c24.13,0,43.75-19.63,43.75-43.75v-87.5C325,258.44,316.64,250,306.25,250z M381.25,0H250c-10.35,0-18.75,8.4-18.75,18.75S239.69,37.5,250,37.5h86.02L142.97,230.47c-7.32,7.32-7.32,19.19,0,26.52c3.67,3.72,8.44,5.52,13.28,5.52s9.59-1.83,13.26-5.49L362.5,64.02V150c0,10.35,8.4,18.75,18.75,18.75S400,160.39,400,150V18.75C400,8.4,391.64,0,381.25,0z"/>
                        </svg>
                    </a>
                @else
                    {{ $framework->award_notice_title }}
                @endif
                </div>
                <div x-cloak x-show="tab == 'expiry'">
                    {{ $framework->expiry->format('jS F Y') ?? 'Not specified' }}
                </div>
                <div x-cloak x-show="tab == 'extension'">
                    {!! nl2br($framework->extension_options) !!}
                </div>
                <div x-cloak x-show="tab == 'calloff'">
                    {!! nl2br($framework->calloff_routes) !!}
                </div>
                <div x-cloak x-show="tab == 'contract'">
                    {!! nl2br($framework->contract_types) !!}
                </div>
                <div x-cloak x-show="tab == 'suppliers'">
                @if ($framework->is_dps)
                    <div class="pb-4">Please contact BlueLight Commercial for details of currently approved suppliers for this DPS</div>
                @else
                    @foreach($suppliers as $lot_title => $lot)
                        @php $half = (count($lot) < 5) ? 0 : round(count($lot)/2) @endphp
                        <div class="pb-4">{{ $lot_title }}
                            <div class="flex text-base pt-2">
                                <div class="w-1/2 border-r border-gray-500">
                                @foreach($lot as $supplier)
                                    @php
                                        if ($supplier['alert']) $alert = true;
                                    @endphp
                                    <p class="{{ ($supplier['alert']) ? 'text-red-400' : '' }}">{{ $supplier['title'] }} {{ ($supplier['alert']) ? '*' : '' }}</p>
                                    @if ($loop->iteration == $half)
                                </div><div class="w-1/2 pl-6">
                                    @endif
                                @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if ($alert)
                        <p class="mt-6 text-red-400 text-base italic">* Please contact BlueLight Commercial for the latest status of these suppliers</p>
                    @endif
                @endif
                </div>
            </div>
        </div>
    </div>
@endif
</div>
