<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>
<body>

<main role="main" class="container">

    <div class="starter-template">
        <h1>Cars</h1>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="control-label">Make</label>
                <div>
                    <select id="select-make" name="rate" autocomplete="off" class="form-control">
                        <option value="0">-- select make --</option>
                        @foreach($makes as $make)
                            <option value="{{$make['id']}}">{{$make['title']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Grade</label>
                <div>
                    <select id="select-grade" name="rate" autocomplete="off" class="form-control">
                        <option value="0">-- select grade --</option>
                    </select>
                </div>
            </div>
        </form>
        <form class="form-horizontal">
            <div class="input-group mt-3">
                <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Send</button>
                </div>
            </div>
        </form>
        <div id="data-container" class="mt-4">

        </div>
    </div>

</main><!-- /.container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<script>
        $(document).ready(function () {
                $.ajaxSetup({
                        headers : {
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        }
                });

                $('#select-make').change(function () {
                        var make_id = $(this).val();

                        var select_grade = $('#select-grade');

                        select_grade.empty();
                        select_grade.append('<option value="0">-- select grade --</option>');

                        if (make_id != 0)
                        {
                                $.getJSON('/grades/' + make_id + '/', function (data) {
                                        for (var k in data)
                                        {
                                                select_grade.append('<option value="' + data[k].id + '">' + data[k].title + '</option>');
                                        }
                                });
                        }
                });

                $('#select-grade').change(function () {
                        var grade_id = $(this).val();

                        var container = $('#data-container');
                        container.html('');

                        if (grade_id != 0)
                        {
                                $.get('/get_grade/' + grade_id + '/', function (data) {
                                        container.html(data);
                                });
                        }
                });
        });
</script>
</body>
</html>