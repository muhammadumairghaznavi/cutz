@extends('layouts.app')
@section('title_page')
    Submit Review
    @php
    $page = 'Submitreview';
    @endphp
@endsection
@section('content')
    <!DOCTYPE HTML>
    <html>

    <head>
        <meta charset="utf-8" />
        <title>Cutz Review</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
            integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <div class="container">
            <h1 class="mt-5 mb-5">Please write review for us</h1>
            <div class="card">
                <div class="card-header">Review Form</div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-4 text-center">
                            <h3 class="mt-4 mb-3">Write Review Here</h3>
                            <button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <h3><span id="total_review">{{ $count_Reviews }}</span> Reviews</h3>
                </div>
            </div>
            <div class="mt-5" id="review_content"></div>
        </div>
    </body>

    </html>

    <div id="review_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('submit_rating') }}" method="POST">
                        {{ csrf_field() }}
                        <h4 class="text-center mt-2 mb-4">
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                        <div class="form-group">
                            <input type="text" name="customer_id" id="user_name" class="form-control"
                                value="{{ authCustomer()->id }}" hidden />
                        </div>
                        <div class="form-group">
                            <input type="text" name="review" id="review_num" class="form-control" hidden />
                        </div>
                        <div class="form-group">
                            <textarea name="comment" id="user_review" class="form-control"
                                placeholder="Type Review Here"></textarea>
                        </div>

                        @if (config('services.recaptcha.key'))

                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}">
                                </div>
                            </div>
                        @endif
                        <div class="form-group text-center mt-4">
                            <input type="submit" name="submit" id="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#submit_star_1").click(
            function(event) {
                $('#review_num').val(1);
            });
        $("#submit_star_2").click(
            function(event) {
                $('#review_num').val(2);
            });
        $("#submit_star_3").click(
            function(event) {
                $('#review_num').val(3);
            });
        $("#submit_star_4").click(
            function(event) {
                $('#review_num').val(4);
            });
        $("#submit_star_5").click(
            function(event) {
                $('#review_num').val(5);
            });

        var rating_data = 0;

        $('#add_review').click(function() {

            $('#review_modal').modal('show');

        });

        $(document).on('mouseenter', '.submit_star', function() {

            var rating = $(this).data('rating');

            reset_background();

            for (var count = 1; count <= rating; count++) {

                $('#submit_star_' + count).addClass('text-warning');

            }

        });

        function reset_background() {
            for (var count = 1; count <= 5; count++) {

                $('#submit_star_' + count).addClass('star-light');

                $('#submit_star_' + count).removeClass('text-warning');

            }
        }

        $(document).on('mouseleave', '.submit_star', function() {

            reset_background();

            for (var count = 1; count <= rating_data; count++) {

                $('#submit_star_' + count).removeClass('star-light');

                $('#submit_star_' + count).addClass('text-warning');
            }

        });

        $(document).on('click', '.submit_star', function() {

            rating_data = $(this).data('rating');

        });

        $('#save_review').click(function() {

            var user_name = $('#user_name').val();

            var user_review = $('#user_review').val();

            if (user_name == '' || user_review == '') {
                alert("Please Fill Both Field");
                return false;
            } else {
                $.ajax({
                    url: '{{ url('submit_rating') }}',
                    method: "POST",
                    data: {
                        rating_data: rating_data,
                        user_name: user_name,
                        user_review: user_review
                    },
                    success: function(data) {
                        $('#review_modal').modal('hide');

                        load_rating_data();

                        alert(data);
                    }
                })
            }

        });
    </script>
@endsection
