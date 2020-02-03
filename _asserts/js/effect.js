$(document).ready(function() {
	var now_page = window.location.pathname;
	var should_sort = ['/', '/render.php', '/do_search.php'];

	if (should_sort.indexOf(now_page) != -1){
		sort_table(1);
	}

	if (now_page == '/login.php')
		$('.main').animate({opacity: 1, bottom: 0},700);

	if (now_page == '/do_search.php'){
		var cnt = $('table tr').length-1;
		$('.result-cnt').text(cnt);
	}

	$.when(
		$('h1').animate({opacity: 1, top: 0},700),
		$('.main-inner').animate({opacity: 1, bottom: 0},700),
	)
	.then(
		function(){
			return $('.success-info, .failed-info, .warning-info').animate({opacity: 1, top: 0},700)
		}
	)
	
	var table_element = $('table tr');
	var each_element  = $.makeArray(table_element).map( function(currentValue, index) {
		return $(currentValue).delay(index*20+100).animate({ opacity: 1, bottom: 0 }).promise();
	})

	setTimeout( function() {
			$('.info-block').animate({opacity: 0, top: -50},700);
	}, 3000);

	$('td.name a').each( function() {
		if($(this).text().length > 25){
			$(this).attr("title",$(this).text());
            var text=$(this).text().substring(0,24)+"...";
            $(this).text(text);
		}
    });
    
    $('td.icon').mouseenter(function(){
        $(this).find('svg').detach();
        $(this).append('<svg class="svg-inline--fa fa-trash fa-w-14 pointer" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>')
    });

    $('td.icon-file').mouseleave(function(){ 
        $(this).find('svg').detach();
        $(this).append('<svg class="svg-inline--fa fa-file-alt fa-w-12 pointer" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg=""><path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm64 236c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-64c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-72v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm96-114.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z"></path></svg>')
    })

    $('td.icon-folder').mouseleave(function(){ 
        $(this).find('svg').detach();
        $(this).append('<svg class="svg-inline--fa fa-folder fa-w-16 pointer" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="folder" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 128H272l-64-64H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V176c0-26.51-21.49-48-48-48z"></path></svg>')

    })

	$('.login').click( function() {
		var flag = true;

		if(!$('.account-box input').val() || !$('.password-box input').val()){
            $('input').prop('required',true);
			$('.login').attrA
            flag = false;
            
            setTimeout(function() {
                $('input').prop('required',false);
            }, 2000);
		}

		return flag;
	});

	$('.upload-btn, .close-upload-btn').click( function(){
		$('.upload-list').toggleClass("upload-list-on");
	});	

	$('.upload-file-btn,  .close-upload-btn').click( function(){
		$('.upload-list').toggleClass("upload-list-on");
		$('.file-upload-box').toggleClass("file-upload-box-on");
		$('.main-inner, header, footer').toggleClass('disable');

		if ($(this).hasClass('upload-file-btn'))
			check_input();

        document.querySelector('#fileToUpload').files;
        $('.file-location').text('');
        $('.file-location-box').removeClass('require-file');
        
		return false;
    });
    
    $('.ready-upload-btn').on('click', function() {
        if (document.querySelector('#fileToUpload').files.length == 0) {
            $('.file-location-box').addClass("require-file");

            setTimeout(function() {
                $('.file-location-box').removeClass("require-file");
            }, 2000);
        }
    });

	$('.create-dir, .create-dir-box .check-btn:last-child').click( function(){
		$('.upload-list').removeClass("upload-list-on");
		$('.create-dir-box').toggleClass('create-dir-box-on');
		$('.main-inner, header, footer').toggleClass('disable');

		return false;
	});
    
    $('.create-dir-box .check-btn:first-child').on('click', function () {

        if ($('#dir_name')[0].value == "") {
            $('#dir_name').prop('required',true);

            setTimeout(function() {
                $('#dir_name').prop('required',false);
            }, 2000);
            return false
        }
    });

	var $which_delete;
	
	$('.icon').click( function(){
		$('.delete-check-box').addClass('delete-check-box-on');
		$('.main-inner, header, footer').addClass('disable');
		$('.delete-check-box h4').text('Delete "' + $(this).parent().children('.name').text() + '" ?');

		$which_delete = $(this);
		console.log($which_delete);
	});

	$('.delete-check-box .check-btn:last-child').click( function(){
		$('.main-inner, header, footer').removeClass('disable');
		$('.delete-check-box').removeClass('delete-check-box-on');
	});

	$('.delete-check-box .check-btn:first-child').click( function(){

		var should_delete = $which_delete.attr('value');
		console.log(should_delete);
		//var del_arr 	  = should_delete.split('/');
		//var should_delete = del_arr[del_arr.length-1];

		$.ajax({
			url: '/_exec/do_delete.php',
			type: 'post',
			data: { 'file': should_delete},
			error: function (xhr) { },
			success: function (response) {
				location.reload();
			}
		});
    });

    $('.search-go').on('click', function() {
        if ($('#search-file')[0].value == "") {
            $('#search-file').prop('required',true);

            setTimeout(function() {
                $('#search-file').prop('required',false);
            }, 2000);

            return false
        }
    });
    
    // drag and drop
    var self_drag = 0;
    var drag_who = null;

    $('html').on('dragover', function () {
        if (now_page != '/login.php' && !self_drag) {
            event.preventDefault();  
            event.stopPropagation();
            $('.main-inner, header, footer').addClass('disable');
		    $('.drag-upload-box').addClass("drag-upload-box-on");
        }
    });

    /*if (!($('.drag-upload-box').hasClass("drag-upload-box-hover"))) {
        setTimeout(function(){ }, 500);
        $('html').on('dragleave', function () {
            event.preventDefault();  
            event.stopPropagation();
            $('.main-inner, header, footer').removeClass('disable');
            $('.drag-upload-box').removeClass("drag-upload-box-on");
        });
    }*/
        

    /*$('html').on('drop', function () {
        event.preventDefault();  
        event.stopPropagation();
    });*/

    $('.drag-upload-box').on('dragover', function () {
        event.preventDefault();  
        event.stopPropagation();
	    $('.drag-upload-box').addClass("drag-upload-box-hover");
    });

    $('.drag-upload-box').on('dragleave', function () {
        event.preventDefault();  
        event.stopPropagation();
	    $('.drag-upload-box').removeClass("drag-upload-box-hover");
    });

    $('.drag-upload-box').on('drop', function (e) {
        event.preventDefault();  
        event.stopPropagation();

        var file  = e.originalEvent.dataTransfer.files;
    
        var fd = new FormData(drag);
        fd.set('drag-file[]', file[0]);
        for (i=1; i<file.length; i++)
            fd.append('drag-file[]', file[i]);
        fetch("/_exec/drag_upload.php", {
            method: 'POST',
            body: fd,
          }).then(response => {
            window.location.reload();
          })
    });

    $('tr').on('dragstart', function (e) {
        self_drag = 1;
        var crt = $(this).find('a').clone(true);
        crt.addClass('ghost-drag-box');

        if (crt[0].title!="") {
            crt[0].text = crt[0].title;
        }

        $('body').append(crt[0]);

        if (drag_who == null) {
            drag_who = $(this).find('a').text();
            if ($(this).find('a')[0].title != ""){
                drag_who = $(this).find('a')[0].title;
            }
        }

        e.originalEvent.dataTransfer.setDragImage(crt[0], 0, 0);
    });

    $('tr').on('dragend', function () {
        event.preventDefault();  
        event.stopPropagation();

        self_drag = 0;
        drag_who = null;

        $('.ghost-drag-box').remove();
    });

    var dest = null;

    $('tbody tr').on('dragover', function () {
        event.preventDefault();  
        event.stopPropagation();

        if ($(this).find('a').hasClass('ftb-dir')){
            dest = $(this).find('a').text();
        }
    });

    $('tbody tr').on('drop', function () {
        event.preventDefault();  
        event.stopPropagation();

        var $this = $(this).find('a');

        if ($(this).find('a').hasClass('ftb-dir')){
            $.ajax({
                url: '/_exec/move_file.php',
                type: 'post',
                data: { 'target': drag_who, 'destination': dest},
                error: function (xhr) { },
                success: function (response) {
                    $this.click();
                }
            });
        }
    });

    var back_nest = 0

    $('.pwd a').on('dragover', function () {
        event.preventDefault();  
        event.stopPropagation();

        for (var i=0; i<$('.pwd a').length; i++) {
            if ($('.pwd a')[i].text == $(this).text())
                break;
        }

        back_nest = $('.pwd a').length - i - 1;
        if (i==0) {
            back_nest = -1;
        }
        dest = $(this).text();
    });

    $('.pwd a').on('drop', function () {
        event.preventDefault();  
        event.stopPropagation();

        if (back_nest == 0)
            return;

        var $this = $(this);

        $.ajax({
            url: '/_exec/move_file.php',
            type: 'post',
            data: { 'target': drag_who, 'destination': dest, 'back': back_nest},
            error: function (xhr) { },
            success: function (response) {
                if (back_nest==-1)
                    window.location='/';
                else
                    $this.click();
            }
        });
    
    });
});

function run_dot(){
	var dots=document.getElementById('dot');
	if(dots.innerHTML.length>3)
		dots.innerHTML="";
	else
		dots.innerHTML+=".";
}

function sort_table(n){
	var tables, rows, swap, is_asc, i, x, y, does, cnt; 
	
	tables  = document.getElementsByTagName("table")[0];
	swap   = true;
	is_asc = true;
	cnt=0;

	var th = document.getElementsByTagName("TH")[n];

	$('th').removeClass('asc');
	$('th').removeClass('dec');

	while (swap) {
		swap = false;
		rows = tables.rows;
	
		for (i=1;i<(rows.length-1);i++) {
			does = false;

			x=rows[i].getElementsByTagName("TD")[n];
			y=rows[i+1].getElementsByTagName("TD")[n];
			
			if (is_asc){
				if (x.innerHTML.toLowerCase()>y.innerHTML.toLowerCase()){
					does=true;
					break;
				}
			}
			else {
				if (x.innerHTML.toLowerCase()<y.innerHTML.toLowerCase()){
					does=true;
					break;
				}
			}

		}

		if (does) {
			rows[i].parentNode.insertBefore(rows[i+1], rows[i]);
			swap=true;
			cnt++;
		}
		else {
			if (!cnt && is_asc){
				is_asc=false;
				swap=true;
			}
		}

	}
	
	if (is_asc){
		th.classList.add('asc');
	}
	else {
		th.classList.add('dec');
	}

}

function close_box() {
	$('.download-check-box').removeClass('download-check-box-on');
	$('.main-inner').removeClass('disable');
}

function open_box(file){
	$('.download-check-box').addClass('download-check-box-on');
	$('.main-inner').addClass('disable');

	var file_s = file.split('/')
	file_s = file_s[file_s.length - 1];

	$('.download-check-box h4').text('Download "' + file_s + '" ?')

	$('.check-btn > a').attr({
		"href": file,
		"download" : file
	})
}

function check_input(){
	const fileUploader = document.querySelector('#fileToUpload');

	fileUploader.addEventListener('change', (e) => {
        $('.file-location').text(e.target.files[0].name);
        $('.file-location-box').removeClass('require-file');
    });

	return true;
}
  
function jump_path(path){
	$.ajax({
		type: 'POST',
		url: '/_exec/set_session.php',
		data: { 'pwd': path},
		error: function() {
			alert('error');
		},
		success: function(response) {
			//calert(response);
			location.replace('/render.php');
		},
	})

}
