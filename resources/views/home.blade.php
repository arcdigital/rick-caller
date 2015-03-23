@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Active Phone Numbers</div>

				<div class="panel-body">
          <ul>
					@forelse ($phones as $phone)
            <li>{{ $phone->number }} <a href="/phones/{{$phone->id}}/delete">(remove)</a></li>
          @empty
            <li>None :(</li>
          @endforelse
          </ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Add New Number</div>

				<div class="panel-body">
          <form action="/phones/create" method="POST">
            Phone Number: <input type="text" name="number" id="number" placeholder="XXX-XXX-XXXX" />
            <input type="submit" value="Add" />
          </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
