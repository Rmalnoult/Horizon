var Home = new Vue({
	el: '#topics',
	template: `
		<div>
	        <div class="row" v-for="topic in topics">
	            <div class="col-md-8 col-md-offset-2">
	                <div class=" topic panel panel-default cursor-pointer">
						<div class="panel-heading cover" v-on:click="showTopic(topic)" :style="{ 'background-image': 'url('+topic.image+')' }" >
							<div class="mask"></div>
							<h3 class="text-white">{{ topic.title }}</h3>
							<div class="text-center">
								<span class="fa text-white fa-3x" :class="{ 'fa-caret-down': !topic.active, 'fa-caret-up': topic.active }"></span>
							</div>
						</div>
						<div class="panel-body articles" v-if="topic.active">
							<p><strong>Édito : </strong>{{ topic.edito }}</p>
							<div class="row" v-for="article in topic.articles">
								<a :href="article.url" target="_blank" class="color-inherit">
									<div class="col-md-2 col-sm-2 col-xs-3 cover cover-image" :style="{ 'background-image': 'url('+article.image+')' }"></div>
									<div class="col-md-10 col-sm-10 col-xs-9">
										<h4>{{ article.title }}</h4>
										<h4><small>{{ article.source }}</small></h4>
										<a :href="article.url" target="_blank" class="btn btn-sm btn-default pull-right">Lire l'article</a>
									</div>
								</a>
							</div>
						</div>
	                </div>
	            </div>
	        </div>
		</div>
	`,
	data: {
		topics: topics,
	},
	mounted: function () {
		console.log(this.topics);

		for (var i = 0; i < this.topics.length; i++) {
			console.log(this.topics[i].image);
		}
	},
	methods: {
		showTopic: function (topic) {
			topic.active = topic.active ? false : true;
		}
	}
});