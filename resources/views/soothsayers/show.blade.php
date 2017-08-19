@extends('layouts.app')

@section('title', 'Découvrez le profil de ' . $soothsayer->nickname . ', voyant(e) sur Success Voyance !')
@section('pageTitle', $soothsayer->nickname)

@push('breadcrumbs')
<li><a href="{{ route('soothsayers.index') }}">Voyant(e)s</a></li>
<li class="active">{{ $soothsayer->nickname }}</li>
@endpush

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <div class="thumbnail relative margin-bottom-3">
                    <figure>
                        <img class="img-responsive" src="{{ asset('uploads/soothsayers/' . $soothsayer->picture) }}" alt="{{ $soothsayer->nickname }}" />
                    </figure>
                </div>
            </div>
            <div class="col-lg-9 col-sm-9">

                @if( Auth::check() )
                <div class="pull-right">
                    <!-- replace data-item-id width the real item ID - used by js/view/demo.shop.js -->
                    <a class="btn {{ in_array($soothsayer->id, $favorites) ? 'btn-danger' : 'btn-default' }}" data-action="json" href="{{ route('soothsayers.favorite', ['id' => $soothsayer->id]) }}" title="Ajouter aux favoris"><i class="fa {{ in_array($soothsayer->id, $favorites) ? 'fa-times' : 'fa-heart text-danger' }} nopadding"></i> {{ in_array($soothsayer->id, $favorites) ? 'Retirer des favoris' : 'Ajouter aux favoris' }}</a>
                </div>
                @endif

                <div class="shop-item-price">{{ $soothsayer->nickname }} <span><div class="rating rating-{{ $soothsayer->rating }} size-18"></div></span></div>
                <hr />
                <p>{!! nl2br($soothsayer->content) !!}</p>
                <hr />
                <ul class="list-inline text-center">
                    <li><i class="fa fa-eye"></i> {{ $soothsayer->total_consultations }} {{ str_plural('consultation', $soothsayer->total_consultations) }}</li>
                    <li><i class="fa fa-comments"></i> {{ $soothsayer->commentsCount }} {{ str_plural('commentaire', $soothsayer->commentsCount) }}</li>
                    <li><i class="fa fa-heart"></i> {{ $soothsayer->favoritesCount }} {{ str_plural('favori', $soothsayer->favoritesCount) }}</li>
                    <li><i class="fa fa-star"></i> {{ $soothsayer->ratings }} {{ str_plural('vote', $soothsayer->ratings) }}</li>
                </ul>
            </div>
        </div>

        <div class="tab-content padding-top-20">
            @if( Auth::check() )
                <h4 class="page-header margin-bottom-40">Laissez un commentaire</h4>
                <form method="post" action="{{ route('comments.store') }}" id="comment-form">
                    {!! csrf_field() !!}
                    <!-- Stars -->
                    <div class="product-star-vote clearfix">

                        <label class="radio pull-left">
                            <input name="stars" type="radio" name="product-review-vote" value="1" />
                            <i></i> 1 Étoile
                        </label>

                        <label class="radio pull-left">
                            <input name="stars" type="radio" name="product-review-vote" value="2" />
                            <i></i> 2 Étoiles
                        </label>

                        <label class="radio pull-left">
                            <input name="stars" type="radio" name="product-review-vote" value="3" />
                            <i></i> 3 Étoiles
                        </label>

                        <label class="radio pull-left">
                            <input name="stars" type="radio" name="product-review-vote" value="4" />
                            <i></i> 4 Étoiles
                        </label>

                        <label class="radio pull-left">
                            <input name="stars" type="radio" name="product-review-vote" value="5" />
                            <i></i> 5 Étoiles
                        </label>

                    </div>
                    <div class="margin-bottom-30">
                        {!! Form::hidden('soothsayer_id', $soothsayer->id) !!}
                        <textarea name="content" id="content" class="form-control" rows="6" placeholder="Votre commentaire..." maxlength="1000"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit-comment"><i class="fa fa-check"></i> Laisser un commentaire</button>

                </form>
            @endif

            <h4 class="page-header margin-bottom-40" id="list-comments">Commentaires</h4>
            @forelse( $comments as $comment )
                @include('components.comments.comment')
            @empty
                <div class="alert alert-primary text-center">Il n'y a actuellement aucun commentaire pour {{ $soothsayer->nickname }}, n'hésitez pas à lui en laisser un !</div>
            @endforelse

            @if( count($comments) < $soothsayer->commentsCount && $soothsayer->commentsCount > 1 )
                <div class="text-center" id="more-comments">
                    <a href="{{ route('soothsayers.comments', ['id' => $soothsayer->id]) }}?skip={{ count($comments) }}" data-action="load-more" class="btn btn-default"><i class="fa fa-plus"></i> Charger plus de commentaires</a>
                </div>

            @endif
        </div>
    </div>
</section>

@endsection

@section('components')
    <div id="modal-comment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Mettre à jour mon commentaire</h4>
                </div>

                <div class="modal-body"></div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="btn-update-comment">Mettre à jour</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        app.loadMore();
        app.submitForm('#comment-form', '#submit-comment');
        $('body').on('click', '.edit-comment', function(e) {
        	e.preventDefault();
        	$('#modal-comment .modal-body').html('');
        	$.get($(this).attr('href'), function(response) {
                if( response.success ) {
                	$('#modal-comment .modal-body').html(response.content);
					$('#modal-comment').modal('show');
                } else {
					toastr['error'](response.message);
                }
            });
        });
        app.submitForm('#update-comment', '#btn-update-comment', function() {
        	$('#modal-comment').modal('hide');
        });
        var div = '';
        $('body').on('click', '[data-action="display-response"]', function(e) {
        	e.preventDefault();
        	div = $(this).attr('href');
        	$(div).slideToggle();
        });
		app.submitForm('.form-response', '.submit-response', function() {
	        $(div).slideToggle();
		});
    </script>
@endsection