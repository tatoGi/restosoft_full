$.fn.dropUpload = function(a) {
	
	const name = $(this).data('name') + "[file][]";
	const kaalt = $(this).data('name') + "[alt_text][ka][]";
	const enalt = $(this).data('name') + "[alt_text][en][]";
	const youtube = $(this).data('name') + "[title][]";
	
	var $this = $(this);
  
	if(!a.size) {
	  a.size = 2*1024*1024;
	}
  
	if(a.image == undefined) {
	  a.image = true;
	}
  
	if($this.find("input[name=thumb]").length > 0) {
	  $thumb = $this.find("input[name=thumb]").eq(0);
	}
	else {
	  $thumb = $('<input type="hidden" name="thumb">');
	  $thumb.appendTo($this);
	}
  
	$this.on('dragover dragenter', function(e){
	  e.preventDefault();
	  $this.addClass('active');
	});
	$this.on('dragleave dragend drop', function(e){
	  e.preventDefault();
	  $this.removeClass('active');
  
	});
	$this.on('drop', function(e){
	  e.preventDefault();
	  var files = e.originalEvent.dataTransfer.files;
	  for (var i = 0; i < files.length; i++) {
		uploadFile(files[i]);
	  }
	});
  
	$this.before($('<input type="file" multiple>').change(function(){
	  var files = this.files;
  
	  for (var i = 0; i < files.length; i++) {
		uploadFile(files[i]);
	  }
	  
  
	  $(this).val(null);
	}));
  
	$this.prev().wrap("<div class='form-group'></div>");
  
	var uploadFile = function(file) {
  
	  if(!ValidateFile(file) && a.image) {
		alert(file.name + " isn't image");
		return false;
	  }
  
	  if(file.size > a.size) {
		console.log(file.size);
		alert(file.name + " is more than" + a.size/(1024*1024) + "MB");
		return false;
	  }
   
	  var formData = new FormData();
	  var $el = createElement();
	  $this.find('ul').append($el);
	  formData.append('file', file);
	  formData.append('file_additional', kaalt);
	  formData.append('file_additional', enalt);
	  formData.append('title', youtube);
	  var $aj = $.ajax({
		type: "POST",
		url: $this.attr('data-action'),
		data: formData,
		xhr: function () {
		  var myXhr = $.ajaxSettings.xhr();
		  if (myXhr.upload) {
			myXhr.upload.addEventListener('progress', progressHandling, false);
		  }
		  return myXhr;
		},
		success: function (data) {
		  $("<img>").attr('src','/' + data.thumb).on('load', function(){
			if($this.find('.active').length == 0) {
			  $el.addClass('active');
			  $thumb.val($el.find('input[type=hidden]').val());
			}
			$el.find('.progress-wrap').remove();
			$el.removeClass('uploading');
			$(this).appendTo($el);
			
			$input1 = $("<input>").attr({
				'type': 'text',
				'name': kaalt,
				'class': 'form-control',
				'placeholder':  'GEO' + ' Alt Text'
			  }).add($("<input>").attr({
				'type': 'text',
				'name':enalt,
				'class': 'form-control',
				'placeholder':  'ENG' + ' Alt Text'
			  }))
			  .add($("<input>").attr({
				'type': 'text',
				'name': youtube,
				'class': 'form-control',
				'placeholder': 'Youtube Link'
			  }).click(function(e){
				e.preventDefault();
				e.stopPropagation();
			  })).appendTo($el);
			  $(this).trigger('change');
  
			if(a.callback != null) {
			  a.callback($el);
			}
		  }).each(function() {
			if(this.complete) $(this).load();
		  });
  
		  var $input = $("<input>").attr({
			'type': 'hidden',
			'name': name
		  }).val(data.image).appendTo($el);
  
		  console.log(data);
		  if($this.find('li').length > 0) {
			$th = $thumb.val();
			$this.find('li > input[value="'+ $th +'"]').parent().addClass('active');
		
			$this.find('li').click(function() {
			  $this.find('.active').removeClass('active');
			  $(this).addClass('active');
			  $thumb.val($(this).find('input[type="hidden"]').val());
			});
		  }
		  $el.find('.close-it').unbind('click').click(function(e){
			e.stopPropagation();
  
			$p = $(this).parent();
			$.post($this.attr('data-delete'), {
			  files: $el.find('input[type="hidden"]').val(),
			  _token: $('meta[name="csrf-token"]').attr('content')
			}, function(data) {
			  $p.remove();
			  if($this.find('li').length > 0) {
				$this.find('li').eq(0).addClass('active');
				$thumb.val($this.find('li').eq(0).find('input[type=hidden]').val());
			  }
			  else {
				$thumb.val('');
			  }
			  console.log(data);
			});
			console.log('removed');
		  });
  
		  $el.click(function(){
			$this.find('.active').removeClass('active');
			$(this).addClass('active');
			$thumb.val($(this).find('input[type="hidden"]').val());
		  });
		},
		error: function (error) {
		  // handle error
		},
		async: true,
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		timeout: 60000
	  });
  
	//   $el.find('.close-it').click(function(e){
	// 	e.preventDefault();
	// 	$aj.abort();
	// 	console.log('aborted');
	// 	$(this).parent().remove();
  
	// 	if($this.find('li').length > 0) {
	// 	  $this.find('li').eq(0).addClass('active');
	// 	  $thumb.val($this.find('li').eq(0).find('input[type=hidden]').val());
	// 	}
	// 	else {
	// 	  $thumb.val('');
	// 	}
	//   });
  
	  function progressHandling(event) {
		var percent = 0;
		var position = event.loaded || event.position;
		var total = event.total;
		if (event.lengthComputable) {
		  percent = Math.ceil(position / total * 100);
		}
		// update progressbars classes so it fits your code
  
		$el.find('.progress').find('div').css('width', percent + "%");
		console.log(percent);
	  }
	}
  
  
	var createElement = function() {
	  var $el = $("<li>").addClass('uploading');
	  $el.append($("<div class='progress-wrap'>").append($('<div class="progress">').append('<div class="progress-bar">'))).append('<div class="close-it">');
	  
	  return $el;
	}
  
	// window.onbeforeunload = function(){
	//   var $arr = [];
	//   if($this.find('input').length() <= 0) {
	//     return true;
	//   }
	//
	//   $this.find('input').each(function(){
	//     $arr.push($this.val());
	//   });
	//
	//   $.post($this.attr('data-delete'), {files: $arr}, function(data){ console.log(data); });
	// }
	var submited = false;
	$(window).on('beforeunload',function(){
	  if(!submited) {
		if($this.find(`input[name="${name}"]`).length > 0) {
		  var $arr = [];
		  $this.find(`input[name="${name}"]`).each(function(){
			$arr.push($(this).val());
		  });
  
		  $.post($this.attr('data-delete'), {files: $arr}, function(data){ console.log(data); });
		}
	  }
	});
  
	a.form.submit(function(){
	  console.log('true');
	  submited = true;
	});
  
	$('.close-it').click(function(e){
	  e.stopPropagation();
	  e.preventDefault();
  
	  $.post($this.attr('data-delete'), {
		files: $(this).next().val()
	  }, function(data) {
		console.log(data);
	  });
  
	  $(this).parent().remove();
	  console.log('removed');
  
	  if($this.find('li').length > 0) {
		  $this.find('li').eq(0).addClass('active');
		  $thumb.val($this.find('li').eq(0).find('input[type=hidden]').val());
		}
		else {
		  $thumb.val('');
		}
	});
  
  
	if($this.find('li').length > 0) {
	  $th = $thumb.val();
	  $this.find('li > input[value="'+ $th +'"]').parent().addClass('active');
  
	  $this.find('li').click(function() {
		$this.find('.active').removeClass('active');
		$(this).addClass('active');
		$thumb.val($(this).find('input[type="hidden"]').val());
	  });
	}
  
  
	var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
	function ValidateFile(file) {
		
		var sFileName = file.name;
		console.log(file.name);
		if (sFileName.length > 0) {
			var blnValid = false;
			for (var j = 0; j < _validFileExtensions.length; j++) {
				var sCurExtension = _validFileExtensions[j];
				if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
					blnValid = true;
					break;
				}
			}
			
			if (!blnValid) {
				return false;
			}
		}
	  
		return true;
	}
  
  }

$(document).ready(function(){


$(".upload-box").each(function(){
	$(this).dropUpload({
		form: $('form'),
		headers: {
			'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
		}

	});
})
});

		
  