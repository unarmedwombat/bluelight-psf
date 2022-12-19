@extends('layouts.default')

@section('content')
    <div class="flex">
        <div class="w-1/4 flex justify-end items-center text-2xl 2xl:text-3xl font-medium text-primary p-8">
            <div class="flex items-center">Project Location<div class="pl-6"><svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 326.45 376.95"><polygon fill="currentColor" points="0,0 326.45,188.48 0,376.95 "/></svg></div></div>
        </div>
        <div class="w-7/12">
            <livewire:select-region />
        </div>
    </div>

    <div class="flex mt-12">
        <div class="w-1/4 flex justify-end items-center text-2xl 2xl:text-3xl font-medium text-primary px-8">
            <div class="flex items-center">Estimated Budget<div class="pl-6"><svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 326.45 376.95"><polygon fill="currentColor" points="0,0 326.45,188.48 0,376.95 "/></svg></div></div>
        </div>
        <div class="w-7/12">
            <livewire:estimate-budget />
        </div>
    </div>

    <div class="flex mt-8">
        <div class="w-1/4 flex justify-end items-start text-2xl 2xl:text-3xl font-medium text-primary p-8">
            <div class="pt-1.5 flex items-start">
                <div>Preferred Supplier<br>
                    <div class="text-base italic leading-3">(optional)</div></div>
                <div class="pl-6 pt-2.5"><svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 326.45 376.95"><polygon fill="currentColor" points="0,0 326.45,188.48 0,376.95 "/></svg></div>
            </div>
        </div>
        <div class="w-1/3 pt-8 text-gray-600">
            @livewire('preferred-supplier')
        </div>
        <div class="w-1/4 text-right mt-0.5 pt-5">
            <livewire:show-frameworks />
        </div>
    </div>
    <div class="mt-8 flex">
        <div class="w-1/4 flex justify-end items-start text-2xl 2xl:text-3xl font-medium text-primary p-8">
            <div class="flex items-center">Frameworks<div class="pl-6"><svg class="w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 326.45 376.95"><polygon fill="currentColor" points="0,0 326.45,188.48 0,376.95 "/></svg></div></div>
        </div>
        <div class="w-1/3 2xl:w-1/4 pt-6 text-gray-600">
            @livewire('framework-results')
        </div>
        <div class="mt-6 mr-4 flex">
            <livewire:framework-detail />

        </div>
    </div>
@endsection

@push('scripts')
<script src="/js/slider.js"></script>
<script>
    const el = document.getElementById('budget-slider');
    const vl = document.getElementById('budget-value');
    el.oninput      = function() { vl.value = sArr[this.value].display; };
    el.onmouseup    = function() { Livewire.emit('budgetUpdated', vl.value); }
    el.onkeyup      = function() { Livewire.emit('budgetUpdated', vl.value); }
    vl.onchange     = function() { Livewire.emit('budgetUpdated', vl.value); }

    window.addEventListener('load', (event) => {
        Livewire.emit('getRegion');
        Livewire.emit('getBudget');
    });
</script>
@endpush

