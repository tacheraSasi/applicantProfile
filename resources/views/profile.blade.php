<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-neutral-800 dark:text-neutral-200 leading-tight">
            {{ __('Applicant Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-semibold text-neutral-900 dark:text-neutral-100">
                    {{ $applicant->full_name }}
                </h3>
                <p class="text-neutral-600 dark:text-neutral-400">{{ $applicant->email }}</p>
                <p class="text-neutral-600 dark:text-neutral-400">{{ $applicant->phone }}</p>

                <div class="mt-6">
                    <h4 class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">Education</h4>
                    <ul class="list-disc pl-5 text-neutral-700 dark:text-neutral-300">
                        @foreach ($applicant->education as $edu)
                            <li>{{ $edu->degree }} from {{ $edu->institution }} ({{ $edu->year }})</li>
                        @endforeach
                    </ul>
                </div>

                {{-- <div class="mt-6">
                    <h4 class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">Experience</h4>
                    <ul class="list-disc pl-5 text-neutral-700 dark:text-neutral-300">
                        @foreach ($applicant->experience as $exp)
                            <li>{{ $exp->job_title }} at {{ $exp->company }} ({{ $exp->years }} years)</li>
                        @endforeach
                    </ul>
                </div> --}}

                <div class="mt-6">
                    <h4 class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">Skills</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($applicant->skills as $skill)
                            <span class="px-3 py-1 bg-neutral-200 dark:bg-neutral-700 text-neutral-800 dark:text-white rounded">
                                {{ $skill->name }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" 
                        class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
