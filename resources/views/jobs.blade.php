<x-layout>
    <x-slot:heading>
        Jobs Listing
    </x-slot:heading>
    <ul>

        @foreach($jobs as $job)
            <a href="/jobs/{{$job['id']}}" class="text-blue-500 hover:underline">
                <li>{{$job['title']}}</li>
            </a>

        @endforeach
    </ul>

</x-layout>
