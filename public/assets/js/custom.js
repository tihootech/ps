// ==============================================================
// inits
// ==============================================================

$(document).ready(function () {
	$('[data-toggle=popover]').popover({
		placement: 'top',
		trigger: 'hover',
		html: true,
	});
});

// ==============================================================
// keyboards
// ==============================================================

$('#inputs input:first').focus();
window.addEventListener("keydown",function (e) {

	// f1
	if (e.keyCode === 112) {
		e.preventDefault();
		$('#inputs input:first').focus();
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
	var e = $(target).clone();
	e.val('');
	e.appendTo(parent);
}
