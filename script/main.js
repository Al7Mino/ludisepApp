if (mjRight==undefined) {
	var mjRight=false;
}

$(document).ready(function() {

	/*** Responsive Design - Window size < 600px ***/

	if(window.matchMedia('(max-width: 600px)').matches) {
		$('nav > ul').before('<div class="menu"><img src="./img/menu.png"></div>');
		$('nav .level-2').parent()

		$('.menu img').click(function() {
			if($('nav > ul').hasClass('active')) {
				$('nav > ul').slideUp(200);
				$('nav > ul').removeClass('active');
			}
			else {
				$('nav > ul').slideDown(200);
				$('nav > ul').addClass('active');
			}
		});
		$('#nav_sous_menu').click(function() {
			if($('nav .level-2').hasClass('active')) {
				$('nav .level-2').slideUp(200);
				$('nav .level-2').removeClass('active');
				$('nav img.arrow').removeClass('rotate');
			}
			else {
				$('nav .level-2').slideDown(200);
				$('nav .level-2').addClass('active');
				$('nav img.arrow').addClass('rotate');
			}
		});
	}

	/*** Calendrier ***/
	function loadCalendrier(month, year) {
		$.post('./includes/show_calendrier.inc.php',
			{
				month: month,
				year: year
			},
			function(data) {
				$('.calendrier').remove();
				$('.calendar').append(data);
				showEvent();
				$('.calendrier i').click(function() {
					var date = $(this).attr('data-date');
					var year = date.split('-')[0];
					var month = date.split('-')[1];
					loadCalendrier(month, year);
				});
			});
	}

	function showEvent() {
		$('.jourEvent').click(function() {
			var events = $(this).attr('data-events').split(' ');
			events.splice(-1,1);
			$.post('./includes/show_event.inc.php',
			{
				id: events
			},
			function(data) {
				$.alert({
					title: '',
					content: data,
				});
			});
		});
	}

	loadCalendrier(null, null);

	/*** Admin Event ***/
	$('#admin_event button.ajout').click(function() {
		$(this).before('<form method="POST" action="./includes/add_event.inc.php" class="flex-column">'+
							'<label for="titre">Titre de l\'événement</label><input type="text" name="titre" required><br>'+
							'<label for="date_debut">Début de l\'événement</label><input type="date" name="date_debut" required><br>'+
							'<label for="date_fin">Fin de l\'événement</label><input type="date" name="date_fin" required><br>'+
							'<label for="contenu">Contenu de l\'événement</label><textarea name="contenu" rows="7" required></textarea><br>'+
							'<input class="bouton" type="submit" value="Enregistrer l\'événement">'+
						'</form>');
		$(this).addClass('hide');
	});

	$('#admin_event .edit').each(function() {
		$(this).click(function() {
			var titre = $(this).siblings('div').find('h2').text();
			var date_debut = $(this).siblings('div').find('i.date-debut').text();
			var date_fin = $(this).siblings('div').find('i.date-fin').text();
			var contenu = $(this).siblings('div').find('p').text();
			var id = $(this).parent().attr('data-id');
			if($(this).siblings('div').hasClass('hide')) {
				$(this).siblings('div').removeClass('hide');
				$(this).siblings('form').remove();
			}
			else {
				$(this).siblings('div').addClass('hide');
				$(this).before('<form method="POST" action="./includes/modify_event.inc.php" class="flex-column">'+
					'<input type="hidden" name="id" value="'+id+'" required>'+
					'<label for="titre">Titre de l\'événement</label><input type="text" name="titre" value="'+titre+'" required><br>'+
					'<label for="date_debut">Début de l\'événement</label><input type="date" name="date_debut" value='+date_debut+' required><br>'+
					'<label for="date_fin">Fin de l\'événement</label><input type="date" name="date_fin" value='+date_fin+' required><br>'+
					'<label for="contenu">Contenu de l\'événement</label><textarea name="contenu" rows="7" required>'+contenu+'</textarea><br>'+
					'<input class="bouton" type="submit" value="Enregistrer l\'événement">'+
				'</form>');
			}
		});
	});

	$('#admin_event .suppr').each(function() {
		$(this).click(function() {
			var id = $(this).parent().attr('data-id');
			$.confirm({
				title: 'Suppression',
				content: 'Êtes-vous sûr de vouloir supprimer cet événement ?',
				buttons: {
					Supprimer: function() {
						$.post('./includes/suppr_event.inc.php',
							{
								id: id
							});
						setTimeout(function(){
							location.reload();
						}, 200);
					},
					Annuler: function() {}
				}
			});
		});
	});




	/*** Menu déroulant ***/
	$('#nav_sous_menu').mouseover(function() {
		$(this).addClass('menu-border');
		$(this).addClass('hover-menu');
		$('nav .level-2').slideDown(200);
		$('nav img.arrow').addClass('rotate');
	});
	$('#nav_sous_menu').parent().mouseleave(function() {
		$('nav .level-2').slideUp(200);
		$('nav img.arrow').removeClass('rotate');
		setTimeout(function() {
			$('#nav_sous_menu').removeClass('menu-border');
			$('#nav_sous_menu').removeClass('hover-menu');
		}, 200);
	});

	/*** Univers ***/

	/*Adapte la taille des images en fonction de la plus petite (en hauteur)*/
	function adaptSize() {
		min_height = $('#univers .types-univers img').height();
		$('#univers .types-univers img').each(function() {
			console.log('Test1: '+$(this).height());
			if($(this).height() < min_height) {
				min_height = $(this).height();
				console.log('Test2: '+min_height);
			}
		});
		$('#univers .types-univers img').each(function() {
			$(this).css('width', 'auto');
			if (min_height != 0) {
				$(this).height(min_height);
			}
			else {
				$(this).height('200px');
			}
		});
	}
	$(window).on("load", function() {
		adaptSize();
	});
	$(window).resize(function() {
		$('#univers .types-univers img').each(function() {
			$(this).css('width', '100%');
			$(this).height('auto');
		});
		adaptSize();
	});

	/*** Inscription ***/

	var regex = '^[a-zA-Z0-9._-]+@isep.fr$'
	$('#inscription form').submit(function(e) {
		var mail = $('#inscription input[name*=adresse_mail]').val();
		if(mail.match(regex)==null) {
			e.preventDefault();
			$('#inscription form').prepend('<p style="color: red;">L\'adresse mail renseignée n\'est pas valide. Vous devez utiliser votre adresse mail ISEP.</p>');
			$('#inscription input[name*=adresse_mail]').val("");
		}
	});

	$('i.fa-eye').click(function() {
		var typeField = $('input[name="mdp"]').attr('type');
		if(typeField == "password") {
			$('input[name="mdp"]').attr('type','text');
			$('input[name="mdp_confirm"]').attr('type','text');
		}
		else {
			$('input[name="mdp"]').attr('type','password');
			$('input[name="mdp_confirm"]').attr('type','password');
		}
	});

	/*** Compte ***/

	/*** Edition du profil ***/
	$('.profil').children().each(function() {
		var htmlProfilPart = $(this);
		$(this).find('img').click(function(){
			if(htmlProfilPart.find('span').hasClass('hide')) {
				htmlProfilPart.find('span').removeClass('hide');
				htmlProfilPart.find('textarea').addClass('hide');
				htmlProfilPart.find('select').addClass('hide');
			}
			else if(htmlProfilPart.find('textarea').hasClass('hide') || htmlProfilPart.find('select').hasClass('hide')) {
				htmlProfilPart.find('textarea').removeClass('hide');
				htmlProfilPart.find('select').removeClass('hide');
				htmlProfilPart.find('span').addClass('hide');
			}
		});
		$(this).find('textarea').focusout(function() {
			var value = $(this).val();
			var classes = $(this).attr('class').split(' ');
			var classe = classes[0];
			$.post('./includes/modify_user.inc.php',
				{
					modification: classe,
					value: value
				});
			setTimeout(function(){
				location.reload();
			}, 200);
		});
		$(this).find('select').focusout(function() {
			var value = $(this).val();
			var classes = $(this).attr('class').split(' ');
			var classe = classes[0];
			$.post('./includes/modify_user.inc.php',
				{
					modification: classe,
					value: value
				});
			setTimeout(function(){
				location.reload();
			}, 200);
		});
		$(this).find('input').change(function() {
			htmlProfilPart.find('img.avatar').attr('src', URL.createObjectURL(this.files[0]));
		});
		$(this).find('.select-img').hover(function() {
			htmlProfilPart.find('.avatar-content img').fadeTo(500, 0.2);
			htmlProfilPart.find('.avatar-content div').fadeTo(500, 1);
		}, function() {
			htmlProfilPart.find('.avatar-content img').fadeTo(500, 1);
			htmlProfilPart.find('.avatar-content div').fadeTo(400, 0);
		});
	});

	/*** Membres ***/

	/*** Edition des membres par l'administrateur ***/
	$('.membres').children().each(function() {
		var htmlMembre = $(this);
		$(this).find('select').focusout(function() {
			var value = $(this).val();
			var classe = $(this).attr('class');
			var url = htmlMembre.find('.membre').attr('href').split('=');
			var id = url[1];
			$.post('./includes/modify_user.inc.php',
				{
					id: id,
					modification: classe,
					value: value
				});
			setTimeout(function(){
				location.reload();
			}, 200);
		});
	});

	/*** Personnages ***/

	//Insertion du form pour ajouter un personnage
	$('.personnages button').click(function() {
		$(this).before('<div>'+
						'<form method="POST" action="./includes/upload_perso.inc.php" enctype="multipart/form-data">'+
							'<div>'+
								'<div class="flex-column item-1">'+
									'<input type="hidden" name="MAX_FILE_SIZE" value="1000000"><label>Image du personnage</label></br>'+
									'<input type="file" name="image_perso">'+
								'</div>'+
								'<div class="item-2">'+
									'<textarea name="description_perso" rows="7" placeholder="Description du personnage"></textarea>'+
								'</div>'+
								'<div class="flex-column item-3">'+
									'<label>* Nom du personnage :</label></br><input style="margin-bottom: 16px;" type="text" name="nom_personnage" required></br>'+
									'<input type="hidden" name="MAX_FILE_SIZE" value="500000"> <label>Fiche de personnage</label></br>'+
									'<input type="file" name="fiche_perso">'+
								'</div>'+
							'</div>'+
							'<input class="bouton" type="submit" name="envoyer-perso" value="Enregistrer le personnage">'+
						'</form>'+
					'</div>');
		$(this).addClass('hide');
	});

	/*** Modifier la visibilité de la fiche de personnage ***/
	$('#ficheVisibleCheck').click(function() {
		var id = $(this).parent().parent().find('input[type*="hidden"]').val();
		$.post('./includes/modify_personnage.inc.php',
			{
				id_perso: id,
				modif_visible: true
			});
	});

	/*** Edition et suppression des personnages ***/
	$('.personnages').children().each(function() {
		$(this).find('.edit').click(function(){
			$(this).parent().parent().find('.image-perso, .description-perso, .info-perso').children().each(function(){
				if ($(this).hasClass('hide')) {
					$(this).removeClass('hide');
				}
				else {
					$(this).addClass('hide');
				}
			});
			if ($(this).parent().parent().parent().find('form').hasClass('hide')){
				$(this).parent().parent().parent().find('form').removeClass('hide');
			}
			else {
				$(this).parent().parent().parent().find('form').addClass('hide');
			}
		});
		$(this).find('.suppr').click(function(){
			var id = $(this).parent().parent().parent().find('form input[type*="hidden"]').val();
			$.confirm({
				title: 'Suppression',
				content: 'Êtes-vous sûr de vouloir supprimer ce personnage ?',
				buttons: {
					Supprimer: function() {
						$.post('./includes/suppr_personnage.inc.php',
							{
								id: id
							});
						setTimeout(function(){
							location.reload();
						}, 200);
					},
					Annuler: function() {}
				}
			});
		});
	});

	/*** Quêtes ***/

	/*** Affichage des quêtes ***/
	$('img.arrow').click(function() {
		var part = $(this).parent().parent().find('p');
		if ($(this).hasClass('rotate')) {
			$(this).removeClass('rotate');
			part.slideUp(400);
		}
		else {
			$(this).addClass('rotate');
			part.slideDown(400);
		}
	});

	/*** Visualisation des personnages participant aux quêtes ***/
	$('#quete .quete-cours span').click(function() {
		var id = ($(this).attr('id').split('-'))[1];
		var nom = $(this).text();
		$.post('./includes/getPersoQuete.inc.php',
				{
					id: id
				},
				function(data){
					$.dialog({
						title: nom,
						type: 'blue',
						content: data
					});
				});
	});

	/*** Modification des quêtes ***/
	$('#quete .edit').click(function() {
		var element = $(this).parent().parent();
		if(element.find('h3').hasClass('hide')) {
			element.find('h3').removeClass('hide');
			element.find('p').removeClass('hide');
			element.find('span.img').addClass('hide');
			element.find('textarea').each(function(){
				$(this).addClass('hide');
			});
		}
		else {
			element.find('h3').addClass('hide');
			element.find('p').addClass('hide');
			element.find('span.img').removeClass('hide');
			element.find('textarea').each(function(){
				$(this).removeClass('hide');
			});
		}
	});
	$('#quete textarea[class*=quete]').each(function() {
		$(this).focusout(function() {
			var value = $(this).val();
			var classes = $(this).attr('class').split(' ');
			var modification = classes[0];
			var quetes = classes[1].split('-');
			var quete = quetes[1];
			$.post('./includes/modify_quete.inc.php',
				{
					quete: quete,
					modification: modification,
					value: value
				});
		});
	});

	$('.quetes button').click(function() {
		$(this).before('<form class="flex-column add-quete" method="POST" action="./includes/add_quete.inc.php">'+
							'<label>Titre</label><input type="text" name="titre">'+
							'<label>Description</label><textarea name="description" rows="7" cols="100"></textarea>'+
							'<input type="submit" value="Créer la quête">'+
						'</form>');
		$(this).addClass('hide');
	});

	$('#quete .suppr').click(function(){
		var quete = (($(this).parent().parent().find('textarea[class*="quete"]').attr('class').split(' '))[1].split('-'))[1];
		$.confirm({
			title: 'Suppression',
			content: 'Êtes-vous sûr de vouloir supprimer cette quête ?',
			buttons: {
				Supprimer: function() {
					$.post('./includes/suppr_quete.inc.php',
						{
							quete: quete
						});
					setTimeout(function(){
						location.reload();
					}, 200);
				},
				Annuler: function() {}
			}
		});
	});

	/*** Puces ***/

	var nom;
	var info;
	var sorts = [];
	var descriptions = [];
	var types1 = [];
	var types2 = [];
	var types_bonus = [];
	var couts_pe = [];
	var couts_charge = [];
	var sort;
	var description;
	var type1;
	var type2;
	var type_bonus;
	var cout_pe;
	var cout_charge;

	/* Ajout de puces */
	$('#puce button.ajout').click(function() {
		$(this).addClass('hide');
		$.confirm({
			title: 'Ajout de puce',
			content: '<form id="ajout-puce" class="flex-column add-puce">'+
						'<label>Nom de la puce</label><input type="text" name="nom" placeholder="Requis" required>'+
						'<label>Informations</label><textarea name="info"></textarea>'+
						'<fieldset>'+
							'<legend>Sort</legend>'+
							'<div class="flex-column add-sort">'+
								'<label>Nom du sort</label><input type="text" name="sort" placeholder="Requis" required>'+
								'<label>Description</label><textarea name="description" placeholder="Requis" required></textarea>'+
								'<label>Type</label><input type="text" name="type1" placeholder="magique, arme, ...">'+
								'<label>Effet</label><input type="text" name="type2" placeholder="buff, débuff, soin, ...">'+
								'<label>Mot clé</label><input type="text" name="type_bonus" placeholder="météo, évolution, ...">'+
								'<label>Coût</label>'+
								'<div>'+
									'<input type="number" name="pe" placeholder="Requis" required><span> PE</span>'+
								'</div>'+
								'<div>'+
									'<input type="number" name="charge"><span> Charge</span>'+
								'</div>'+
							'</div>'+
						'</fieldset>'+
						'<button class="bouton ajout ajout-sort" type="button">Ajouter un sort</button>'+
					'</form>',
			onContentReady: function() {
				/* Complète le formulaire avec un nouveau sort à ajouter quand on clique sur le bouton */
				$('#puce button.ajout-sort').click(function() {
					$(this).before('<fieldset>'+
										'<legend>Sort</legend>'+
										'<div class="flex-column add-sort">'+
											'<label>Nom du sort</label><input type="text" name="sort" required>'+
											'<label>Description</label><textarea name="description" required></textarea>'+
											'<label>Type</label><input type="text" name="type1" placeholder="magique, arme, ...">'+
											'<label>Effet</label><input type="text" name="type2" placeholder="buff, débuff, soin, ...">'+
											'<label>Mot clé</label><input type="text" name="type_bonus" placeholder="météo, évolution, ...">'+
											'<label>Coût</label>'+
											'<div>'+
												'<input type="number" name="pe" required><span> PE</span>'+
											'</div>'+
											'<div>'+
												'<input type="number" name="charge"><span> Charge</span>'+
											'</div>'+
										'</div>'+
									'</fieldset>');
				});
			},
			buttons: {
				create: {
					text: 'Créer la puce',
					action: function() {
							var end = false;
							$('#puce #ajout-puce input:required, #puce #ajout-puce textarea:required').each(function(){
								if($(this).val()==null || $(this).val()=='' || $(this).val()==0) {
									alert($(this)[0].name+' is required');
									end = true;
								}
							});
							if(!end) {
								sorts = [];
								descriptions = [];
								types1 = [];
								types2 = [];
								types_bonus = [];
								couts_pe = [];
								couts_charge = [];
								nom = $('#puce form > input[name*="nom"]').val();
								info = $('#puce form > textarea[name*="info"]').val();
								$('#puce form > fieldset').each(function() {
									sorts.push($(this).find('input[name="sort"]').val());
									descriptions.push($(this).find('textarea[name="description"]').val());
									types1.push($(this).find('input[name="type1"]').val());
									types2.push($(this).find('input[name="type2"]').val());
									types_bonus.push($(this).find('input[name="type_bonus"]').val());
									couts_pe.push($(this).find('input[name="pe"]').val());
									couts_charge.push($(this).find('input[name="charge"]').val());
								});
								$.post('./includes/add_puce.inc.php',
									{
										nom: nom,
										info: info
									},
									function(data) {
										var i = 0;
										$('#puce form > fieldset').each(function() {
											sort = sorts[i];
											description = descriptions[i];
											type1 = types1[i];
											type2 = types2[i];
											type_bonus = types_bonus[i];
											cout_pe = couts_pe[i];
											cout_charge = couts_charge[i];
											$.ajax({
												type: 'POST',
												url: './includes/add_sort.inc.php',
												data: {
													id_puce: data,
													sort: sort,
													description: description,
													type1: type1,
													type2: type2,
													bonus: type_bonus,
													pe: cout_pe,
													charge: cout_charge
												},
												async: false
											});
											i++;
										});
										setTimeout(function(){
											location.reload();
										}, 200);
									});
							}
							return false;
						}
				},
				preview: {
					text: 'Visualiser la puce',
					action: function() {
							var end = false;
							$('#puce #ajout-puce input:required, #puce #ajout-puce textarea:required').each(function(){
								if($(this).val()==null || $(this).val()=='' || $(this).val()==0) {
									alert($(this)[0].name+' is required');
									end = true;
								}
							});
							if(!end) {
								var string;
								if($('#puce form').hasClass('hide')) {
									$('#puce form').removeClass('hide');
									$('#puce #preview-puce').remove();
									string = '';
									sorts = [];
									descriptions = [];
									types1 = [];
									types2 = [];
									types_bonus = [];
									couts_pe = [];
									couts_charge = [];
								}
								else {
									$('#puce form').addClass('hide');
									nom = $('#puce form > input[name*="nom"]').val();
									info = $('#puce form > textarea[name*="info"]').val();
									$('#puce form > fieldset').each(function() {
										sorts.push($(this).find('input[name="sort"]').val());
										descriptions.push($(this).find('textarea[name="description"]').val());
										types1.push($(this).find('input[name="type1"]').val());
										types2.push($(this).find('input[name="type2"]').val());
										types_bonus.push($(this).find('input[name="type_bonus"]').val());
										couts_pe.push($(this).find('input[name="pe"]').val());
										couts_charge.push($(this).find('input[name="charge"]').val());
									});
									string = '<section id="preview-puce">'+
													'<div class="puce border">'+
														'<h2>'+nom+'</h2>'+
														'<p>'+info+'</p>';
									
									for (var x = 0; x < sorts.length; x++) {
										string += 		'<div>'+
		            										'<h4>'+sorts[x]+' : <span>('+types1[x]+' '+types2[x];
		            					if (types_bonus[x]!=null && types_bonus[x]!='') {
		            						string +=		'<span> '+types_bonus[x]+'</span>';
		            					}
		            					string +=			')</span></h4>'+
		            										'<p class="cout">'+couts_pe[x]+' PE';
		            					if (couts_charge[x]!=null && couts_charge[x]!=0) {
		            						string +=		', '+couts_charge[x]+' charge</p>';
		            					}
		            					else {string += 	'</p>';}
		            					string += 		'</div>'+
														'<p>'+descriptions[x]+'</p>';
									}
									string +=		'</div>'+
												'</section>';
									$('#puce form').before(string);
								}
								return false;
							}
							return false;
						}
				},
				Annuler: function() {
					$('#puce button.ajout').removeClass('hide');
				}
			}
		});
	});
	if(!mjRight) {
		$('#puce .puce').each(function() {
			$(this).click(function() {
				attribution($(this));
			});
		});
	}
	else {
		$('#puce .puce').each(function() {
			$(this).click(function() {
				var dom = $(this);
				$.confirm({
					title: 'Puce',
					content: '<p>Attribuer la puce à un personnage OU accéder à la fenêtre d\'édition de la puce</p>',
					buttons: {
						attribuer: {
							text: 'Attribuer la puce à un personnage',
							action: function() {
								attribution(dom);
							},
							btnClass: 'btn-default button-attribution'
						},
						Éditer: function() {
							modal_modify_puce(dom);
						}
					}
				});
			});
		});
	}
});

function attribution(data) {
	var nom = data.find('h2').text();
	var id_puce = data.attr('id').replace('puce-','');
	var disponibilité = data.find('> p:first-child').hasClass('libre');
	if(disponibilité) {
		$.post('./includes/getPersoAttribute.inc.php', function(data) {
			$.confirm({
				title: 'Puce '+nom,
				content: '<p>Sélectionner un personnage pour lui attribuer la puce</p>'+
						data,
				buttons: {
					attribuer: {
						text: 'Attribuer',
						action: function() {
							var perso = $('option:selected').val();
							$.post('./includes/attrib_puce.inc.php',
							{
								id_puce: id_puce,
								perso: perso
							});
							setTimeout(function(){
								location.reload();
							}, 200);
						},
						btnClass: 'btn-blue'
					},
					Annuler: function() {}
				}
			});
		});
	}
	else {
		$.post('./includes/getPuceAttribute.inc.php',
		{
			id_puce: id_puce
		},
		function(data) {
			if(data.includes('erreur')) {
				$.confirm({
					title: 'Puce '+nom,
					content: data,
					buttons: {
						retirer: {
							text: 'Retirer la puce',
							action: function() {},
							isDisabled: true,
						},
						Annuler: function() {}
					}
				});
			}
			else {
				$.confirm({
					title: 'Puce '+nom,
					content: data,
					buttons: {
						retirer: {
							text: 'Retirer la puce',
							action: function() {
								$.post('./includes/retire_puce.inc.php',
								{
									id_puce: id_puce
								});
								setTimeout(function(){
									location.reload();
								}, 200);
							},
							btnClass: 'btn-blue'
						},
						Annuler: function() {}
					}
				});
			}
		});
	}
}