New feedback <br>

Username: {{ isset($data['name']) ? $data['name'] : '' }} <br>
Email: {{ isset($data['email']) ? $data['email'] : '' }} <br>
Phone Number: {{ isset($data['phone']) ? $data['phone'] : '' }} <br>

Message: <br>
@if(isset($data['message']))
    {!! $data['message'] !!}
@endif