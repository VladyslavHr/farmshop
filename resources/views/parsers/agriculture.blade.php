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

                <div class="card-body" id="logger">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let parserStarted = false
    let page = 1
    const startedAt = null;
    function ac_start() {
        if (parserStarted) {
            return false
        }
        parserStarted = true
        ac_parse_page(page)
    }

    function ac_stop() {
        parserStarted = false
    }

    function ac_parse_page(pageNumber) {
        if (!parserStarted) return false
            $.post(`/parsers/agriculture/parsePage/${pageNumber}`, function (data) {
                started_at: startedAt
        },

        function (data) {
            if (data.status == 'ok') {
                $('#logger').prepend(`<div>Page: ${pageNumber}. Title: ${data.title}</div>`)
                $('#logger div:nth-child(n + 11)').remove()
                ac_parse_page(++page)
            }
            if (data.status === 'finish') {
                $('#logger').prepend(`<div>Finish</div>`)

            }
        })
    }
</script>
@endsection
