window.addEventListener('scroll', function() {
    let element_1 = document.querySelector('.quote-top');
    let element_2 = document.querySelector('.quote-bottom');

    let position_1 = element_1.getBoundingClientRect();
    let position_2 = element_2.getBoundingClientRect();

	// checking for partial visibility
	if(position_1.top < (window.innerHeight - 100) && position_1.bottom >= 0) {
		element_1.style.opacity = 1;
    }
    
    if(position_2.top < (window.innerHeight - 100) && position_2.bottom >= 0) {
		element_2.style.opacity = 1;
    }
});