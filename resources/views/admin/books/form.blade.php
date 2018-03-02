<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 100, 'required' => 'required', 'autofocus' => 'autofocus']) !!}
</div>
<div class="form-group">
    {!! Form::label('author', 'Author') !!}
    {!! Form::text('author', null, ['class' => 'form-control', 'maxlength' => 100, 'required' => 'required']) !!}
</div>
<div class="form-group">
    {!! Form::label('edition', 'Edition') !!}
    {!! Form::text('edition', null, ['class' => 'form-control', 'maxlength' => 100, 'required' => 'required']) !!}
</div>