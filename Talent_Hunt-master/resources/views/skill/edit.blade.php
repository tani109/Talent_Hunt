<!DOCTYPE html>
<html>
<head>
	<title>  </title>
	{!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
</head>
<body>
	<h1> Professional Edit Page.</h1>

	<div class="well">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">

				{!! Form::model($skill, ['route' => ['skill.update', $skill->id], 'method' => 'PUT', 'files' => true]  ) !!}

					<div class="form-group">
						{{ Form::label('name', 'Skill Name') }}
						{{ Form::text('name', null, ['id' => 'name', 'placeholder' => 'Enter your skill', 'class' => 'form-control']) }}
					</div>

					<div class="form-group">
		            	{{ Form::submit('Add', ['class' => 'btn btn-success']) }}
					</div>

				{!! Form::close() !!}

			</div>
		</div>


	</div>

</body>
</html>
