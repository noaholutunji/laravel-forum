@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">
                    <avatar-form :user="{{ $profileUser }}"></avatar-form>
                </div>

                @forelse ($activities as $date => $activity)
                    <h3 class="card-header my-3">{{ $date }}</h3>

                    @foreach ($activity as $record)
                        @if (view()->exists("profiles.activities.{$record->type}"))
                            @include("profiles.activities.{$record->type}", ['activity'=> $record])
                        @endif
                    @endforeach
                @empty
                    <p class="mt-3">There is no activity for this user yet.</p>
                @endforelse

            </div>
        </div>
    </div>
@endsection
