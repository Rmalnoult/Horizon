@extends('layouts.app')

@section('content')
<meta property="og:title" content="{{ $topic->title }} : Qu\'en pense la presse ?">
<meta property="og:description" content="{{ $topic->edito }}">
<meta property="og:url" content="{{ url('/topics/'.$topic->id) }}">
<meta property="og:image" content="{{ $topic->image }}">

<div class="container" style="margin-top: 40px;">
	<div id="topic" ></div>
</div>
@endsection

@section('scripts')
	<script>
		var topic = {!! $topic; !!};
		var articles = {!! $articles; !!};

		var Modal = {
			template: `
				<div class="modal fade" tabindex="-1" role="dialog" id="articleModal">

					<div class="modal-dialog" role="document">
					<p class="category-label capitalize category-gauche" v-if="article.type.toLowerCase() == 'gauche'"><small>Presse dite de </small>Gauche</p>
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title text-center">@{{ article.title }}</h4>
								<p class="text-center">@{{ article.source }}</p>
							</div>
							<div class="modal-body">
								<img :src="article.image" class="featured"/>
								<p class="text-center">...</p>
								<p class="content" v-html="article.excerpt" ></p>
								<p class="text-center">...</p>
								<div class="text-center">
									<a :href="article.url" class="btn btn-default" target="_blank"><span class="fa fa-plus"></span> Lire l'article en entier</a>
								</div>
							</div>
							<div class="modal-footer text-center">
								<div class="modal-body">
									<a :href="article.url" class="btn btn-default pull-right" data-dismiss="modal"><span class="fa fa-times"></span> Fermer</a>
								</div>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			`,
			props: ['article'],
			mounted: function () {
				console.log(this.article);
			}
		}

		var Topic = new Vue({
			el: '#topic',
			template: `
				<div>
		            <div class="col-md-10 col-md-offset-1">
		                <div :id="'topic'+topic.id" class="topic panel panel-default cursor-pointer" >
							<div class="panel-heading" v-on:click="toggleTopic(topic);scrollToTopic(topic);" >
								<div class="bcg cover" :style="{ 'background-image': 'url('+topic.image+')' }"></div>
								<div class="mask"></div>
								<h3 class="text-white" style="padding: 80px;">@{{ topic.title }}</h3>
							</div>
							<div class="panel-body articles" v-if="topic.active">
								<p class="justify">@{{ topic.edito }}</p>
								<ul class="list-group">
									<div class="row">
										<li class="list-group-item article" v-for="article in topic.articles">
											<a v-on:click="showArticle(article)" class="color-inherit">
												<div class="row">
													<div class="col-md-12">
														<p class="category-label capitalize category-gauche" v-if="article.type.toLowerCase() == 'gauche'"><small>Presse dite de </small>Gauche</p>
														<p class="category-label capitalize category-droite" v-if="article.type.toLowerCase() == 'droite'"><small>Presse dite de </small>Droite</p>
														<p class="category-label capitalize category-international" v-if="article.type.toLowerCase() == 'international'"><small>Point de vue de l'</small>International</p>
													</div>
												</div>
												<div class="row">
													<div class="col-md-2 col-sm-2 col-xs-3 cover cover-image" :style="{ 'background-image': 'url('+article.image+')' }"></div>
													<div class="col-md-10 col-sm-10 col-xs-9">
														<h4>@{{ article.title }}</h4>
														<div class="row">
															<div class="col-md-6 col-sm-6 col-xs-6"><h4><small>@{{ article.source }}</small></h4></div>
															<div class="col-md-6 col-sm-6 col-xs-6 text-right"><a v-on:click="showArticle(article)" class="btn btn-sm btn-default">Lire l'article</a></div>
														</div>
													</div>
												</div>
											</a>
										</li>
									</div>
								</ul>
							</div>
		                </div>
		            </div>
		            <modal :article="currentArticle" ></modal>		

				</div>
			`,
			data: {
				topic: topic,
				articles: articles,
				article: null,
			},
			components: {
				modal: Modal,
			},
			computed: {
				currentArticle: function () {
					if (this.article) {
						return this.article;
					} else {
						return this.articles[0];
					}
				}
			},
			mounted: function () {
				topic.active = true;
			},
			methods: {
				toggleTopic: function (topic) {
					topic.active = topic.active ? false : true;
				},
				showArticle: function (article) {
					this.article = article;
					$('#articleModal').modal('show');
				},
				scrollToTopic: function (topic) {
					var target = $('#topic'+topic.id);
					if (target.length) {
						$('html, body').animate({
							scrollTop: target.offset().top - 60
							// scrollTop: target.offset().top
						}, 300);
						return false;
					}
				}
			}
		});
	</script>
@endsection