
var submit = {};
var allCards = [];

function resetSubmit(){
	submit = {
		char: null,
		equip: null,
		status: null
	};
};

function createCards(cards){
	resetSubmit();
	allCards = [...cards['characters'],...cards['equipment'],...cards['status']];
	var createScroll = (name,key) => `<div class="scroll" id="${name}_list" data-key="${key}">${createCardList(cards[name])}</div>`;
	var html = createScroll('characters','char')+createScroll('equipment','equip')+createScroll('status','status');
	$('#scroll_container').html(html);
	updateCards();
};

function updateCards(){
	$('.card').click(function(){
		$(this).parent().find('.card.selected').removeClass('selected');
		$(this).addClass('selected');
		var key = $(this).parent().data()['key'];
		if(submit[key] || submit[key] === null) submit[key] = $(this).data()['id'].toString();
	});
};

function loadCards(name,room){
	var url = `join_room.php?name=${encodeURIComponent(name)}&room=${encodeURIComponent(room)}`;
	request(url).then(json => {
		var response = JSON.parse(json);
		window.player = response.player;
		createCards(response.cards);
		changeView($('#card_select_view'));
	}).catch(e => showError(e));
};

function initCardSelectButtons(){
	$('#submit_button').click(e => {
		if(Object.keys(submit).every(key => submit[key] !== null)){
			url = `submit_cards.php?player=${window.player}&room=${window.room}&${Object.keys(submit).map(key => key+'='+submit[key]).join('&')}`;
			request(url).then(d => {
				$('#selection_list').html(createCardList(allCards.filter(card => ~Object.values(submit).indexOf(card.id))));
				changeView($('#continue_view'));
			}).catch(e => showError(e));
		}else{
			alert('Please select a character, equipment, and status card');
		}
	});
	
	$('#clear_button').click(e => {
		resetSubmit();
		$('.card.selected').removeClass('selected');
	});
};

$(document).ready(function(){
	resetSubmit();
	initCardSelectButtons();
});
