<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <h2> Current student: {{ $student->email}}
    </h2>
    @foreach ($classes as $classes2)
    <h3>{{ $classes2->email}}
    <form method="POST" action="transfer_student">
                                    @csrf
                                    <input type="text" name="klas_link_id" value="{{ $classes2->klas_link_id }}" hidden>
                                    <input type="text" name="student_id" value="{{ $student->id }}" hidden>
                                    <input type="submit" value="transfer student to this class">
                                </form>
    </h3>
    @endforeach


</x-app-layout>