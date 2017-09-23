var Modal = {
	template: `
		<div class="modal fade" tabindex="-1" role="dialog" id="articleModal">

			<div class="modal-dialog" role="document">
			<p class="category-label capitalize category-gauche" v-if="article.type.toLowerCase() == 'gauche'"><small>Presse dite de </small>Gauche</p>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center">{{ article.title }}</h4>
						<p class="text-center">{{ article.source }}</p>
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


var Home = new Vue({
	el: '#topics',
	template: `
		<div>
			<div v-for="category in categories" >
				<h2 class="title-label" :style="{ 'background-color': category.color }">{{ category.name }}</h2>
				<div class="container">
					<span></span>
			        <div class="row" v-for="topic in category.topics">
			            <div class="col-md-8 col-md-offset-2">
			                <div :id="'topic'+topic.id" class="topic panel panel-default cursor-pointer" :class="{ 'active': topic.active }" >
								<div class="panel-heading" v-on:click="toggleTopic(topic);scrollToTopic(topic);" >
									<div class="bcg cover" :style="{ 'background-image': 'url('+topic.image+')' }"></div>
									<div class="mask"></div>
									<div class="close" v-show="topic.active"><span class="fa fa-times"></span></div>
									<h3 class="text-white">{{ topic.title }}</h3>
									<div class="text-center">
										<span class="fa text-white fa-3x fa-caret-down" v-show="!topic.active"></span>
									</div>
								</div>
								<div class="panel-body articles" v-if="topic.active">
									<p class="justify">{{ topic.edito }}</p>
									<ul class="list-group">
										<div class="row">
											<li class="list-group-item article" v-for="article in topic.articles">
												<a v-on:click="showArticle(article)" target="_blank" class="color-inherit">
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
															<h4>{{ article.title }}</h4>
															<div class="row">
																<div class="col-md-6 col-sm-6 col-xs-6"><h4><small>{{ article.source }}</small></h4></div>
																<div class="col-md-6 col-sm-6 col-xs-6 text-right"><a v-on:click="showArticle(article)" class="btn btn-sm btn-default">Lire l'article</a></div>
															</div>
														</div>
													</div>
												</a>
											</li>
										</div>
									</ul>
									<div class="row text-center" style="margin-bottom:30px">
										<hr />
										<div v-if="topic.active">
											<div class="col-sm-4 col-sm-offset-8 col-xs-6 col-xs-offset-6">
												<div class="col-md-4 col-sm- col-xs-4">
												    <button v-on:click="shareOnFacebook(topic.id)" class="btn btn-facebook"><span class="fa fa-facebook"></span></button>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-4">
												    <button v-on:click="shareOnTwitter(topic.id, topic.title)" class="btn btn-twitter"><span class="fa fa-twitter"></span></button>
												</div>
												<div class="col-md-4 col-sm-4 col-xs-4">
												    <button v-on:click="shareOnLinkedIn(topic.id, topic.title)" class="btn btn-linkedin"><span class="fa fa-linkedin"></span></button>
												</div>
											</div>
										</div>
										<hr />
									</div>
								</div>
								<div class="panel-footer text-center" v-show="topic.active" v-on:click="topic.active = false">
									<span class="fa fa-2x fa-caret-up"></span>
								</div>
			                </div>
			            </div>
			        </div>
				</div>
			</div>
			<modal :article="currentArticle"></modal>
		</div>
	`,
	components: {
		'modal': Modal
	},
	data: {
		categories: categories,
		article: null,
	},
	computed: {
		currentArticle: function () {
			if (this.article) {
				return this.article;
			} else {
				return this.categories[0].topics[0].articles[0];
			}
		}
	},
	mounted: function () {
		
	},
	methods: {
		toggleTopic: function (topic) {
			topic.active = topic.active ? false : true;
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
		},
		showArticle: function (article) {
			this.article = article;
			$('#articleModal').modal('show');
		},
		shareOnFacebook: function (id) {
		    window.open("https://www.facebook.com/sharer/sharer.php?u=https://horizon-actu.com/topics/"+id, '', 
		    'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
		    return false;
		},
		shareOnTwitter: function (id, title) {
		    window.open('https://twitter.com/share?url=https://horizon-actu.com/topics/'+id+'&text='+ title +' : Qu\'en dit la presse ? via @horizonactu', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
		    return false; 
		},
		shareOnLinkedIn: function (id, title) {
			window.open("https://www.linkedin.com/shareArticle?mini=true&url=https://horizon-actu.com/topics/"+id+"&title="+title+" : Qu\'en dit la presse ? via @horizonactu&source=Horizon Actu")
		}
	}
});