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

                @if ($subscription !== null && $active === true)
                <div class="card">
                    <div class="card-header">Subscribed Stats</div>
                    <div class="card-body">
                        These are your subscribed stats.
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">Subscribe To Our Monthly Subscription - $9.99</div>
                    <div class="card-body">

                        <form action="{{ route('subscribe') }}" method="POST">
                            @csrf
                            <input type="hidden" id="subscribe" class="form-control" name="subscribe" value="monthly" required>
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

                        <form action="{{ route('subscribe') }}" method="POST">
                            @csrf
                            <input type="hidden" id="subscribe" class="form-control" name="subscribe" value="yearly" required>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary green">
                                    Yearly Subscription
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Cancel Your Subscription</div>
                    <div class="card-body">

                        <form action="{{ route('cancel') }}" method="POST">
                            @csrf
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary green">
                                    Cancel Subscription
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
