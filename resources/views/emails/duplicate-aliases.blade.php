<x-mail::message>
# Duplicate Alias Notification

A new Alias was created and there were one or more Alias assigned to an existing Fund

These are the Aliases with their Fund information:

@foreach($aliases as $alias)
  <p>Name: {{ $alias->name }}</p>
  @if($alias->funds()->count() > 0)
    <ul>
      @foreach($alias->funds as $fund)
        <li>
          <p>Name: {{ $fund->name }}</p>
          <p>Start: {{ $fund->start }}</p>
          <p>Manager Company: {{ $fund->manager->name }}</p>
        </li>
      @endforeach
    </ul>
  @endif
  <hr>
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
