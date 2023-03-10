<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
@if (isset($admin))

                            <h2> {{ $admin->name}}
                            </h2>
                            <h3>
                            <a href="registe_account" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register nieuwe school</a>
                            </h3>
                            @foreach ($schools as $school)
                            <h3> {{ $school->email }}
                                <form method="POST" action="remove">
                                    @csrf
                                    <input type="text" name="id" value="{{ $school->id }}" hidden>
                                    <input type="text" name="value" value="school" hidden>
                                    <input type="text" name="school_id" value="{{ $school->school_id }}" hidden>
                                    <input type="submit" value="remove school">
                                </form>
                            </h3>
                            @endforeach

@endif
@if (isset($schools) && isset($class))
                            <h2> {{ $schools->email}}
                            </h2>
                            <h3>
                            <a href="registe_account" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register nieuwe groep</a>
                            </h3>
    @foreach ($class as $class2)
                            <h3> {{ $class2->email}}
                                <form method="POST" action="remove">
                                    @csrf
                                    <input type="text" name="id" value="{{ $class2->id }}" hidden>
                                    <input type="text" name="value" value="school" hidden>
                                    <input type="submit" value="remove class">
                                    </form>
                                    <form method="POST" action="loginAs">
                                    @csrf
                                    <input type="text" name="id" value="{{ $class2->id }}" hidden>
                                    <input type="submit" value="login as class">
                                </form>
                            </h3>
    @endforeach

@endif
@if (!isset($schools) && isset($class))
    @if (isset($session))
        <h3><a href="..\dashboard">back to school screen</a></h3>
    @endif
<h2> {{ $class->email}}</h2>

<h3>
                            <a href="registe_account" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register nieuwe student</a>
                            </h3>
    @foreach ($students as $students2)
                            <h3> {{ $students2->email}}
                                <form method="POST" action="remove">
                                    @csrf
                                    <input type="text" name="id" value="{{ $students2->id }}" hidden>
                                    <input type="text" name="value" value="school" hidden>
                                    <input type="submit" value="remove student">
                                </form>
                                <form method="POST" action="transfer">
                                    @csrf
                                    <input type="text" name="id" value="{{ $students2->id }}" hidden>
                                    <input type="submit" value="transfer student">
                                </form>
                            </h3>
    @endforeach

@endif
</x-app-layout>
