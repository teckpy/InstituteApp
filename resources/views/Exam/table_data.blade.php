@if ($success == true)
    @if (count($initialQuestion) > 0)
        <div class="card">
            <div class="card-body row">
                <div class="col-9">
                    <table>
                        <tr>
                            <h5 class="card-title">
                                Q.)
                                &nbsp;</h5>
                            <input type="hidden" name="exam_id" data-id="{{ $qnaExam[0]['id'] }}"
                                value="{{ $qnaExam[0]['id'] }}">
                            <input type="hidden" name="q[]" value="{{ $initialQuestion[0]['id'] }}">
                            {{-- <input type="hidden" name="ans_{{ $randomExam[0]->id }}"
            id="ans_{{ $randomExam[0]->id }}"> --}}
                            <p class="text-justify">
                                {{ $initialQuestion[0]['question'] }}
                            </p>
                        </tr>
                    </table>
                </div>
                <div class="col-3 text-right">
                    <span class="">2 Marks</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body row">
                <div class="col" style="margin-left: 1%">
                    <table>
                        <tr>
                            @foreach ($randomExam->question[0]->answers->shuffle() as $answer)
                                <input type="radio" name="radio_{{ $initialQuestion[0]['id'] }}"
                                    class="form-check-input select_ans" data-id="{{ $initialQuestion[0]['id'] }}"
                                    value="{{ $answer->id }}">
                                <label for="">
                                    {{ $answer->answer }}
                                </label><br>
                            @endforeach

                        </tr>
                    </table>
                </div>
            </div>
        </div>


    @endif
@endif
