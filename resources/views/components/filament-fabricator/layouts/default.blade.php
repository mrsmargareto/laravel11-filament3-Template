@props(['page'])

<x-filament-fabricator::layouts.base :title="$page->title">
    {{-- Header Here --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <x-filament-fabricator::page-blocks :blocks="$page->blocks" />

    {{-- Footer Here --}}
</x-filament-fabricator::layouts.base>
