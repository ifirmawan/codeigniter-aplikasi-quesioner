$(function() {

    $('#show-hide-sidebar-toggle').on('click', function() {
        if (!$('body').hasClass('sidebar-hidden')) {
            $('body').addClass('sidebar-hidden');
        } else {
            $('body').removeClass('sidebar-hidden');
        }
    });

    // Set up your table
    table = $('#my-table').DataTable({
        "order":[[2,"desc"]]
    });

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            return true;
        }
    );
	if($('.datepicker').length > 0){
        
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $(document).on('click','.open-calender',function(){
            $('.datepicker').val("");
        });
        
    }

    $(document).on('change','select[name="status_peserta"]',function(){
    	if ($(this).val() == 'pakar') {
    		$('div.kode-pakar').css('display','block');
    	}
    });

    $(document).on('click','.btn-confirm',function(){
        if(confirm('Anda sudah yakin? tindakan ini tidak dapat mengembalikan keadaan sebelumnya')){
            return true;
        }
        return false;
    });

    /* scroll down */
        var lastScrollTop = 0;
        $(window).scroll(function(event){
            var st = $(this).scrollTop();
            if (st > lastScrollTop){
                // downscroll code
            } else {
                // upscroll code
            }
            lastScrollTop = st;
        });

    /* end scroll */

});

function fadeOut(el){
  el.style.opacity = 1;

  (function fade() {
    if ((el.style.opacity -= .1) < 0) {
      el.style.display = "none";
    } else {
      requestAnimationFrame(fade);
    }
  })();
}

// fade in

function fadeIn(el, display){
  el.style.opacity = 0;
  el.style.display = display || "block";

  (function fade() {
    var val = parseFloat(el.style.opacity);
    if (!((val += .1) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    }
  })();
}