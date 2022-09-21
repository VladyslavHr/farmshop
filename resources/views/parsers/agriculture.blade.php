@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                        <button type="button" class="btn btn-outline-dark"
                        onclick="ac_start()"
                        >Start</button>
                        <button type="button" class="btn btn-outline-dark" disabled>........</button>
                        <button type="button" class="btn btn-outline-dark"
                        onclick="ac_stop()"
                        >Stop</button>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function ac_start() {

    }

    function ac_stop() {

    }

    function ac_parse_page(pageNumber = 1) {
        name
    }
</script>
@endsection
