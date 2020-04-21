// ==============================================================
// keyboards
// ==============================================================
window.addEventListener("keydown",function (e) {

	// f1
	if (e.keyCode === 112) {
		e.preventDefault();
		// $('#string').focus();
	}
	// f2
	if (e.keyCode === 113) {
		e.preventDefault();
		// $('#star-add').focus();
	}
	// f3
	if (e.keyCode === 114) {
		e.preventDefault();
		$('#header-search').focus();
	}

});

// ==============================================================
// clone
// ==============================================================
function clone(target, parent) {
	$(target).clone().appendTo(parent);
}
