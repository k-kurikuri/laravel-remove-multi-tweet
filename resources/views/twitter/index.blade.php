@extends('layout.app')

@section('title', 'ツイート一覧')

@section('content')
    <h2 id="table-head-options">Tweet一覧 (一度に200件表示します)</h2>

    <form method="get" action="/twitter">
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
                  <input type="checkbox" name="tweetIds" valud="{{ $timeLine->id }}" class="form-check-input" />
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <button type="submit" class="btn btn-primary">ツイート削除</button>
    </form>
@endsection