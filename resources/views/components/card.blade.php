<!-- resources/views/components/card.blade.php -->
{{-- Make sure component variables are correctly defined --}}
@php
    $title = $title ?? 'No Title';
    $value = $value ?? 'No Value';
    $color = $color ?? 'green';
    $change = $change ?? '15';
    $lastWeek = $lastWeek ?? '2';
@endphp

<div class="flex flex-col gap-y-3 lg:gap-y-5 p-4 md:p-9 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-neutral-900 dark:border-neutral-800">
    <div class="inline-flex justify-center items-center">
      <span class="size-2 inline-block bg-{{ $color }}-300 rounded-full me-2"></span>
      <span class="text-xs font-semibold uppercase text-gray-600 dark:text-neutral-400">{{ $title }}</span>
    </div>

    <div class="text-center">
      <h3 class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-800 dark:text-neutral-200">
        {{ $value }}
      </h3>
    </div>

    <dl class="flex justify-center items-center divide-x divide-gray-200 dark:divide-neutral-800">
      <dt class="pe-3">
        <span class="text-green-600">
          <svg class="inline-block size-4 self-center" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
          </svg>
          <span class="inline-block text-sm">
            {{ $change }}%
          </span>
        </span>
        <span class="block text-sm text-gray-500 dark:text-neutral-500">change</span>
      </dt>
      <dd class="text-start ps-3">
        <span class="text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $lastWeek }}</span>
        <span class="block text-sm text-gray-500 dark:text-neutral-500">last week</span>
      </dd>
    </dl>
  </div>
