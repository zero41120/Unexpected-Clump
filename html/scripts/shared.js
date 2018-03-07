
function request(options){
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
	window.scrollTo(0,0);
};

function showError(error){
	$('#error_text').text(error);
	changeView($('#error_view'));
};

function createCardList(cards){
	var getName = card => card.name || card.description || '';
	var getCardBody = card => card.image ? `<img src="${card.image}" alt="${getName(card).replace(/"/g,'\\"')}">` : getName(card);
	var createCard = card => `<div class="card${card.image ? '' : ' missing_image'}" data-id="${card.id}">${getCardBody(card)}</div>`;
	return cards.map(createCard).join('');
};

function createViewChange($button,$view){
	$button.click(function(){
		changeView($view);
	});
};

function createRoom(){
	var name = $('#host_name_input').val();
	var themeList = $('#theme_checkbox_list input[checkbox]').toArray().filter(e => e.checked).map(e => e['data-theme']);
	window.player_name = name;
	var url = `create_room.php?name=${encodeURIComponent(name)}&themeList=${encodeURIComponent(themeList.join(','))}`;
	request(url).then(json => {
		console.log("Create Room Response:" + json);
		var response = JSON.parse(json);
		window.room = response.room;
		window.player = response.player;
		window.judge = true; // using until continue.php is changed to choose a new judge
		$('#room_label').text(response.room);
		$('.player_message').hide();
		$('.judge_message').show();
		changeView($('#judge_wait_view'));
	}).catch(e => showError(e));
};

function joinRoom(){
	var name = $('#player_name_input').val();
	var room = $('#room_number_input').val();
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
		$('#player_list .player_button').each((i,e) => $(e).click(function(){chooseWinner(players[i].id)}));
		changeView($('#select_winner_view'));
	}).catch(e => showError(e));
};

function chooseWinner(winner){
	request(`pick_winner.php?judge=${window.playerr}winner=${winner}`).then(json => {
		changeView($('#continue_view'));
	}).catch(e => showError(e));
};

function nextRound(){
	request(`continue.php?player=${window.player}&room=${window.room}`).then(json => {
		console.log("Next Round Response:" + json);
		var response = JSON.parse(json);
		if(response.wait) return alert('wait for the judge to choose a winner');
		if(response.judge || window.judge){
			$('.player_message').hide();
			$('.judge_message').show();
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
	createViewChange($('#return_button'),$('#home_view'));
	
	$('#rules_button').click(function(){
		$('#rules_text').show();
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
