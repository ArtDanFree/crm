@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="text-align: left; text-shadow: none">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif