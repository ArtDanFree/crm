<div class="col-md-4">
    <div class=" x_panel">
        <div>
            <div class="x_title">
                <h2>Ближайшие дни рождения</h2>
                <div class="clearfix"></div>
            </div>
            <ul class="list-unstyled top_profiles scroll-view">
                @foreach($birthdays as $user)
                    <li class="media event">
                        <img class="ul-birthdays" alt="Аватар"
                             src="{{ srcAvatar($user) }}">
                        <div class="media-body">
                            <a class="title" href="#">{{ $user->full_name }} </a>
                            <p><strong>{{ $user->age }}, Родился {{ $user->date }} </strong></p>
                            <p> <small>День рождение через {{ $user->when }}</small>
                            </p>
                        </div>
                    </li>
                @endforeach
                <div class="clearfix"></div>
                <a href="{{ Route('birthday') }}">Смотреть весь список</a>
            </ul>
        </div>
    </div>
</div>