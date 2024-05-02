@extends('layouts.User.app')
@section('title')
    @if (auth()->check())
        {{ auth()->user()->name }}
    @endif | Dashboard
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">
                                @if (auth()->check())
                                    {{ auth()->user()->name }}
                                @endif
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            Featured
                          </div>
                        <img class="card-img-top" src="..." alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <section class="col-lg-7 connectedSortable">
                    </section>
                    <section class="col-lg-5 connectedSortable">
                    </section>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {

            $(".copy").click(function() {

                var code = $(this).attr('data-code');

                var url = "{{ URL::to('/') }}/exam/" + code;

                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(url).select();
                document.execCommand("copy");
                $temp.remove();

                setTimeout(() => {
                    $('.copied_text').remove();
                }, 1000);
            });
        });
    </script>
@endsection
