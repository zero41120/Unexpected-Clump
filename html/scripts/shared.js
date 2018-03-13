
function showCreateJoin(){
    document.getElementById("show_nav_button").style.display = "none";
    document.getElementById("hide_nav_button").style.display = "block";
    document.getElementById("create_room_button").style.display = "block";
    document.getElementById("join_room_button").style.display = "block";
    document.getElementById("rules_button").style.display = "block";
}

function hideCreateJoin(){
    document.getElementById("show_nav_button").style.display = "block";
    document.getElementById("hide_nav_button").style.display = "none";
    document.getElementById("create_room_button").style.display = "none";
    document.getElementById("join_room_button").style.display = "none";
    document.getElementById("rules_button").style.display = "none";
}

function request(options){
	options = "/requests/" + options;
	return new Promise((res,rej) => {
		if(typeof options === 'string') options = {url: options};
		if(!options.url) return rej('no url given for request');
		if(!options.complete) options.complete = (response,status) => {
			if(response.status === 200) res(response.responseText);
			else rej(response.responseText);
		};
		$.ajax(options);
	});
};

function changeView($view){
	$('.current_view').removeClass('current_view');
	$view.addClass('current_view');
	if($view.attr('id') === 'home_view') showCreateJoin();
	else hideCreateJoin();
	window.scrollTo(0,0);
};

function showError(error){
	$('#error_text').text(error);
	changeView($('#error_view'));
};

function createCardList(cards){
	var getName = card => `<div class="card-${card.name ? 'name' : 'description'}">${card.name || card.description || ''}</div>`;
	var getAbility = card => `<div class="card-ability">${card.ability || ''}</div>`;
	var getCardBody = card => getName(card) + getAbility(card);
	var createCard = card => `<div class="card" style="background: url(${card.image})" data-id="${card.id}">${getCardBody(card)}</div>`;
	return cards.map(createCard).join('');
};

function createViewChange($button,$view){
	$button.click(function(){
		changeView($view);
	});
};

function createRoom(){
    hideCreateJoin();
	var name = $('#host_name_input').val();
	if(name.length === 0){
		return alert('Name cannot be left blank');
	}
	var themeList = $('#theme_checkbox_list input[type="checkbox"]').toArray().filter(e => e.checked).map(e => e.dataset['theme'])
	window.player_name = name;
	var url = `create_room.php?name=${encodeURIComponent(name)}&themeList=${themeList.join(',')}`;
	request(url).then(json => {
		console.log("Create Room Response:" + json);
		var response = JSON.parse(json);
		window.room = response.room;
		window.player = response.player;
		$('#room_label').text(response.room);
		$('.player_message').hide();
		$('.judge_message').show();
		changeView($('#judge_wait_view'));
	}).catch(e => showError(e));
};

function joinRoom(){
    hideCreateJoin();
	var name = $('#player_name_input').val();
	var room = $('#room_number_input').val();
	if(name.length === 0){
		return alert('Name cannot be left blank');
	}
	if(room.length === 0){
		return alert('Room cannot be left blank');
	}
	window.player_name = name;
	window.room = room;
	var url = `join_room.php?name=${encodeURIComponent(name)}&room=${encodeURIComponent(room)}`;
	request(url).then(json => {
		console.log("Join Room Response:" + json);
		var response = JSON.parse(json);
		window.player = response.player;
		createCards(response.cards);
		$('.player_message').show();
		$('.judge_message').hide();
		changeView($('#card_select_view'));
	}).catch(e => showError(e));
};

function beginJudging(){
	request(`begin_judging.php?judge=${window.player}`).then(json => {
		console.log("Begin Judging Response:" + json);
		var players = JSON.parse(json);
		var createPlayer = player => `<div class="button player_button">${player.name}</div>`;
		$('#player_list').html(players.map(createPlayer).join(''));
		$('#player_list .player_button').each((i,e) => {
			$(e).click(function(){chooseWinner(players[i].player)});
		});
		changeView($('#select_winner_view'));
	}).catch(e => showError(e));
};

function chooseWinner(winner){
	request(`pick_winner.php?judge=${window.player}&winner=${winner}`).then(json => {
		changeView($('#continue_view'));
	}).catch(e => showError(e));
};

function nextRound(){
	request(`continue.php?player=${window.player}&room=${window.room}`).then(json => {
		console.log("Next Round Response:" + json);
		var response = JSON.parse(json);
		if(response.wait) return alert('wait for the judge to choose a winner');
		if(response.judge){
			$('.player_message').hide();
			$('.judge_message').show();
			$('#room_label').text(window.room);
			changeView($('#judge_wait_view'));
		}else{
			createCards(response.cards);
			$('.player_message').show();
			$('.judge_message').hide();
			changeView($('#card_select_view'));
		}
	}).catch(e => showError(e));
};

function initButtons(){
	createViewChange($('#create_room_button'),$('#create_room_view'));
	createViewChange($('#join_room_button'),$('#join_room_view'));
	createViewChange($('#judge_back_button'),$('#judge_wait_view'));
	createViewChange($('#exit_button'),$('#home_view'));
	createViewChange($('.return_button'),$('#home_view'));
	
	$('#rules_button').click(function(){
		$('#rules_text').toggle();
	});
	
	$('#submit_create_button').click(createRoom);
	$('#host_name_input').keypress(e => e.which == 13 ? createRoom() : true);
	
	$('#submit_join_button').click(joinRoom);
	$('#player_name_input, #room_number_input').keypress(e => e.which == 13 ? joinRoom() : true);

	$('#select_winner_button').click(beginJudging);

	$('#continue_button').click(nextRound);
};

$(document).ready(function(){
	initButtons();
});
