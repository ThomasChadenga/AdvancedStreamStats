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

                        These are your basic stats.
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Extended Stats</div>
                    <div class="card-body">
                        These are your subscribed stats.
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Subscribe To Our Monthly Subscription - $9.99</div>
                    <div class="card-body">

                        <form action="{{ route('subscribe.monthly') }}" method="POST">
                            @csrf
                            <input type="hidden" id="monthly" class="form-control" name="monthly" value="1" required>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary green">
                                    Monthly Subscription
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Subscribe To Our Yearly Subscription - $99.99</div>
                    <div class="card-body">

                        <form action="{{ route('subscribe.yearly') }}" method="POST">
                            @csrf
                            <input type="hidden" id="yearly" class="form-control" name="yearly" value="1" required>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary green">
                                    Yearly Subscription
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
