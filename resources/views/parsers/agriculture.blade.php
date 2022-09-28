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

                        <select name="" id="parser_sessions" class="form-select">
                            <option value="0">Начать с начала</option>
                            @foreach ($parserSessions as $parserSession)
                                <option value="{{ $parserSession->started_at }}">
                                    {{ $parserSession->started_at }} - {{ $parserSession->page  }}
                                </option>
                            @endforeach
                        </select>
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
    let page = 0
    function ac_start() {
        if (parserStarted) {
            return false
        }
        parserStarted = true

        const startedAt = $('#parser_sessions').val()

        ac_parse_page(startedAt, page)
    }

    function ac_stop() {
        parserStarted = false
    }

    function ac_parse_page(startedAt, page) {
        if (!parserStarted) return false
        $.get(`/parsers/agriculture/parsePage`, {
            started_at: startedAt,
            page: page,
        },

        function (data) {
            if (data.status == 'ok') {
                page = ++data.page
                $('#logger').prepend(`<div>Page: ${data.page}. Title: ${data.title}</div>`)
                $('#logger div:nth-child(n + 11)').remove()
                ac_parse_page(data.started_at, page)
            }
            if (data.status === 'finish') {
                $('#logger').prepend(`<div>Finish</div>`)

            }
        })
    }
</script>
@endsection
