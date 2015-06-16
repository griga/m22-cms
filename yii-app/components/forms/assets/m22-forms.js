$.fn.extend({
	m22Multilang: {
		register: function(selector, options){
			options = options || {};
			var $group = $(selector);
			var $handlers = $('<div>', {
				'class':'ml-handlers btn-group pull-right ' + (options.handlerCssClass ? options.handlerCssClass : '')
			});
			$group.prepend($handlers);
			$group.find('[data-ml-language]').each(function(){
				var $control = $(this);
				var $handler = $('<button>', {
					'class':'btn btn-xs btn-default btn-ml ' + ($control.hasClass('hidden') ? "" : 'btn-success')
				}).text($control.data('mlLanguage')).data('mlControl', $control);
				$handlers.append($handler);
			});
			$group.on('click', '.btn-ml', function(e){
				var $handler = $(this);
				if(!$handler.hasClass('btn-success')){
					$group.find('.btn-success').removeClass('btn-success').data('mlControl').addClass('hidden');
					$handler.data('mlControl').removeClass('hidden');
					$handler.addClass('btn-success')
				}
				e.preventDefault();
			});
		}
	}
})