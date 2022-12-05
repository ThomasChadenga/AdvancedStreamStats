@extends('layout')

@section('content')
    <div class="container unique">
        <div class="row justify-content-center unique">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success unique" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        You have been logged in.
                    </div>
                </div>
            </div>
        </div>
    </div>
