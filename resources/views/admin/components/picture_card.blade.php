<div class="card" id="picture_card_{{ $picture->id }}">
    <div class="header">
        <h4 class="title">{{ $picture->file }}</h4>
    </div>
    <div class="content">
        <div class="form-group">
            <img src="{{ asset('uploads/pictures/' . $picture->file) }}" class="img-responsive" alt="{{ $picture->name }}">
        </div>
        <div class="form-group">
            {!! Form::text('picture_' . $picture->id . '_link', asset('uploads/pictures/' . $picture->file), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <button class="btn btn-fill btn-danger btn-block" data-action="remove-picture" data-name="{{ $picture->name }}">Supprimer</button>
        </div>
    </div>
</div>