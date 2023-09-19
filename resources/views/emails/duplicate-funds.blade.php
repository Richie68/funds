<x-mail::message>
# Duplicate Funds Notification

A new Fund was created and there were one or more Funds that has the same Name or Aliases

These are the Funds founded:

@foreach($funds as $fund)
  <p>Name: {{ $fund->name }}</p>
  <p>Start: {{ $fund->start }}</p>
  <p>Manager Company: {{ $fund->manager->name }}</p>
  @if($fund->aliases()->count() > 0)
    <ul>
      @foreach($fund->aliases as $alias)
        <li>Alias Name: {{ $alias->name }}</li>
      @endforeach
    </ul>
  @endif
  <hr>
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
