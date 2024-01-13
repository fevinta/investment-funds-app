<x-mail::message>
# We detected a possible duplicate fund

Please review the fund below and make sure it is not a duplicate.

<x-mail::table>
| Id            | Name          | Created At  |
| ------------- | ------------- | ----------- |
@foreach($duplicates as $duplicate)
| {{$duplicate->id}} | {{$duplicate->name}} | {{$duplicate->created_at->format('Y-m-d H:i:s')}} |
@endforeach
</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
