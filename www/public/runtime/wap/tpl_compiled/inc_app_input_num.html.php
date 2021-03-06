<?php if ($this->_var['is_app'] == 1): ?>

<script>
$(document).ready(function () {
	var is_set_app = '<?php echo $this->_var['is_app']; ?>';
	var dstop 		= parseInt( $(document).scrollTop() ); 
 	var docHset   	= parseInt( $(window).height() * 0.15 ); 
 	
	if(is_set_app == '1'){
		$(document).scroll(function() {
			dstop 		= $(document).scrollTop();
	 		$('.app-num-box').css('top', docHset+dstop+'px');
	 	});
		
		var acin = $("input[name='app_choose_item_number']");
		$('.buy_number_js').click(function(){
			var num_obj = $(this);
			
			// 先隐藏预选包尾
			$(".add-to-list").removeClass('add-to-list-up');
			
			acin.val( num_obj.val() );
			acin.attr( 'data-id', num_obj.attr('data-id') );
			$('.app-num-box').css('display', 'block');
			$(".add-bg").show();
			acin.get(0).focus(); // 不转成js对象的话，可能因为冒泡导致错误
			
			// 禁止触摸
			$("body").bind("touchmove",function(event){
				event.preventDefault();
			});
			
		});
		 
		
		$('.num-comfirm').click(function(){
			$('.app-num-box').css('display', 'none');
			$( '.buy-num-'+acin.attr('data-id') ).val( acin.val() );
			$(".add-bg").hide();
			button_buy_box_show();
			
			$(".add-to-list").addClass('add-to-list-up');
		});
		
		$('.num-cancel').click(function(){
			$('.app-num-box').css('display', 'none');
			$(".add-bg").hide();
			button_buy_box_show();
			
			$(".add-to-list").addClass('add-to-list-up');
		});
		
		// + -
		$('.app-cart-num').bind("click", function () {
			button_buy_box_hide();
			var data_id = acin.attr('data-id');
			var number = parseInt(jsondata[data_id]["number"]);
			var unit_price = parseFloat(jsondata[data_id]["unit_price"]);
	        var min_buy = parseFloat(jsondata[data_id]["min_buy"]);
	        var residue_count = parseFloat(jsondata[data_id]["residue_count"]);
			
	        if( $(this).hasClass('minus_') ){
	        	jsondata[data_id]["number"] = number-min_buy < 1 ? 1 : number-min_buy;
	        }else{
	        	jsondata[data_id]["number"] = number+min_buy > residue_count ? residue_count : number+min_buy;
	        }
	        
	        
			$(".buy-num-"+data_id).val(jsondata[data_id]["number"]);
			acin.val(jsondata[data_id]["number"]);

			call_total_show();
	    	
	    	acin.css("font-size", '0.9rem');
	        setTimeout(function(){
	        	acin.css("font-size", '0.5rem');
	        }, 200 );
	     
		});
		 
	}
});
</script>

<div class="num-box app-num-box">
	<div class="info">
		<div class="pay-select">
			<p class="tit">修改数量</p>
		  	<div class="select">
		  		<a href="javascript:;" class="iconfont split-line-right minus_ app-cart-num">&#xe6d3;</a>
		  		<input max-buy="" min-buy="" cur-buy=""  name="app_choose_item_number" class="buy_number set-buy-num" type="tel" value="<?php echo $this->_var['item']['number']; ?>" data-id="<?php echo $this->_var['item']['id']; ?>" />
		  		<a href="javascript:;" class="iconfont split-line-left plus_ app-cart-num">&#xe6d1;</a>
		  		<div id="duobao_item_id_set" data-id="" style="display:none"></div>
		  	</div>
		  	<div class="num-btn-box flex-box">
		  		<input type="hidden" name="org_num" value="" />
		  		<a href="javascript:;" class="num-btn flex-1 num-comfirm">确定</a>
		  		<a href="javascript:;" class="num-btn flex-1 num-cancel">取消</a>
		  	</div>
		</div>
	</div>
</div>
<div class="add-bg"></div>

<?php endif; ?>
