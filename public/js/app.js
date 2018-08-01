(function($){

/*
*	Lire la documentation https://github.com/js-cookie/js-cookie
*	Ajouter un cookie sur le poste de l'utilisateur s'il clique sur le bouton OK.
* 	Lorsqu'il clique sur OK on efface la cookie bar et elle ne revient pas au
*	chargement.
*	Le cookie doit porter le nom : cookie_toutsamplement et la valeur : clicked
* 	et une durée de validité de : 1 jour.
*/

	if(Cookies.get('cookie_toutsamplement') === undefined){
		$('body').append('<div id="cookie_bar" class="cookie_bar">Bonjour et bienvenue <hr>' +
			'<a class="text-warning" href="http://localhost:8000/cgu" title="">Lien vers CGU</a> <hr>' +
			'<button id="cookie_btn" class="cookie_btn">J\'accepte</button></div>');
		$('#cookie_btn').click(function(){
			$('#cookie_bar').fadeOut();
			Cookies.set('cookie_toutsamplement', 'clicked', {expires: 1});
		});
	}


})(jQuery);