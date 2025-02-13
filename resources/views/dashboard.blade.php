<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-neutral-800 dark:text-neutral-200 leading-tight">
            {{ __('Applicants List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full border-collapse border border-neutral-300 dark:border-neutral-700">
                    <thead class="bg-neutral-100 dark:bg-neutral-700">
                        <tr>
                            <th class="border border-neutral-300 dark:border-neutral-600 px-4 py-2 text-left">#</th>
                            <th class="border border-neutral-300 dark:border-neutral-600 px-4 py-2 text-left">Full Name</th>
                            <th class="border border-neutral-300 dark:border-neutral-600 px-4 py-2 text-left">Email</th>
                            <th class="border border-neutral-300 dark:border-neutral-600 px-4 py-2 text-left">Phone</th>
                            <th class="border border-neutral-300 dark:border-neutral-600 px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($applicants && $applicants->isNotEmpty())
                        @foreach ($applicants as $index => $applicant)
                        <tr class="hover:bg-neutral-200 dark:hover:bg-neutral-700">
                            <td class="border border-neutral-300 dark:border-neutral-600 px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border border-neutral-300 dark:border-neutral-600 px-4 py-2">{{ $applicant->full_name }}</td>
                            <td class="border border-neutral-300 dark:border-neutral-600 px-4 py-2">{{ $applicant->email }}</td>
                            <td class="border border-neutral-300 dark:border-neutral-600 px-4 py-2">{{ $applicant->phone }}</td>
                            <td class="border border-neutral-300 dark:border-neutral-600 px-4 py-2">
                                <a href="{{ route('profile.show', $applicant->id) }}" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">
                                    View Profile
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                
                @if(!$applicants || $applicants->isEmpty())
                    <p class="text-center text-neutral-500 dark:text-neutral-400 mt-4">No applicants found.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
