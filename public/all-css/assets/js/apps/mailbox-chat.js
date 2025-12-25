function scrollChatToBottom() {
  const box = document.querySelector('.chat-conversation-box');
  if (!box) return;
  box.scrollTop = box.scrollHeight;
}

// وقتی چت انتخاب می‌شود
$('.user-list-box .person').on('click', function () {
  setTimeout(scrollChatToBottom, 0);
});

// وقتی پیام ارسال می‌شود
$('.mail-write-box').on('keydown', function (event) {
  if (event.key === 'Enter') {
      event.preventDefault();
      var msg = $(this).val().trim();
      if (!msg) return;

      $('.active-chat').append('<div class="bubble me">' + msg + '</div>');
      $(this).val('');

      setTimeout(scrollChatToBottom, 0);
  }
});


/* ================= SEARCH ================= */
$('.search > input').on('keyup', function () {
  var rex = new RegExp($(this).val(), 'i');
  $('.people .person').hide();
  $('.people .person').filter(function () {
      return rex.test($(this).text());
  }).show();
});

/* ================= OPEN CHAT ================= */
$('.user-list-box .person').on('click', function () {

  if ($(this).hasClass('active')) return false;

  var findChat = $(this).attr('data-chat');
  var personName = $(this).find('.user-name').text();
  var personImage = $(this).find('img').attr('src');

  $('.chat-not-selected').hide();
  $('.chat-box-inner').show();

  if (window.innerWidth <= 767) {
      $('.chat-box .current-chat-user-name .name').text(personName.split(' ')[0]);
  } else {
      $('.chat-box .current-chat-user-name .name').text(personName);
  }

  $('.chat-box .current-chat-user-name img').attr('src', personImage);

  $('.chat').removeClass('active-chat');
  $('.person').removeClass('active');

  $(this).addClass('active');
  $('.chat[data-chat="' + findChat + '"]').addClass('active-chat');

  $('.chat-meta-user').addClass('chat-active');
  $('.chat-footer').addClass('chat-active');
  $('.chat-box').addClass('chat-box-active');

  if ($(this).parents('.user-list-box').hasClass('user-list-box-show')) {
      $(this).parents('.user-list-box').removeClass('user-list-box-show');
  }

  const box = document.querySelector('.chat-conversation-box');
  box.scrollTop = box.scrollHeight;
});

/* ================= SEND MESSAGE ================= */
$('.mail-write-box').on('keydown', function (event) {
  if (event.key === 'Enter') {
      event.preventDefault();

      var msg = $(this).val().trim();
      if (!msg) return;

      $('.active-chat').append('<div class="bubble me">' + msg + '</div>');
      $(this).val('');

      const box = document.querySelector('.chat-conversation-box');
      box.scrollTop = box.scrollHeight;
  }
});

/* ================= MOBILE TOGGLE ================= */
$('.hamburger, .chat-system .chat-box .chat-not-selected p').on('click', function () {
  $(this).parents('.chat-system').find('.user-list-box').toggleClass('user-list-box-show');
});

/* ================= CALL MOCK ================= */
function callOnConnect() {
  $('.overlay-phone-call .call-status').text('متصل');
  $('.overlay-phone-call .timer').css('visibility', 'visible');
}


