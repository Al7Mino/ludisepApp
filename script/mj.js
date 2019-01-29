var mjRight = true;
var modal_modify_puce = function(data) {
	var nom;
	var id_puce;
	var info;
	var id_sort;
	var sort;
	var description;
	var type1;
	var type2;
	var type_bonus;
	var cout_pe;
	var cout_charge;

	var position;

	var modifications = [];
	var values = [];
	var numSort = [];

	//$('#puce .puce').each(function() {
	//	$(this).click(function() {

			var string = '';
			//nom = $(this).find('h2').text();
			//info = $(this).find('p.info-puce').text();
			id_puce = data.attr('id').replace('puce-','');
			nom = data.find('h2').text();
			info = data.find('p.info-puce').text();

			string += '<form id="modif-puce" class="flex-column add-puce">'+
						'<label>Nom de la puce</label><input type="text" name="nom" placeholder="Requis" required value="'+nom+'">'+
						'<label>Informations</label><textarea name="info">'+info+'</textarea>';

			//$(this).find('.puce-sort').each(function() {
			data.find('.puce-sort').each(function() {
				id_sort = $(this).attr('id').replace('sort-', '');
				sort = $(this).find('div h4').text().split(' :')[0];
				description = $(this).find('> p').text();
				type1 = $(this).find('div h4 > span').text().split(' ')[0];
				if(type1!=undefined) {
					type1 = type1.replace('(', '');
				}
				else {
					type1 = '';
				}
				type2 = $(this).find('div h4 > span').text().split(' ')[1];
				if(type2!=undefined) {
					type2 = type2.replace(')', '');
				}
				else {
					type2 = '';
				}
				type_bonus = $(this).find('div h4 > span > span').text().replace(' ','');
				cout_pe = $(this).find('.cout').text().split(' PE')[0];
				cout_charge = $(this).find('.cout').text().split(', ')[1];
				if(cout_charge!=undefined) {
					cout_charge = cout_charge.replace(' charge', '');
				}
				else {
					cout_charge = '';
				}

				string += '<div class="flex">'+
							'<fieldset id="modif-sort-'+id_sort+'">'+
								'<legend>Sort</legend>'+
								'<div class="flex-column add-sort">'+
									'<label>Nom du sort</label><input type="text" name="sort" placeholder="Requis" required value="'+sort+'">'+
									'<label>Description</label><textarea name="description" placeholder="Requis" required>'+description+'</textarea>'+
									'<label>Type</label><input type="text" name="type1" placeholder="magique, arme, ..." value="'+type1+'">'+
									'<label>Effet</label><input type="text" name="type2" placeholder="buff, débuff, soin, ..." value="'+type2+'">'+
									'<label>Mot clé</label><input type="text" name="type_bonus" placeholder="météo, évolution, ..." value="'+type_bonus+'">'+
									'<label>Coût</label>'+
									'<div>'+
										'<input type="number" name="pe" placeholder="Requis" required value="'+cout_pe+'"><span> PE</span>'+
									'</div>'+
									'<div>'+
										'<input type="number" name="charge" value="'+cout_charge+'"><span> Charge</span>'+
									'</div>'+
								'</div>'+
							'</fieldset>'+
							'<img alt="Bouton de supression" class="suppr" src="./img/suppr-icon.png" title="Supprimer le sort">'+
						'</div>';
			});
			string += 	'</form>';
			$.confirm({
				title: 'Édition de puces',
				content: string,
				onContentReady: function() {
					$('#puce form input, #puce form textarea').each(function() {
						$(this).change(function() {
							if($(this).attr('name')=='nom' || $(this).attr('name')=='info') {
								position = -1;
							}
							else {
								position = $(this).parents('fieldset').attr('id').replace('modif-sort-', '');
							}
							modifications.push($(this).attr('name'));
							values.push($(this).val());
							numSort.push(position);
						});
					});
					$('#puce form > div').each(function() {
						$(this).find('.suppr').click(function() {
							var id_sort_suppr = $(this).siblings('fieldset').attr('id').replace('modif-sort-', '');
							$.post('./includes/suppr_sort.inc.php',
								{
									id: id_sort_suppr
								});
							$(this).parent().addClass('hide');
						});
					});
				},
				buttons: {
					create: {
						text: 'Créer le sort',
						action: function() {
							sort = $('#modify-add-sort').find('input[name="sort"]').val();
							description = $('#modify-add-sort').find('textarea[name="description"]').val();
							type1 = $('#modify-add-sort').find('input[name="type1"]').val();
							type2 = $('#modify-add-sort').find('input[name="type2"]').val();
							type_bonus = $('#modify-add-sort').find('input[name="type_bonus"]').val();
							cout_pe = $('#modify-add-sort').find('input[name="pe"]').val();
							cout_charge = $('#modify-add-sort').find('input[name="charge"]').val();

							if(sort!=null && sort!='' && description!=null && description!='' && cout_pe!=null && cout_pe!=0) {
								$.post('./includes/add_sort.inc.php',
								{
									id_puce: id_puce,
									sort: sort,
									description: description,
									type1: type1,
									type2: type2,
									bonus: type_bonus,
									pe: cout_pe,
									charge: cout_charge
								});
								this.buttons.modify.enable();
								this.buttons.add.enable();
								this.buttons.add.show();
								this.buttons.create.disable();
								this.buttons.create.hide();
								setTimeout(function(){
									location.reload();
								}, 200);
							}
							else {
								alert('Certains champs requis sont manquants !');
								return false;
							}
							/*$('#puce form').removeClass('hide');
							$('#modify-add-sort').remove();*/
						},
						isHidden: true,
						isDisabled: true,
						btnClass: 'btn-blue'
					},
					add: {
						text: 'Ajouter un sort',
						action: function() {
							this.buttons.modify.disable();
							this.buttons.add.disable();
							this.buttons.add.hide();
							this.buttons.create.enable();
							this.buttons.create.show();

							$('#puce form').addClass('hide');
							$('#puce form').after(
							'<fieldset id="modify-add-sort">'+
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

							return false;
						},
						btnClass: 'btn-blue'
					},
					modify: {
						text: 'Modifier',
						action: function() {
							for (var i = 0; i < modifications.length; i++) {
								$.ajax({
									type: 'POST',
									url: './includes/modify_puce.inc.php',
									data: {
										id_puce: id_puce,
										modification: modifications[i],
										value: values[i],
										numSort: numSort[i]
									},
									async: false
								});
							}
							setTimeout(function(){
								location.reload();
							}, 200);
						},
						btnClass: 'btn-blue'
					},
					supprimer: {
						text: 'Supprimer la puce',
						action: function() {
							$.post('./includes/suppr_puce.inc.php',
								{
									id_puce: id_puce
								});
							setTimeout(function(){
								location.reload();
							}, 200);
						},
						btnClass: 'btn-red'
					},
					Annuler: function() {
						setTimeout(function(){
							location.reload();
						}, 200);
					}
				}
			});
		//});
	//});
}