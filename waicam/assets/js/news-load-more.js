(function ($) {
  'use strict';

  const config = window.waicamNews || {};
  const labels = config.labels || {};

  $('#load-more-btn').on('click', function () {
    const button = $(this);
    const container = $('#posts-container');
    const page = parseInt(button.attr('data-page'), 10) || 2;

    $.ajax({
      url: config.ajax_url,
      type: 'post',
      dataType: 'json',
      data: {
        action: 'load_more_posts',
        nonce: config.nonce,
        paged: page
      },
      beforeSend: function () {
        button.prop('disabled', true).text(labels.loading || 'Loading…');
      },
      success: function (response) {
        const data = response && response.data ? response.data : {};

        if (response && response.success && data.html && data.html.trim() !== '') {
          container.append(data.html);
          button.attr('data-page', page + 1);

          if (data.has_more) {
            button.prop('disabled', false).text(labels.load_more || 'Load More');
          } else {
            button.text(labels.no_more || 'No more posts').prop('disabled', true).addClass('is-disabled');
          }
        } else {
          button.text(labels.no_more || 'No more posts').prop('disabled', true).addClass('is-disabled');
        }
      },
      error: function () {
        button.text(labels.error || 'Error').prop('disabled', true).addClass('is-disabled');
      }
    });
  });
})(jQuery);
