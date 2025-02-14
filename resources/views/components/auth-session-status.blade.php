@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-neutral-600 dark:text-neutral-400']) }}>
        {{ $status }}
    </div>
@endif
