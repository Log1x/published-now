import dayjs from 'dayjs';

jQuery(document).ready(($) => {
  if (!$('.inline-edit-date').length) {
    return;
  }

  $('.inline-edit-date')
    .find('.timestamp-wrap')
    .append(
      $('<a>')
        .css({ display: 'inline-block', marginLeft: '0.25rem', cursor: 'pointer' })
        .attr('data-refresh-date', true)
        .html('<span class="dashicons dashicons-update"></span>')
    );

  $('[data-refresh-date]').bind('click', () => {
    let time = dayjs();

    if ($('select[name="mm"]').length > 0) {
      $('select[name="mm"]').val(time.format('MM'));
    }

    if ($('input[name="jj"]').length > 0) {
      $('input[name="jj"]').val(time.format('DD'));
    }

    if ($('input[name="aa"]').length > 0) {
      $('input[name="aa"]').val(time.format('YYYY'));
    }

    if ($('input[name="hh"]').length > 0) {
      $('input[name="hh"]').val(time.format('HH'));
    }

    if ($('input[name="mn"]').length > 0) {
      $('input[name="mn"]').val(time.format('mm'));
    }
  });
});
