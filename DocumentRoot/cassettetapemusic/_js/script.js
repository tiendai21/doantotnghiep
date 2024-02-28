var APP = APP || {};
APP.TOP = {
	isOLDIE: false,
	isSP: false,
	isTABLET: false,
	isPC: false,
	isSP_VIEW: false,
	SCRL_TOP: 0,
	TIME: null,
	VIEW_PORT: null,
	UA: navigator.userAgent,
	BREAK_POINT: 750,

	init : function(){
		var A = this;

	}
};


$(function(){
	APP.TOP.init();

	// iosのクラス付与
	var ua = navigator.userAgent;
	if(ua.indexOf('iPhone') > 0 || ua.indexOf('iPad') > 0 || ua.indexOf('iPod') > 0){
		$('html').addClass('is-ios');

		// 横向きios
		$(window).on('load orientationchange',function(){
			if(Math.abs(window.orientation) === 90){
				$('html').addClass('is-ios-landscape');
			}else{
				$('html').removeClass('is-ios-landscape');
			}
		}).trigger('load');
	}
});



