<table style="width:100%">
    <tr>
      <th>Title</th>
      <th>Download URL</th>
      <th>Size(KB)</th>
      <th>mimeType</th>
    </tr>
        @foreach ($files as $file)
            <tr>
                <td>{{ $file->title }}</td>
                <td>{{ $file->download_url }}</td>
                <td>{{ $file->size }}</td>
                <td>{{ $file->mime_type }}</td>
            </tr>
        @endforeach
    </table>
    {{ $files->links() }}
    <a href="{{ url('/') }}">Home</a>
