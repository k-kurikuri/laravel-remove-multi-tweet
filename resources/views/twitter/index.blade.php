@extends('layout.app')

@section('title', 'user tweet list')

@section('content')
    <h2 id="table-head-options">User Tweets</h2>

    <form method="post" action="/twitter/remove">
        {{ csrf_field() }}
        <div class="form-group">
            <table class="table">
              <thead class="thead-inverse">
                <tr>
                  <th>tweetId</th>
                  <th>text</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                @foreach($timeLines as $timeLine)
                <tr>
                  <th scope="row">{{ $timeLine->id }}</th>
                  <td>{{ $timeLine->text }}</td>
                  <td>
                      <input type="checkbox" name="tweetIds[]" value="{{ $timeLine->id }}" class="form-check-input" />
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        <button type="submit" class="btn btn-primary">remove check tweet</button>
        </div>
    </form>
@endsection