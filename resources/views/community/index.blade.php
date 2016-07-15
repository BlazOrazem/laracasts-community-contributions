@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <h1>Community</h1>

                <ul class="Links">
                    @foreach($links as $link)
                        <li class="Links__link">
                            <span class="label label-default" style="background: {{ $link->channel->color }};">
                                {{ $link->channel->title }}
                            </span>

                            <a href="{{ $link->link }}" target="_blank">{{ $link->title }}</a>

                            <small>Contributed By <a href="#">{{ $link->creator->name }}</a> {{ $link->updated_at->diffForHumans() }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>

            @include('community.add-link')
        </div>
    </div>
@stop