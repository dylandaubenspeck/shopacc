@extends('admin.layout')
@section('content')
    <form method="POST" action="{{ route('admin.accounts.new.post') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="accounts"></textarea>
        </div>
        <select class="form-select mb-3" aria-label="Default select example" name="type">
            <option selected disabled>Open this select menu</option>
            @foreach($type as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Button</button>
        </div>
    </form>
@endsection
