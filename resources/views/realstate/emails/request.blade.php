Name: {{ $data['name'] }} <br>
Phone: {{ $data['phone'] }} <br>
@if(isset($data['email']))
Email: {{ $data['email'] }} <br>
@endif
@if(isset($data['reference']))
Reference: <a href="{{ $data['reference'] }}" target="_blank">{{ $data['reference_name'] }}</a> <br>
@endif