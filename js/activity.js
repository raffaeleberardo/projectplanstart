const priorities = ['Bassa', 'Media', 'Alta'];
const select = {'Bassa' : 0, 'Media' : 1, 'Alta' : 2};
const months = [
  'Gennaio',
  'Febbraio',
  'Marzo',
  'Aprile',
  'Maggio',
  'Giugno',
  'Luglio',
  'Agosto',
  'Settembre',
  'Ottobre',
  'Novembre',
  'Dicembre'
];

let expirations = [];

$(document).ready(
  function(){
    //Set di input date in modo che parta dal giorno corrente
    let currentDate = new Date();
    let month = ((currentDate.getMonth()+1)<10) ? '0'+(currentDate.getMonth()+1) : currentDate.getMonth()+1;
    let day = ((currentDate.getDate())<10) ? '0'+(currentDate.getDate()) : currentDate.getDate();
    $('input[type=date]').attr('min', currentDate.getFullYear()+'-'+month+'-'+day);
    $('input[type=date]').attr('max', currentDate.getFullYear()+'-12-31');
    //caricamento delle activities nella schermata
    $.ajax(
      {
        url : "../handler/activity.php",
        async : true,
        type: "post",
        data : {username : username},
        dataType : "json",
        success : function(response){
          let expiration;
          for (var i = 0; i < response.length; i++) {
            //creo campi Data in cui inserire vari tasks
            expiration = response[i]['expiration_date'];
            if (!expirations.includes(expiration)) {
              expirations.push(expiration);
              let createDate = dateElement(expiration);
            }
            let activity = activityElement(response[i]['activity'], response[i]['priority'], response[i]['complete'], response[i]['expiration_date'], response[i]['created']);
            $('#'+expiration).append(activity);
          }
        }
      }
    );
  }
);

//aggiungere attività al database
$('form').submit(
  function(event){
    event.preventDefault();
    let submit = $('input[name=add_activity_submit]').val();
    let activity = $('input[name=add_activity_input]').val();
    let expiration_date = $('input[name=expiration_date]').val();
    $.ajax(
      {
        url : "../handler/activity.php",
        async : true,
        type : "post",
        data : {add_activity_submit : submit, add_activity_input : activity, expiration_date : expiration_date},
        dataType : "json",
        success : function(response){
          if (response) {
            let activity = activityElement(response['activity'], response['priority'], response['complete'], response['expiration_date'], response['created']);
            if (!expirations.includes(response['expiration_date'])) {
              expirations.push(response['expiration_date']);
              let createDate = dateElement(response['expiration_date']);
            }
            $('#'+response['expiration_date']).append(activity);
            $('#add_activity input[type=text]').select();
          }
        }
      }
    );
  }
);
//update della priorità nel database
$(document).on('change','select',function(){
    // let activity = $(this).parent().parent()[0].childNodes[0].nodeValue;
    let activity = $(this).parent().prev().children().text();
    let created = $(this).parent().prev().children('label').attr('id');
    let newPriority = $(this).children('option:selected').val();
    newPriority = select[newPriority]; //object select a inizio script
    $.ajax(
      {
        url : "../handler/activity.php",
        async : true,
        type : "post",
        context: this,
        data : {newPriority : newPriority, created : created},
        success: function(response){
          setColor($($(this).parent().parent()[0]), newPriority);
        }
      }
    );
  }
);
//update modifica attività nel database
$(document).on('click', '.far.fa-edit', function(){
  let activity = $(this).parent().prev().children().text();
  let created = $(this).parent().prev().children('label').attr('id');
    swal({
            text: "Modifica attività: ",
            content: "input",
            button: {
              text: "Modifica",
            },
          })
          .then(newActivity => {
            $.ajax(
              {
                url : "../handler/activity.php",
                async : true,
                type: "post",
                data : { activity : activity, newActivity : newActivity, created : created},
                dataType : "json",
                context : this,
                success : function(response){
                  if ($($(this).parent().prev().children('input[type=checkbox]')).is(":checked")) {
                    $($(this).parent().prev().children()[1]).children().text(response);
                  }else{
                    $($(this).parent().prev().children()[1]).text(response);
                  }
                }
              }
            );
        });
  }
);

//update complete
$(document).on('change', 'input[type=checkbox]', function(){
  let activity = $(this).next().text();
  let created = $(this).next().attr('id');
  console.log(created);
  if ($(this).is(":checked")) {
    $.ajax(
      {
        url : "../handler/activity.php",
        async : true,
        type : "post",
        data : {activity : activity, complete : "true", created : created},
        context : this,
        success : function(response){
          $(this).next().remove();
          $(this).parent().append('<label id="'+created+'"><del>'+activity+'</del></label>');
        }
      }
    );
  }
  else {
    $.ajax(
      {
        url : "../handler/activity.php",
        async : true,
        type : "post",
        data : {activity : activity, complete : "false", created : created},
        context : this,
        success : function(response){
          $(this).next().remove();
          $(this).parent().append('<label id="'+created+'">'+activity+'</label>');
        }
      }
    );
  }
});

//elimina attività
$(document).on('click', '.fas.fa-trash-alt', function(){
  let activity = $(this).parent().prev().children().text();
  let created = $(this).parent().prev().children('label').attr('id');
  console.log(created);
    $.ajax(
      {
        url : "../handler/activity.php",
        async : true,
        type : "post",
        data : {delete : true, activity : activity, created : created},
        context : this,
        success : function(response){
          if (response) {
            let n = $(this).parent().parent().parent().children(".activity").length;
            if (n === 1) {
              let expirationIndex = expirations.indexOf($(this).parent().parent().parent().attr('id'));
              expirations.splice(expirationIndex, 1);
              $(this).parent().parent().parent().remove();
            }else{
              $(this).parent().parent()[0].remove();
            }
          }
        }
      }
    );
  }
);

//funzioni aggiuntive
//setColor activity in base a priorità
function setColor(activity, priority){
  switch (priority) {
    case 1:
      activity.css('background-color', '#E67E22');
      break;
    case 2:
      activity.css('background-color', '#E74C3C');
      break;
    default:
      activity.css('background-color', '#ccc');
      break;
  }
}
//crea elemento attività
function activityElement(activity, priority, complete, expiration_date, created){
  let activityElement = $('<div class="activity"></div>');
  let activityCheckbox = (complete) ? '<input type="checkbox" checked>' : '<input type="checkbox">';
  $(activityCheckbox).attr('value', activity);
  let divCheck = $('<div class="check"></div>');
  divCheck.append(activityCheckbox);
  let activityLabel = $('<label id="'+created+'"></label>');
  activityLabel = (complete) ? activityLabel.append("<del>" + activity + "</del>") : activityLabel.text(activity);
  divCheck.append(activityLabel);
  let selectElement = $('<select name="priority"></select>');
  let groupButtons = $('<span class="groupButtons"></span>');
  for (var j = 0; j < 3; j++) {
    let optionElement = "<option val=" + j + " " + ((priority === j) ? "selected='selected'>" : ">");
    optionElement += priorities[j] + "</option>";
    selectElement.append(optionElement);
  }
  groupButtons.append(selectElement);
  groupButtons.append("<button class='far fa-edit'></button>");
  groupButtons.append("<button class='fas fa-trash-alt'></button>");
  activityElement.append(divCheck);
  activityElement.append(groupButtons);
  setColor(activityElement, select[$(selectElement).children('option:selected').val()]);
  return activityElement;
}

function dateElement(expiration_date){
  if (Date.parse(expiration_date)) {
    let data = new Date(expiration_date);
    let expiration_date_string = data.getDate() + " " + months[data.getMonth()] + " " + data.getFullYear();
    $('main').append('<div class="activity-container" id="'+expiration_date+'"></div>');
    $('#'+expiration_date).append("<h2>"+ expiration_date_string +"</h2>");
  }else{
    $('main').append('<div class="activity-container" id="'+null+'"></div>');
    $('#'+null).append("<h2>Senza scadenza...</h2>");
  }
}

//style functions
$('#show_add_activity').click(function(){
    $('#add_activity').toggle('slow');
    $('#add_activity input[type=text]').select();
  }
);

//chiude div aggiungi attività se aperto
$('main').click(
  function(){
    if ($('#add_activity').css('display') !== 'none') {
      $('#add_activity').hide('slow');
    }
  }
);

//apre menù laterale
$('#openNav').click(
  function(){
    $('.sidenav').css('width', '250px');
    $('.push').css('marginLeft', '250px');
    $('.push').css('backgroundColor', 'rgba(0,0,0,0.4)');
  }
);

//chiude menù laterale
$('#closeNav').click(
  function(){
    $('.sidenav').css('width', '0px');
    $('.push').css('marginLeft', '0px');
    $('.push').css('backgroundColor', '#fff');
  }
);
