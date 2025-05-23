@extends('layouts.app')

@section('content')
  <div class="container mt-5">
    <h1 class="mb-4">Notifications</h1>

    @if ($notifications->isEmpty())
      <div class="alert alert-info">No notifications available.</div>
    @else
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Package Name</th>
            <th>Title</th>
            <th>Text</th>
            <th>Received At</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($notifications as $notification)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $notification->package_name }}</td>
              <td>{{ $notification->title ?? 'No Title' }}</td>
              <td>{{ $notification->text ?? 'No Text' }}</td>
              <td>{{ $notification->created_at->format('d M Y, H:i') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="mt-3">
        {{ $notifications->links() }}
      </div>
    @endif
  </div>
@endsection
