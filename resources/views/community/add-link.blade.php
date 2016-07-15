@if (Auth::check())
    <div class="col-md-4">
        <h3>Contribute a Link</h3>

        <div class="panel panel-default">
            <div class="panel-body">
                <form method="POST" action="/community"  role="form">
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('channel_id') ? 'has-error' : '' }}">
                        <label for="channel">Channel:</label>
                        <select name="channel_id" id="channel" class="form-control">
                            <option selected disabled>Pick a Channel...</option>

                            @foreach($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                    {{ $channel->title }}
                                </option>
                            @endforeach
                        </select>

                        {!! $errors->first('channel_id', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title">Title:</label>
                        <input type="text"
                               class="form-control"
                               name="title"
                               id="title"
                               placeholder="What is the title of your article?"
                               value="{{ old('title') }}"
                               required>

                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
                        <label for="link">Link:</label>
                        <input type="text"
                               class="form-control"
                               name="link"
                               id="title"
                               placeholder="What is the URL?"
                               value="{{ old('link') }}"
                               required>

                        {!! $errors->first('link', '<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Contribute Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif