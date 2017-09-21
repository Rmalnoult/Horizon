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
												<a :href="article.url" target="_blank" class="color-inherit">
													<div class="row">
														<div class="col-md-12">
															<p class="category-label capitalize" v-bind:class="{ 'category-gauche': article.type.toLowerCase() == 'gauche', 'category-droite': article.type.toLowerCase() == 'droite', 'category-international': article.type.toLowerCase() == 'international' }">{{article.type}}</p>
														</div>
													</div>
													<div class="row">
														<div class="col-md-2 col-sm-2 col-xs-3 cover cover-image" :style="{ 'background-image': 'url('+article.image+')' }"></div>
														<div class="col-md-10 col-sm-10 col-xs-9">
															<h4>{{ article.title }}</h4>
															<div class="row">
																<div class="col-md-6 col-sm-6 col-xs-6"><h4><small>{{ article.source }}</small></h4></div>
																<div class="col-md-6 col-sm-6 col-xs-6 text-right"><a :href="article.url" target="_blank" class="btn btn-sm btn-default">Lire l'article</a></div>
															</div>
														</div>
													</div>
												</a>
											</li>
										</div>
									</ul>
								</div>
								<div class="panel-footer text-center" v-show="topic.active" v-on:click="topic.active = false">
									<span class="fa fa-2x fa-caret-up"></span>
								</div>
			                </div>
			            </div>
			        </div>
				</div>
			</div>
		</div>
	`,
	data: {
		categories: categories,
	},
	created: function () {

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
		}
	}
});