<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Мои вопросы</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <a href="{{ Route('questions.create') }}" class="btn btn-info">Задать вопрос</a>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6 col-sm-6 col-xs-12">

            @if(filled($questions))
                @foreach($questions as $question)
                    <div class="x_content">
                        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel">
                                <a class="panel-heading" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree-{{ $question->id }}" aria-expanded="true" aria-controls="collapseThree">
                                    <h4 class="panel-title">{{ $question->question }}</h4>
                                </a>
                                <div id="collapseThree-{{ $question->id }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree" aria-expanded="true" style="">
                                    <div class="panel-body">
                                        {{ $question->answer ?: 'На этот вопрос еще не ответили ' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@section('script')
    @if (session('success'))
        <script>
            new PNotify({
                title: 'Вопрос успешно создан!',
                text: 'Вам ответят в ближайшее время',
                type: 'success',
                styling: 'bootstrap3'
            });
        </script>
    @endif
@endsection