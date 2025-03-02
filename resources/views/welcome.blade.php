@extends("layout.index")

@section("content")
<main class="flex-shrink-0 mt-5">
    <div class="container" style="max-width: 600px">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="border-bottom pb-2 mb-0">List of Tasks</h3>
                @if(Auth::check())
                    <span class="text-muted">Welcome, {{ Auth::user()->name }}!</span>
                @endif
            </div>

            <!-- Display success or error messages -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->deadline }}</td>
                            <td>
                                <button class="btn status-toggle {{ $task->is_completed ? 'btn-success' : 'btn-warning' }}">
                                    {{ $task->is_completed ? 'Completed' : 'Pending' }}
                                </button>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Update</a>
                                    <a href="{{ route('tasks.delete', $task->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</main>

<!-- jQuery for Frontend Status Toggle -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.status-toggle').click(function() {
            var button = $(this);
            var isCompleted = button.hasClass('btn-success');

            // Toggle classes and text
            if (isCompleted) {
                button.removeClass('btn-success').addClass('btn-warning').text('Pending');
            } else {
                button.removeClass('btn-warning').addClass('btn-success').text('Completed');
            }
        });
    });
</script>

@endsection
