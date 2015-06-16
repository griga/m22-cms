if (!RedactorPlugins) var RedactorPlugins = {};

RedactorPlugins.cut = function(){
	return {
		init: function(){
			var button = this.button.add('cut-button', 'Cut Button');
			this.button.addCallback(button, this.cut.insertCut);
			this.button.setAwesome('cut-button', 'fa-ellipsis-h');
		},
		insertCut: function(){
			
			this.insert.htmlWithoutClean('<hr class="content-cut">');
		}
	}
}