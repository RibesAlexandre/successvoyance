@extends('layouts.app')

@section('title', 'Recrutement')
@section('pageTitle', 'Rejoignez-nous !')

@push('breadcrumbs')
<li class="active">Rejoignez Nous !</li>
@endpush

@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    @forelse( $offers as $offer )
                        <div class="heading-title heading-border-bottom heading-color">
                            <span class="pull-right text-muted"><span class="label label-success">URGENT</span></span>
                            <h2 class="size-20">{{ $offer->title }}</h2>
                        </div>

                        <div class="margin-bottom-20">
                           {!! nl2br($offer->content) !!}
                        </div>

                        <a href="#" class="btn btn-primary btn-teal scrollTo" data-offset="150" data-action="select" data-id="{{ $offer->id }}"><i class="fa fa-check"></i> Je postule !</a>
                    @empty
                    <div class="alert alert-primary text-center">Il n'y actuellement aucune offre, mais n'hésitez pas à envoyer une candidature spontanée ;)</div>
                    @endforelse
                </div>
                <div class="col-md-5 col-sm-5">
                    <div class="heading-title heading-border-bottom">
                        <h2 class="size-20">Je remplis ma candidature</h2>
                    </div>


                    <form class="validate" id="form-recruitment" action="{{ route('recruitment.post') }}" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Prénom *</label>
                                        <input type="text" name="firstname" id="firstname" value="{{ Auth::check() ? Auth::user()->firstname : null }}" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Nom *</label>
                                        <input type="text" name="name" id="name" value="{{ Auth::check() ? Auth::user()->name : null }}" class="form-control required">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Email *</label>
                                        <input type="email" name="email" id="email" value="{{ Auth::check() ? Auth::user()->email : null }}" class="form-control required">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Téléphone *</label>
                                        <input type="phone" name="phone" id="phone" value="" class="form-control required">
                                    </div>
                                </div>
                            </div>

                            @if( count($offers) > 0)
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12">
                                        <label>Poste *</label>
                                        <select name="recruitment_id" id="recruitment_id" class="form-control pointer required">
                                            <option value="select">Sélectionnez</option>
                                            @foreach( $offers as $offer )
                                            <option value="{{ $offer->id }}">{{ $offer->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Date de naissance *</label>
                                        <input type="text" name="birthday" value="" class="form-control datepicker required" data-format="dd-mm-yyyy" data-lang="fr" data-RTL="false">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Disponible *</label>
                                        <input type="text" name="begin_at" value="" class="form-control datepicker required" data-format="dd-mm-yyyy" data-lang="fr" data-RTL="false">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>
                                            Fichier Joint
                                            <small class="text-muted">Curriculum Vitae</small>
                                        </label>

                                        <!-- custom file upload -->
                                        <div class="fancy-file-upload fancy-file-primary">
                                            <i class="fa fa-upload"></i>
                                            <input type="file" class="form-control" name="file" onchange="jQuery(this).next('input').val(this.value);" />
                                            <input type="text" class="form-control" placeholder="Aucun fichier sélectionné" readonly="" />
                                            <span class="button">Parcourir</span>
                                        </div>
                                        <small class="text-muted block">Taille Maximale: 10Mo (zip/pdf)</small>

                                    </div>
                                </div>
                            </div>

                        </fieldset>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-teal btn-xlg btn-block margin-top-30">
                                    Je soumets ma candidature
                                    <span class="block font-lato">Nous tâcherons de vous répondre le plus rapidement possible.</span>
                                </button>
                            </div>
                        </div>

                    </form>

                    <hr class="margin-top-60" />

                    <div class="text-center margin-top-60">
                        <i class="fa fa-phone fa-3x"></i>
                        <h1 class="font-raleway nomargin">1800-123-456</h1>
                        <span class="size-13 text-muted">Contactez nous !</span>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    @parent
    <script>
        $('body').on('click', '[data-action="select"]', function(e) {
        	e.preventDefault();
            $('#recruitment_id').val($(this).attr('data-id')).change();
        });
		app.submitForm('#form-recruitment', '#submit-recruitment');
    </script>
@endsection