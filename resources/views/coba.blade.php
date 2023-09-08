<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Dropdown</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <select id="country" name="country">
        <option value="">Select Country</option>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
    </select>

    <select id="state" name="state">
        <option value="">Select State</option>
    </select>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#country').change(function() {
                var country_id = $(this).val();
                $('#state').empty();

                if (country_id) {
                    $.ajax({
                        url: '/get-states/' + country_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(id, name) {
                                $('#state').append(new Option(name, id));
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
