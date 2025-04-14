@extends('admin.admin_basic')

@section('content')

<h1>Banned IP Addresses</h1>

@if (count($ips))
    <table>
        <thead>
        <tr>
            <th>IP Address</th>
            <th>Jail</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($ips as $entry)
            <tr>
                <td>{{ $entry['ip'] }}</td>
                <td>{{ $entry['jail'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>No banned IPs found.</p>
@endif



<style>
    table { border-collapse: collapse; width: 50%; margin-top: 20px; }
    th, td { padding: 10px; border: 1px solid #ddd; }
</style>

@endsection
